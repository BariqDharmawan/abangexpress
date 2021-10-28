<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\AboutUs;
use App\Models\Faq;
use App\Models\FirstHeroCarouselLanding;
use App\Models\LandingSectionDesc;
use App\Models\OurContact;
use App\Models\OurService;
use App\Models\OurTeam;
use Illuminate\Http\Request;

class TemplateSatuController extends Controller
{

    public function index(Request $request)
    {
        $menus = Helper::getJson('template-1-menu.json');
        $menus = collect($menus);

        $landingSection = LandingSectionDesc::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->get();

        $heroCarousel = FirstHeroCarouselLanding::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->get();

        $aboutUs = AboutUs::where('domain_owner', request()->getSchemeAndHttpHost())
                ->first();

        $firstWordAppName = '';
        if ($aboutUs) {
            $firstWordAppName = strtok($aboutUs->our_name, ' ');
        }

        $ourService = OurService::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->orderBy('title', 'asc')->get();

        $ourTeam = OurTeam::where('domain_owner', request()->getSchemeAndHttpHost())
                ->get();

        if (count($ourTeam) == 0) {
            $menus = $menus->filter(function ($menu){
                return $menu->url != '#our-team';
            });
        }
        if (count($ourService) == 0) {
            $menus = $menus->filter(function ($menu){
                return $menu->url != '#services';
            });
        }
        if (count($ourService) == 0) {
            $menus = $menus->filter(function ($menu){
                return $menu->url != '#services';
            });
        }

        $ourContact = OurContact::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();

        return view('template-1.index', compact(
            'firstWordAppName', 'heroCarousel', 'menus', 'aboutUs',
            'ourService', 'ourTeam', 'ourContact', 'landingSection'
        ));
    }

    public function aboutUs()
    {
        $menus = Helper::getJson('template-1-menu.json');
        $menus = collect($menus);

        $aboutUs = AboutUs::where('domain_owner', request()->getSchemeAndHttpHost())
                ->first();

        $landingSection = LandingSectionDesc::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->get();

        return view('about', compact('landingSection', 'menus', 'aboutUs'));
    }
}
