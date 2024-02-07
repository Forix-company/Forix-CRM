<?php

namespace Modules\Base\Http\Controllers;


use App\Models\User;
use Modules\Base\Entities\PaymentGatewayStates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PragmaRX\Google2FA\Google2FA;
use PragmaRX\Google2FAQRCode\Google2FA as QRCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Modules\Base\Mail\PaymentGatewayMail;
use Illuminate\Support\Facades\Mail;
use Modules\Empresas\Entities\Empresas;
use Modules\Pasarela\Entities\PayUConfiguration;
use Illuminate\Routing\Controller;

class AjaxController extends Controller
{

    function CodeQR($id)
    {
        User::where('id', $id)->update(['token_login' => (new Google2FA)->generateSecretKey(32)]);
        $user = User::find($id);
        $data = (new QRCode)->getQRCodeInline(config('app.name'), $user->email, $user->token_login, 200);
        return $data;
    }

    function GetProveedor($id)
    {

        $reponse = DB::table('suppliers')->select("product_offered")->where('id', $id)->first();
        return $reponse->product_offered;
    }

    function GetDetailProductos($id)
    {

        $reponse = DB::select('CALL sp_get_detail_products(?)', array($id));

        $html = null;
        foreach ($reponse as $value) {
            $html .= '<div class="row">';
            $html .= '<div class="col-sm-6 form-group">';
            $html .= '<label>cantidad en inventario</label>';
            $html .= '<input type="number" value="' . $value->quantity . '" name="CantidadCompra" class="form-control" readonly>';
            $html .= '</div>';
            $html .= '<div class="col-sm-6 form-group">';
            $html .= '<label>Precio de compra</label>';
            $html .= '<input type="text" value="$' . number_format($value->price, 2, '.', ',') . '" name="PrecioCompra" id="PrecioCompra" class="form-control" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="$1,000,000.00" readonly>';
            $html .= '</div>';
            $html .= '</div>';
        }
        return $html;
    }

    function ProductosName($id)
    {
        $reponse = DB::table('inventory')->select('name_inventory')->where('id', $id)->first();
        return $reponse->name_inventory ?? 0;
    }

    function GetDetailProductosSale($id)
    {

        $reponse = DB::table('products')
            ->select('sku', 'quantities', 'price')
            ->where('id', $id)->get();

        $html = null;

        foreach ($reponse as $value) {
            $html .= '<div class="row">';
            $html .= '<div class="col-sm-4 form-group">';
            $html .= '<label>codigo unico del producto</label>';
            $html .= '<input type="text" value="' . $value->sku . '" name="sku" class="form-control" readonly>';
            $html .= '</div>';
            $html .= '<div class="col-sm-4 form-group">';
            $html .= '<label>cantidad en inventario</label>';
            $html .= '<input type="number" value="' . $value->quantities . '" name="CantidadVenta" class="form-control" readonly>';
            $html .= '</div>';
            $html .= '<div class="col-sm-4 form-group">';
            $html .= '<label>Precio de compra</label>';
            $html .= '<input type="text" value="$' . number_format($value->price, 2, '.', ',') . '" name="PrecioVenta" id="currency-field" class="form-control" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" placeholder="$1,000,000.00" readonly>';
            $html .= '</div>';
            $html .= '</div>';
        }

        return $html;
    }

    function InventarioExport($id)
    {
        $reponse = DB::select('CALL sp_inventory_export(?)', array($id));
        $pdf = Pdf::loadView('base::Dashboard.ExportPDF.InventarioExport.index', compact('reponse'));
        return $pdf->download('Inventario.pdf');
    }

    function Autorize(Request $request, $id)
    {
        try {
            if ($request->autorizacion == 1) {

                $compras = DB::table('buys')->where('id', $id)->update([
                    'authorized_id' => $request->autorizacion,

                ]);

                $compras = DB::table('buys')->where('id', $id)->first();

                $proveedor = DB::table('suppliers')->where('id', $compras->supplier_id)->first();

                $inventarioValidate = DB::table('inventory')->where('code', $compras->code)->first();
                if (empty($inventarioValidate)) {
                    $Ingresoinventario = DB::table('inventory_entry')->insertGetId([
                        'supplier_id' => $proveedor->id,
                        'buys_id' => $compras->id,
                        'products' => $proveedor->product_offered,
                        'quantity' => $request->cantidad,
                        'supplier_price' => $request->precio,
                        'state_id' => $request->autorizacion,
                    ]);

                    DB::table('inventory')->insert([
                        'code' => $compras->code,
                        'name_inventory' => $proveedor->product_offered,
                        'stock' => $request->cantidad,
                        'entrance_id' => $Ingresoinventario,
                        'return_id' => null,

                    ]);

                    return redirect('compras')->with('success', 'Se autorizo la compra exitosamente !');
                } else {
                    return redirect('compras')->with('warning', 'ya se encuentra autorizado la compra !');
                }

            } else {

                DB::table('buys')->where('id', $id)->update([
                    'authorized_id' => $request->autorizacion,
                ]);

                return redirect('compras')->with('error', 'No autorizo la compra exitosamente !');
            }
        } catch (\Exception $th) {
            return ('Error al autorizar la compra');
        }
    }

    function InventarioDevolucionAjaxProduct($id)
    {
        $response = DB::table("inventory_entry")
            ->join("suppliers", "suppliers.id", "=", "inventory_entry.supplier_id")
            ->select('inventory_entry.id', 'inventory_entry.products')
            ->where("suppliers.id", $id)->get();

        foreach ($response as $value) {
            $html = "<option value=" . $value->id . ">" . $value->products . "</option>";
        }

        return $html;
    }

    function InventarioDevolucionAjaxDetail($id)
    {
        $InventarioDevolucionAjax = DB::table("inventory")
            ->select('inventory.stock')
            ->where("inventory.id", $id)->get();
        $html = null;
        foreach ($InventarioDevolucionAjax as $value) {
            $html .= '<label>cantidad en stock en inventario</label>';
            $html .= '<input type="number" name="Stock" value="' . $value->stock . '" class="form-control" readonly>';
        }
        return $html;
    }

    function GetSalePDF($id)
    {
        $VentaDescripcion = DB::select('CALL sp_get_sale_PDF(?)', array($id));
        $Empresas = Empresas::all();
        $pdf = Pdf::loadView('base::Dashboard.ExportPDF.VentaPDF.Sale', compact('VentaDescripcion', 'Empresas'));
        return $pdf->stream();
    }

    function GetSaleTicketPDF($id)
    {
        $VentaDescripcion = DB::select('CALL sp_get_sale_PDF(?)', array($id));
        $Empresas = Empresas::all();
        $pdf = Pdf::loadView('base::Dashboard.ExportPDF.VentaPDF.Ticket', compact('VentaDescripcion', 'Empresas'));
        $pdf->setPaper([0, 0, 227.5, 700], 'portrait');
        return $pdf->stream();
    }

    function PagoPaymentGateway(Request $request)
    {
        try {
            $Ventas = DB::table('sales')->where('sales.id', $request->id)
                ->join('sales_detail', 'sales_detail.id', '=', 'sales.sale_id')
                ->select('sales.id_sales_check', 'sales.observations', 'sales_detail.products', 'sales_detail.price')->firstOrFail();

            $amount = str_replace('$', '', str_replace('.00', '', str_replace(',', '', $Ventas->price)));

            $PayU = PayUConfiguration::first();

            $firma = "$PayU->ApiKey~$PayU->merchantId~$Ventas->id_sales_check~$amount~$PayU->currency";

            $firmaMd5 = md5($firma);

            $data = [
                'URL' => $PayU->url,
                'referenceCode' => $Ventas->id_sales_check,
                'description' => $Ventas->products,
                'amount' => $amount,
                'buyerEmail' => $request->correo,
                'tax' => $PayU->tax,
                'taxReturnBase' => $PayU->taxReturnBase,
                'currency' => $PayU->currency,
                'merchantId' => $PayU->merchantId,
                'accountId' => $PayU->accountId,
                'signature' => $firmaMd5,
                'test' => $PayU->test,
                'responseUrl' => $PayU->responseUrl,
                'precio' => $Ventas->price,
            ];

            Mail::to("receiver@example.com")->send(new PaymentGatewayMail($data));

            return redirect('ventas')->with('success', 'Se envio el correo exitosamente !');
        } catch (\Exception $e) {
            return 'No se encontró ningún registro en la base de datos.';
        }
    }

    function VoucherPayU($id)
    {

        $PayU = PayUConfiguration::all();
        $Payment = PaymentGatewayStates::where('merchantId', $id)->get();

        $image = public_path('img/PaymentGateway/PayU.svg');

        $ApiKey = $PayU[0]->ApiKey;

        $firma = null;
        $firmaMd5 = null;
        foreach ($Payment as $payment) {
            $New_value = number_format(str_replace(',', '', $payment->TX_VALUE), 1, '.', '');
            $firma .= "$ApiKey~$payment->merchantId~$payment->referenceCode~$New_value~$payment->currency~$payment->transactionState";
            $firmaMd5 .= md5($firma);
        }

        $pdf = Pdf::loadView('base::Dashboard.ExportPDF.Vouchers.PayU', compact('Payment', 'firmaMd5', 'image'))
            ->set_option('enable_php', true)
            ->set_option('enable_remote', true);
        return $pdf->stream();
    }

    function UnclockUsers($id)
    {
        User::where('id', $id)->update([
            'blocked_temporarily' => 0,
            'blocked_permanently' => 0,
        ]);

        return redirect('usuario')->with('success', '¡Se ha desbloqueado al usuario exitosamente!');
    }

    function ReportingInventory()
    {

        $Inventarios = DB::table('inventory')
            ->select(
                'inventory.id',
                'inventory.code',
                'inventory.name_inventory',
                'products.description_products',
                'products.quantities',
                'products.price'
            )
            ->join('products', 'products.sku', '=', 'inventory.code')
            ->get();
        $pdf = Pdf::loadView('base::Dashboard.ExportPDF.InventarioExport.reporting', compact('Inventarios'));
        return $pdf->stream('Inventario Agotado.pdf');
    }
}
