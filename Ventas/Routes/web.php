<?php
use Illuminate\Support\Facades\Route;


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

Route::resource('ventas', VentasController::class);

Route::get('ventas/payments/{id}', 'VentasController@SaleEmailPayments')->name('ventas.send');
Route::get('sistema-pos', 'VentasController@PosIndex')->name('ventas.pos');
Route::post('pos/Detail/sale/{id}', 'VentasController@TotalProductosPost')->name('pos.detail');

