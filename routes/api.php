<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('faq','FaqController');

Route::apiResource('our-contact','OurContactController')->only(['index']);

Route::apiResource('our-service','OurServiceController');
Route::apiResource('our-team','OurTeamController');

Route::get('vision-mission', 'AboutUsController@getVisionMission');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
