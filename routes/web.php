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
    Route::get('dashboard', 'DashboardController@index');
});

Route::prefix('template-1')->name('template-1.')->group(function() {
    Route::get('/', 'TemplateSatuController');
});

Route::prefix('template-2')->name('template-2.')->group(function() {
    
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
