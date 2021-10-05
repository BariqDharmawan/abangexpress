<?php

use Illuminate\Support\Facades\Auth;
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

Route::redirect('/', 'template-1', 301);

Route::prefix('admin')->name('admin.')->group(function() {

    Route::redirect('dashboard', 'identity', 301);

    Route::prefix('identity')->name('about-us.')->group(function () {
       Route::get('/', 'AboutUsController@identity')->name('identity');
       Route::put('/', 'AboutUsController@update')->name('update');
       Route::put('embed-map', 'AboutUsController@updateEmbedMap')->name('update-embed-map');
    });

    Route::get('our-social', 'OurSocialController@manage')->name('our-social.manage');
    Route::resource('our-social', 'OurSocialController')->except('index');
    
    Route::get('services', 'OurServiceController@manage')->name('service.manage');
    Route::resource('services', 'OurServiceController')->except('index');

    Route::get('team/manage', 'OurTeamController@manage')->name('team.manage');
    Route::resource('team', 'OurTeamController');

    Route::get('faq/manage', 'FaqController@manage')->name('faq.manage');
    Route::resource('faq', 'FaqController')->except('index');

    Route::get('contacts/manage', 'OurContactController@manage')->name('contact.manage');
    Route::resource('contacts', 'OurContactController');

    Route::put('our-contact', 'OurContactController@update')->name('our-contact.update');

    Route::prefix('content')->name('content.')->group(function (){
        Route::prefix('cover-vision-mission')->name('cover-vision-mission.')
        ->group(function () {
            Route::get('/', 'CoverVisionMissionController@index')->name('index');
            Route::put('/', 'CoverVisionMissionController@update')->name('update');
        });

        Route::resource('landing-carousel', 'LandingHeroCarouselController')->except(
            'create', 'show', 'edit', 'update'
        );

        Route::resource('section-heading', 'LandingSectionController')->only(
            'index', 'update'
        );

    });
});

Route::prefix('template-1')->name('template-1.')->group(function() {
    Route::get('/', 'TemplateSatuController');
});

Route::prefix('template-2')->name('template-2.')->group(function() {
    Route::get('/', 'TemplateDuaController');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
