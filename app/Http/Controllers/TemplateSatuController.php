<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\AboutUs;
use App\Models\Faq;
use App\Models\FirstHeroCarouselLanding;
use App\Models\Gallery;
use App\Models\LandingSectionDesc;
use App\Models\OurBranch;
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

        $ourBranch = OurBranch::where('domain_owner', request()->getSchemeAndHttpHost())
                ->get();

        $menus = Helper::removeMenuIfContentEmpty($menus, $ourTeam, '/#our-team');
        $menus = Helper::removeMenuIfContentEmpty($menus, $ourService, '/#services');
        $menus = Helper::removeMenuIfContentEmpty($menus, $ourBranch, '/#our-branch');

        $ourContact = OurContact::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();

        // dd($menus[6]);

        return view('template-1.index', compact(
            'firstWordAppName', 'heroCarousel', 'menus', 'aboutUs',
            'ourService', 'ourTeam', 'ourContact', 'landingSection', 'ourBranch'
        ));
    }

    public function aboutUs()
    {
        $menus = Helper::getJson('template-1-menu.json');
        $menus = collect($menus);

        $aboutUs = AboutUs::where('domain_owner', request()->getSchemeAndHttpHost())
                ->first();

        $landingSection = LandingSectionDesc::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['id', 1]
        ])->orWhere([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['id', 7]
        ])->get();

        return view('template-1.about', compact('landingSection', 'menus', 'aboutUs'));
    }

    public function gallery()
    {
        $menus = Helper::getJson('template-1-menu.json');
        $menus = collect($menus);

        $galleryImg = Gallery::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['img', '!=', null]
        ])->get();

        $galleryYoutube = Gallery::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['youtube', '!=', null]
        ])->get();

        $sectionName = LandingSectionDesc::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['id', 7]
        ])->first()->section_name;

        return view('template-1.gallery', compact(
            'menus', 'galleryYoutube', 'galleryImg', 'sectionName'
        ));
    }
}
