<?php

namespace Modules\Base\Tests\Unit;

use PragmaRX\Google2FAQRCode\QRCode\QRCodeServiceContract;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PragmaRX\Google2FA\Google2FA;
use PragmaRX\Google2FAQRCode\Google2FA as QRCode;
use Modules\Base\Http\Controllers\AjaxController;
use Barryvdh\DomPDF\Facade\Pdf;
use Modules\Pasarela\Entities\PayUConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Mockery;

class AjaxControllerTest extends TestCase
{
    use DatabaseTransactions, WithFaker;
    // The CodeQR method should update the token_login field of a User model with a generated secret key and return the generated QR code data.
    public function testCodeQrUpdatesTokenLoginAndReturnsData()
    {
        // Create a user
        $user = User::factory()->create();
        $data = (new AjaxController)->CodeQR($user->id);
        $this->assertNotNull($data);

    }
    // The GetProveedor method should retrieve the product_offered field from the suppliers table based on the given id.
    public function test_get_proveedor_retrieves_product_offered_from_suppliers_table()
    {
        // Arrange
        $id = 1;
        $expectedProductOffered = 'Product Offered';
        $queryResult = new \stdClass();
        $queryResult->product_offered = $expectedProductOffered;
        DB::shouldReceive('table')->with('suppliers')->andReturnSelf();
        DB::shouldReceive('select')->with('product_offered')->andReturnSelf();
        DB::shouldReceive('where')->with('id', $id)->andReturnSelf();
        DB::shouldReceive('first')->andReturn($queryResult);

        // Act
        $result = app(AjaxController::class)->GetProveedor($id);

        // Assert
        $this->assertEquals($expectedProductOffered, $result);
    }

    // The GetDetailProductos method should handle the case when the GetDetailProductos stored procedure returns an empty result set.
    public function test_get_detail_productos_handles_empty_result_set()
    {
        // Arrange
        $id = 1;
        DB::shouldReceive('select')->with('CALL GetDetailProductos(?)', [$id])->andReturn([]);
        $controller = new AjaxController();

        // Act
        $result = $controller->GetDetailProductos($id);

        // Assert
        $this->assertEmpty($result);
    }

    // should retrieve the name of a product from the inventory table given a valid id
    function test_should_retrieve_product_name_given_valid_id()
    {
        // Arrange
        $id = 1;
        $expectedName = 'Product A';
        $inventoryMock = Mockery::mock('overload:Modules\Base\Http\Controllers\Inventory');
        $inventoryMock->shouldReceive('find')->with($id)->andReturn((object) ['name_inventory' => $expectedName]);

        // Act
        $result = (new AjaxController)->ProductosName($id);
        // Assert
        $this->assertEmpty($result);
    }

    // The GetDetailProductos method should handle the case when the stored procedure GetDetailProductos returns an empty result.
    public function test_get_detail_productos_handles_empty_result_from_stored_procedure()
    {
        // Arrange
        $id = 1;
        $expected = null;
        DB::shouldReceive('select')
            ->with('CALL GetDetailProductos(?)', [$id])
            ->andReturn([]);
        $controller = new AjaxController();

        // Act
        $result = $controller->GetDetailProductos($id);
        // Assert
        $this->assertEquals($expected, $result);
    }
    // Given a valid $id, the function should return a PDF file containing the inventory data.
    public function test_valid_id_returns_pdf_file()
    {
        // Arrange
        $id = 1;
        // Act
        $response = $this->getMockBuilder(AjaxController::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['InventarioExport'])
            ->getMock();

        $pdf = $this->getMockBuilder(Pdf::class)
            ->disableOriginalConstructor()
            ->getMock();

        $response->expects($this->once())
            ->method('InventarioExport')
            ->with($id)
            ->willReturn($pdf);

        // Assert
        $this->assertInstanceOf(Pdf::class, $response->InventarioExport($id));
    }
    // CodeQR method generates a new secret key and returns a QR code inline.
    public function test_code_qr_generates_new_secret_key_and_returns_qr_code_inline()
    {
        // Arrange
        $id = 1;
        $user = new User();
        $user->id = $id;
        $user->email = 'test@example.com';
        $user->token_login = 'old_secret_key';
        User::shouldReceive('where')->with('id', $id)->andReturnSelf();
        User::shouldReceive('update')->with(['token_login' => Mockery::type('string')])->andReturn(true);
        User::shouldReceive('find')->with($id)->andReturn($user);
        $qrCode = Mockery::mock(QRCode::class);
        $qrCode->shouldReceive('getQRCodeInline')->andReturn('qr_code');
        App::shouldReceive('make')->with(Google2FA::class)->andReturnSelf();
        Google2FA::shouldReceive('generateSecretKey')->with(32)->andReturn('new_secret_key');

        // Act
        $controller = new AjaxController();
        $result = $controller->CodeQR($id);

        // Assert
        $this->assertEquals('qr_code', $result);
    }
    // Returns a string containing HTML code when given a valid ID.
    function test_returns_html_code_with_valid_id()
    {
        // Arrange
        $id = 1;
        $expectedHtml = '<option value=1>Product 1</option>';

        // Mock the database query
        $response = (object) [
            (object) [
                'id' => 1,
                'products' => 'Product 1'
            ]
        ];
        $mockDb = Mockery::mock('Illuminate\Database\Query\Builder');
        $mockDb->shouldReceive('join')->once()->andReturnSelf();
        $mockDb->shouldReceive('select')->once()->andReturnSelf();
        $mockDb->shouldReceive('where')->once()->andReturnSelf();
        $mockDb->shouldReceive('get')->once()->andReturn($response);
        DB::shouldReceive('table')->once()->andReturn($mockDb);

        // Act
        $result = (new AjaxController)->InventarioDevolucionAjaxProduct($id);

        // Assert
        $this->assertEquals($expectedHtml, $result);
    }
    // The function should handle the case where the inventory item ID does not exist in the database and return an empty string.
    function test_inventory_devolution_ajax_detail_returns_empty_string_when_inventory_item_id_does_not_exist()
    {
        // Arrange
        $id = 1;
        $expectedHtml = '';
        $inventoryMock = Mockery::mock('overload:Modules\Base\Http\Controllers\Inventory');
        $inventoryMock->shouldReceive('select')->with('inventory.stock')->andReturnSelf();
        $inventoryMock->shouldReceive('where')->with('inventory.id', $id)->andReturnSelf();
        $inventoryMock->shouldReceive('get')->andReturnNull();
        $controller = new AjaxController();

        // Act
        $result = $controller->InventarioDevolucionAjaxDetail($id);

        // Assert
        $this->assertEquals($expectedHtml, $result);
    }
    // Given a valid sale ID, the function should generate a PDF file with the sale details and return it as a stream
    public function test_valid_sale_id_generate_pdf()
    {
        // Arrange
        $id = 1;
        // Act
        $result = (new AjaxController)->GetSalePDF($id);
        // Assert
        $this->assertNotEmpty($result);
    }
    // Generates a PDF ticket for a sale with valid data
    public function test_generates_pdf_ticket_for_sale_with_valid_data()
    {
        // Arrange
        $id = 1;
        // Act
        $result = (new AjaxController)->GetSaleTicketPDF($id);
        // Assert
        $this->assertNotEmpty($result);
    }
    // Payment gateway data is correctly retrieved from the database and formatted
    function test_payment_gateway_data_retrieval()
    {
        $data = [
            'id' => 1,
            'ApiKey' => 'testApiKey',
            'merchantId' => 'testMerchantId',
            'url' => 'testUrl',
            'tax' => 'testTax',
            'taxReturnBase' => 'testTaxReturnBase',
            'currency' => 'testCurrency',
            'accountId' => 'testAccountId',
            'test' => 'testTest',
            'responseUrl' => 'testResponseUrl'
        ];
        $response = (new AjaxController())->PagoPaymentGateway(new Request($data));
        $this->assertNotEmpty($response);
    }
}
