<?php

namespace App\Providers;

use App\Models\OurSocial;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('dataPage1', 'template 2');
        try {
            $ourSocial = OurSocial::all();
            // dd($ourSocial);
            View::share('ourSocial', $ourSocial);
        } catch (\Throwable $th) {}
    }
}
