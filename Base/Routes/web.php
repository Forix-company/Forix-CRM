<?php
use Modules\Base\Http\Controllers\AjaxController;
use Modules\Base\Http\Controllers\HerramientasController;
use Modules\Base\Http\Controllers\HomeController;
use Modules\Base\Http\Controllers\ImportExportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('PaymentGateway/voucher/PayU/{id}', [AjaxController::class, 'VoucherPayU']);
//Route::get('PaymentGateway/voucher/Epayco/{id}', [AjaxController::class, 'VoucherPayU']);

Route::middleware(['auth', 'verified', '2fa'])->group(function () {

    // METODOS POST
    Route::post('2fa/{id}', [AjaxController::class, 'CodeQR'])->name('google.2fa');
    Route::post('GetProveedor/{id}', [AjaxController::class, 'GetProveedor'])->name('get.proveedor');
    Route::post('compras/autorize/{id}', [AjaxController::class, 'Autorize'])->name('compras.Autorize');
    Route::post('inventario/devolucion/Ajax/Product/{id}', [AjaxController::class, 'InventarioDevolucionAjaxProduct'])->name('inventario.devolucion.product.ajax');
    Route::post('inventario/devolucion/Ajax/Detail/{id}', [AjaxController::class, 'InventarioDevolucionAjaxDetail'])->name('inventario.devolucion.detail.ajax');
    Route::post('GetProductos/Detail/{id}', [AjaxController::class, 'GetDetailProductos'])->name('get.products.detail');
    Route::post('GetProductos/Detail/name/{id}', [AjaxController::class, 'ProductosName'])->name('products.name.detail');
    Route::post('GetProductos/Detail/sale/{id}', [AjaxController::class, 'GetDetailProductosSale'])->name('get.products.detail.sale');
    Route::post('MetodoPago/send/{id}', [AjaxController::class, 'PagoPaymentGateway']);
    Route::post('settings_auth/{id}', [HerramientasController::class, 'settings_auth'])->name('settings_auth');
    Route::post('import/category/{id}', [ImportExportController::class, 'ImportCategory'])->name('import.category');
    Route::post('import/label/{id}', [ImportExportController::class, 'ImportEtiqueta'])->name('import.etiqueta');
    Route::post('import/factory/{id}', [ImportExportController::class, 'ImportFactory'])->name('import.factory');
    Route::post('import/supplier/{id}', [ImportExportController::class, 'ImportSupplier'])->name('import.supplier');
    Route::post('plantillas/store/{id}', [HomeController::class, 'plantillas_store'])->name('plantillas.store');

    // METODOS GET
    Route::get('inventario/show/export/{id}', [AjaxController::class, 'InventarioExport'])->name('inventario.export.product');
    Route::get('inventario/reporting/stock/', [AjaxController::class, 'ReportingInventory'])->name('inventario.reporting.stock');
    Route::get('GetSale/Detail/sale/{id}', [AjaxController::class, 'GetSalePDF'])->name('get.sale.detail.pdf');
    Route::get('GetSale/Detail/sale/ticket/{id}', [AjaxController::class, 'GetSaleTicketPDF'])->name('get.sale.detail.ticket.pdf');

    Route::get('home', [HomeController::class, 'index'])->name('user.dashboard');
    Route::get('configuracion', [HomeController::class, 'Herramientas']);
    Route::get('configuracion/Auth/login', [HerramientasController::class, 'login'])->name('configuracion.auth.login');
    Route::get('import/documents', [ImportExportController::class, 'index'])->name('import.files');
    Route::get('export/category', [ImportExportController::class, 'ExportCategory'])->name('export.category');
    Route::get('export/label', [ImportExportController::class, 'ExportEtiqueta'])->name('export.etiqueta');
    Route::get('export/factory', [ImportExportController::class, 'ExportFactory'])->name('export.factory');
    Route::get('export/supplier', [ImportExportController::class, 'ExportSupplier'])->name('export.supplier');
    Route::get('configuracion/plantillas', [HomeController::class, 'plantillas_index'])->name('plantillas');
    Route::get('configuracion/copias-de-seguridad', [HomeController::class, 'copias_de_seguridad'])->name('configuracion.copias');

    Route::get('configuracion/descargar/copia/{id}', [HomeController::class, 'descargarBackup'])->name('configuracion.copias.descargar');
    // METODOS PATCH
    Route::patch('usuario/Unclock/{id}', [AjaxController::class, 'UnclockUsers'])->name('unclock.users');

    // METODOS RESOURCE
    Route::middleware(['auth', 'password.confirm'])->group(function () {
        Route::get('usuario/{usuario}/edit', 'UsuarioController@edit')->name('usuario.edit');
        Route::patch('usuario/{usuario}', 'UsuarioController@update')->name('usuario.update');
    });
    Route::resource('usuario', UsuarioController::class)->except(['edit', 'update']);
    Route::resource('configuracion/modulos', ModulesController::class);
    Route::resource('informes', InformesController::class);
});

/*
Route::prefix('base')->group(function() {
    Route::get('/', 'BaseController@index');
});
*/
