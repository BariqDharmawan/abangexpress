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
            $ourSocial = OurSocial::where(
                'domain_owner', request()->getSchemeAndHttpHost()
            )->get();
            $ourName = AboutUs::select('our_name')->where(
                'domain_owner', request()->getSchemeAndHttpHost()
            )->first()->our_name ?? config('app.name');

            View::share('ourName', $ourName);
            View::share('ourSocial', $ourSocial);
        } catch (\Throwable $th) {}
    }
}
