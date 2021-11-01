<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin', 'checkDomain'])
->group(function() {

    Route::resource('gallery', 'GalleryController');

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

        Route::get('our-social', 'OurSocialController@manage')->name(
            'our-social.manage'
        );
        Route::resource('our-social', 'OurSocialController')->except('index');

        Route::get('contacts/manage', 'OurContactController@manage')->name(
            'contact.manage'
        );
        Route::resource('contacts', 'OurContactController');
    });


    Route::get('services', 'OurServiceController@manage')->name('service.manage');
    Route::resource('services', 'OurServiceController')->except('index');

    Route::resource('branch', 'OurBranchController')->except('create', 'edit');

    Route::get('team/manage', 'OurTeamController@manage')->name('team.manage');
    Route::resource('team', 'OurTeamController');

    Route::get('faq/manage', 'FaqController@manage')->name('faq.manage');
    Route::resource('faq', 'FaqController')->except('index');

    Route::put('our-contact', 'OurContactController@update')->name('our-contact.update');

    Route::prefix('content')->name('content.')->group(function (){
        Route::resource('landing-carousel', 'LandingHeroCarouselController')->only(
            'store', 'destroy'
        );

        Route::put('section-heading', 'LandingSectionController@update')->name('section-heading.update');

    });
});
