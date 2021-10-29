<?php

use App\Models\TemplateChoosen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::resource('tracking-order', 'TrackingOrderController');

Route::get('tentang-kami', 'TemplateSatuController@aboutUs');
Route::get('gallery', 'TemplateSatuController@gallery')->name('gallery');

Route::prefix('shipping')->name('shipping.')->middleware('auth')->group(function (){
    Route::get('/', 'ShipmentController@index')->name('index');
    Route::get('zipcode', 'ShipmentController@zipCode')->name('zipcode');
    Route::prefix('order')->name('order.')->group(function (){

        Route::get('/', 'ShipmentOrderController@index')->name('index');
        Route::post('/', 'ShipmentOrderController@filterOrder')->name('filter.order');
        Route::post('history', 'ShipmentOrderController@filterHistory')->name(
            'filter.history'
        );
        Route::post('/cancel', 'ShipmentOrderController@cancelOrder')->name('cancel.order');

        Route::get('process', 'ShipmentOrderController@process')->name('process');
        Route::get('pending', 'ShipmentOrderController@pending')->name('pending');
        Route::get('history', 'ShipmentOrderController@history')->name('history');
        Route::get('receipt', 'ShipmentOrderController@receipt')->name('receipt');

        // PULL DATA CONSIGNEE
        Route::get('get-recipient/{id}', 'BookingOrderController@ambilPenerima')->name(
            'get-recipient'
        );

        Route::match(['GET', 'POST'], 'print', 'BookingOrderController@prints')
        ->name('print');

        Route::get('book', 'BookingOrderController@index')->name('book');
        Route::get('book/invoice', 'BookingOrderController@invoice')->name(
            'book.invoice'
        );
        Route::post('book/invoice', 'BookingOrderController@storeInvoice')->name(
            'book.save-invoice'
        );
        Route::post('book/invoice/save', 'BookingOrderController@store')->name(
            'book.invoice.save'
        );

        Route::post('book/step-order', 'BookingOrderController@order')->name(
            'book.step-order'
        );
        Route::resource('book', 'BookingOrderController')->except('show');

        // Route::prefix('book')->name('book.')->group(function (){
        //     Route::get('/', 'BookingOrderController@index')->name('index');
        //     Route::get('/invoice', 'BookingOrderController@invoice')->name(
        //         'invoice'
        //     );
        //     Route::post('/invoice', 'BookingOrderController@storeInvoice')->name(
        //         'save-invoice'
        //     );
        //     Route::post('/invoice/save', 'BookingOrderController@store')->name(
        //         'invoice.save'
        //     );

        //     Route::post('/step-order', 'BookingOrderController@order')->name(
        //         'book.step-order'
        //     );
        // });

    });

    Route::prefix('support')->name('support.')->group(function (){
        Route::get('guide', 'ShipmentSupportController@guide')->name('guide');
        Route::get('regulation', 'ShipmentSupportController@regulation')->name(
            'regulation'
        );
    });

    Route::prefix('invoices')->name('invoice.')->group(function (){
        Route::get('bill', 'ShipmentInvoiceController@bill')->name('bill');

        Route::get('pay/{invoiceNumber}', 'InvoicePayingController@index')->name(
            'pay.index'
        );
        Route::post('pay/store/{invoiceNumber}', 'InvoicePayingController@store')->name(
            'pay.store'
        );

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

// $templateChoosen = 'template-1.';
try {
    $templateChoosen = TemplateChoosen::where(
        'domain_owner', request()->getSchemeAndHttpHost()
    )->first();

    $templateChoosen = (int)$templateChoosen->version;

    if ($templateChoosen == 1) {
        Route::get('/', 'TemplateSatuController@index');
    }
    else {
        Route::get('/', 'TemplateDuaController');
    }
} catch (\Throwable $th) {}

Auth::routes(['register' => false]);

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
