<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' =>['auth'], 'prefix'=>'Transit'],function () { //viagens

    //RESOURCE (conjunto de métodos)
    Route::resource('TransitPlans',\App\Http\Controllers\API\TransitPlansController::class);
    Route::resource('TransitReceivers',\App\Http\Controllers\API\TransitReceiversController::class);

    //GET (requisições)
    Route::get('/seachByUserId/{user_id}', [\App\Http\Controllers\API\TransitPlansController::class,'seachByUserId']);
    Route::get('/stopPointListByRoute/{route_id}', [\App\Http\Controllers\API\TransitReceiversController::class,'stopPointListByRoute']);

});


Route::group(['middleware' =>['auth'], 'prefix'=>'Message'],function () { //mensagens

});
