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
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('identity', 'AboutUsController@identity')->name('about-us.identity');
    Route::put('identity', 'AboutUsController@update')->name('about-us.update');
    Route::put('identity/embed-map', 'AboutUsController@updateEmbedMap')->name(
        'about-us.update-embed-map'
    );

    Route::get('our-social', 'OurSocialController@manage')->name('our-social.manage');
    Route::resource('our-social', 'OurSocialController')->except('index');
    
    Route::get('services', 'OurServiceController@manage')->name('service.manage');
    
    Route::get('clients', 'OurClientController@manage')->name('client.manage');

    Route::get('team/manage', 'OurTeamController@manage')->name('team.manage');
    Route::resource('team', 'OurTeamController');

    Route::get('faq/manage', 'FaqController@manage')->name('faq.manage');
    Route::resource('faq', 'FaqController');

    Route::get('contacts/manage', 'OurContactController@manage')->name('contact.manage');
    Route::resource('contacts', 'OurContactController');

    Route::put('our-contact', 'OurContactController@update')->name('our-contact.update');

    Route::prefix('content')->name('content.')->group(function (){
        Route::get('cover-vision-mission', 'ContentController@coverVisionMission')->name(
            'cover-vission-mission'
        );
        Route::put('cover-vision-mission', 'ContentController@addNewCoverVisionMission')
        ->name('cover-vission-mission.store');

        Route::get('carousel', 'ContentController@heroCarousel')->name('carousel');
        Route::post('carousel', 'ContentController@addNewHeroCarousel')->name(
            'carousel.store'
        );
        Route::delete('carousel/{id}', 'ContentController@destroyHeroCarousel')->name(
            'carousel.destroy'
        );

        Route::get('section-heading', 'ContentController@sectionHeading')->name(
            'section-heading'
        );
        Route::put('section-heading/{id}', 'ContentController@changeSectionHeading')->name(
            'section-heading.update'
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
