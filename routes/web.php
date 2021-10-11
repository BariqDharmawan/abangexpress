<?php

use App\Models\TemplateChoosen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('shipping')->name('shipping.')->middleware('auth')->group(function (){
    Route::get('/', 'ShipmentController@index')->name('index');
    Route::get('zipcode', 'ShipmentController@zipCode')->name('zipcode');
    Route::prefix('order')->name('order.')->group(function (){
        Route::get('book', 'ShipmentOrderController@book')->name('book');
        Route::get('/', 'ShipmentOrderController@index')->name('index');
        Route::get('process', 'ShipmentOrderController@process')->name('process');
        Route::get('pending', 'ShipmentOrderController@pending')->name('pending');
        Route::get('history', 'ShipmentOrderController@history')->name('history');
        Route::get('receipt', 'ShipmentOrderController@receipt')->name('receipt');
    });
    Route::prefix('invoices')->name('invoice.')->group(function (){
        Route::get('bill', 'ShipmentInvoiceController@bill')->name('bill');
        Route::get('verifying', 'ShipmentInvoiceController@verifying')->name(
            'verifying'
        );
        Route::get('settled', 'ShipmentInvoiceController@settled')->name('settled');
    });
    Route::prefix('support')->name('support.')->group(function (){
        Route::get('guide', 'ShipmentSupportController@guide')->name('guide');
        Route::get('regulation', 'ShipmentSupportController@regulation')->name(
            'regulation'
        );
    });
});

Route::prefix('admin')->name('admin.')->middleware('roleUser:admin')->group(function() {
    

    Route::resource('user', 'UserController')->except('edit', 'show', 'create');
    
    Route::prefix('about-us')->group(function (){
        
        Route::prefix('identity')->name('about-us.')->group(function () {
            Route::get('/', 'AboutUsController@identity')->name('identity');
            Route::put('/', 'AboutUsController@update')->name('update');
            Route::put('embed-map', 'AboutUsController@updateEmbedMap')->name(
               'update-embed-map'
            );
        });

        Route::get('our-social', 'OurSocialController@manage')->name(
            'our-social.manage'
        );
        Route::resource('our-social', 'OurSocialController')->except('index');

        Route::get('contacts/manage', 'OurContactController@manage')->name('contact.manage');
        Route::resource('contacts', 'OurContactController');
    });

    
    Route::get('services', 'OurServiceController@manage')->name('service.manage');
    Route::resource('services', 'OurServiceController')->except('index');

    Route::get('team/manage', 'OurTeamController@manage')->name('team.manage');
    Route::resource('team', 'OurTeamController');

    Route::get('faq/manage', 'FaqController@manage')->name('faq.manage');
    Route::resource('faq', 'FaqController')->except('index');

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

// $templateChoosen = 'template-1.';
try {
    $templateChoosen = TemplateChoosen::where(
        'domain_owner', request()->getSchemeAndHttpHost()
    )->first();
    
    $templateChoosen = (int)$templateChoosen->version;
    
    if ($templateChoosen == 1) {
        Route::get('/', 'TemplateSatuController');
    }
    else {
        Route::get('/', 'TemplateDuaController');
    }
} catch (\Throwable $th) {}



Auth::routes(['register' => false]);

require __DIR__.'/auth.php';