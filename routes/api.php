<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::apiResource('faq','FaqController');

Route::apiResource('our-contact','OurContactController')->only(['index']);

Route::apiResource('our-service','OurServiceController');

Route::get('vision-mission', 'AboutUsController@getVisionMission');

Route::get('previous-recipient/{id}', 'ShipmentOrderController@dummyPreviousRecipient');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
