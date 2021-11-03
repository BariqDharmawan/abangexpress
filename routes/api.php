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

// Route::post('zipcode-list/{tableName}', function (Request $request, $tableName){

//     $zipcode = DB::connection('mysql2')->table($tableName)->get();

//     return response()->json($zipcode);
// })->name('zipcode-list');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
