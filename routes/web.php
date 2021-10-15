<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'template-1', 301);

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function() {

    // PULL DATA CONSIGNEE
    Route::get('pullPenerima/{id}', 'BookingOrderController@ambilPenerima');


    Route::get('book', 'BookingOrderController@index')->name('book');
    Route::get('book/invoice', 'BookingOrderController@invoice')->name(
        'book.invoice'
    );
    Route::post('book/invoice', 'BookingOrderController@storeInvoice');
    Route::post('book/invoice/save', 'BookingOrderController@store');

    Route::post('book/step-order', 'BookingOrderController@order')->name(
        'book.step-order'
    );

    Route::post('/', 'ShipmentOrderController@filterOrder')->name(
        'filter.order'
    );
    Route::post('/history', 'ShipmentOrderController@filterHistory')->name(
        'filter.history'
    );

    Route::resource('book', 'BookingOrderController')->except('index', 'show');
    Route::get('/', 'ShipmentOrderController@index')->name('index');
    Route::resource('order', 'ShipmentOrderController')->except('store');

    Route::get('process', 'ShipmentOrderController@process')->name('process');
    Route::get('pending', 'ShipmentOrderController@pending')->name('pending');
    Route::get('history', 'ShipmentOrderController@history')->name('history');
    Route::get('receipt', 'ShipmentOrderController@receipt')->name('receipt');

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

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function() {
    Route::resource('home', 'HomeController')->except('update');
    Route::put('home/update', 'HomeController@update')->name('home.update');

    Route::resource('user', 'UserController')->except('edit', 'show', 'create');

    
    Route::prefix('about-us')->group(function (){
        
        Route::prefix('identity')->name('about-us.')->group(function () {
            Route::get('/', 'AboutUsController@identity')->name('identity');
            Route::put('/', 'AboutUsController@update')->name('update');
            Route::put('embed-map', 'AboutUsController@updateEmbedMap')->name(
               'update-embed-map'
            );
        });

        Route::get('our-social', 'OurSocialController@manage')->name('our-social.manage');
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
        Route::resource('landing-carousel', 'LandingHeroCarouselController')->only(
            'store', 'destroy'
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

Auth::routes(['register' => false]);

require __DIR__.'/auth.php';