<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('faq','FaqController');

// Route::put('our-contact', 'OurContactController@update')->name('our-contact.update');
Route::apiResource('our-contact','OurContactController')->only(['index']);

// Route::put('identity/embed-map', 'AboutUsController@updateEmbedMap')->name(
//     'about-us.update-embed-map'
// );

Route::apiResource('our-service','OurServiceController');
Route::apiResource('our-team','OurTeamController');
Route::apiResource('our-client','OurClientController');

Route::get('vision-mission', 'AboutUsController@getVisionMission');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
