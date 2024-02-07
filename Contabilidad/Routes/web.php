<?php
use Illuminate\Support\Facades\Route;
use Modules\Contabilidad\Http\Controllers\BankAccountsController;
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

Route::resource('contabilidad/ingresos', IngresosController::class);
Route::resource('contabilidad/gastos', GastosController::class);

Route::get('contabilidad/cuentas', [BankAccountsController::class, 'index'])->name('contabilidad.index');
Route::post('contabilidad/cuentas', [BankAccountsController::class, 'store'])->name('contabilidad.store');
Route::get('contabilidad/show/{id}', [BankAccountsController::class, 'show'])->name('contabilidad.show');
Route::get('contabilidad/edit/{id}', [BankAccountsController::class, 'edit'])->name('contabilidad.edit');
Route::patch('contabilidad/cuentas/{id}', [BankAccountsController::class, 'update'])->name('contabilidad.update');
Route::delete('contabilidad/cuentas', [BankAccountsController::class, 'destroy'])->name('contabilidad.destroy');

Route::get('contabilidad/transacciones', [BankAccountsController::class, 'transacciones'])->name('contabilidad.transacciones');

Route::get('contabilidad/cuentas-por-pagar', [BankAccountsController::class, 'AccountsPayable'])->name('contabilidad.AccountsPayable');
Route::post('contabilidad/cuentas-por-pagar', [BankAccountsController::class, 'AccountsPayable_store'])->name('contabilidad.AccountsPayable.store');

Route::get('contabilidad/cuentas-por-cobrar', [BankAccountsController::class, 'AccountsReceivable'])->name('contabilidad.AccountsReceivable');
Route::post('contabilidad/cuentas-por-cobrar', [BankAccountsController::class, 'AccountsReceivable_store'])->name('contabilidad.AccountsReceivable.store');


Route::get('contabilidad/balance', [BankAccountsController::class, 'balance'])->name('contabilidad.balance');
