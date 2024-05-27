<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Api Routes with the following format = api/v1
// and protect our endpoints with sanctum
Route::group(['prefix'=> 'v1', 'namespace'=>'App\Http\Controllers\Api\V1', 'auth:sanctum'], function () {
    Route::apiResource('customers',CustomerController::class);
    Route::apiResource('invoices', InvoiceController::class);
    //route for the bulk store
    Route::post('invoices/bulk',['uses'=>'InvoiceController@bulkStore']);
});
