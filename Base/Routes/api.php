<?php

use Illuminate\Http\Request;
use Modules\Base\Http\Controllers\PaymentGatewayController;
use Modules\Base\Http\Resources\ApiCityCountry;
use Modules\Base\Http\Resources\ApiCountry;
use Modules\Base\Http\Resources\ApiStatesCountry;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('pais', function () {
    return new ApiCountry(null);
});

Route::get('estado/{id}', function ($id) {
    return new ApiStatesCountry($id);
});

Route::get('ciudad/{id}', function ($id) {
    return new ApiCityCountry($id);
});

Route::get('PaymentGateway/PayU', [PaymentGatewayController::class, 'store']);
