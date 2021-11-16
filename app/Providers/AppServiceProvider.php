<?php

namespace App\Providers;

use App\Models\AboutUs;
use App\Models\OurContact;
use App\Models\OurSocial;
use App\Models\TemplateChoosen;
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

            $templateChoosen = TemplateChoosen::select('version')->where(
                'domain_owner', request()->getSchemeAndHttpHost()
            )->first();

            $ourContact = OurContact::where(
                'domain_owner', request()->getSchemeAndHttpHost()
            )->first();

            View::share('ourName', $ourName);
            View::share('ourSocial', $ourSocial);
            View::share('templateChoosen', $templateChoosen);
            View::share('ourContact', $ourContact);
        } catch (\Throwable $th) {}
    }
}
