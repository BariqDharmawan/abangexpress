<?php

namespace App\Providers;

use App\Models\AboutUs;
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
        try {
            $ourSocial = OurSocial::all();
            $ourName = AboutUs::select('our_name')->first()->our_name;

            View::share('ourName', $ourName);
            View::share('ourSocial', $ourSocial);
        } catch (\Throwable $th) {}
    }
}
