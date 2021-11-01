<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\AboutUs;
use App\Models\Faq;
use App\Models\FirstHeroCarouselLanding;
use App\Models\Gallery;
use App\Models\LandingSectionDesc;
use App\Models\LandingSectionTitle;
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

        $sectionTitle = LandingSectionTitle::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();

        $sectionDesc = LandingSectionDesc::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->get();

        $heroCarousel = FirstHeroCarouselLanding::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->get();

        $aboutUs = AboutUs::where('domain_owner', request()->getSchemeAndHttpHost())
                ->first();

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

        return view('template-1.index', compact(
            'heroCarousel', 'menus', 'aboutUs', 'sectionDesc',
            'ourService', 'ourTeam', 'ourContact', 'sectionTitle', 'ourBranch'
        ));
    }

    public function aboutUs()
    {
        $menus = Helper::getJson('template-1-menu.json');
        $menus = collect($menus);

        $aboutUs = AboutUs::where('domain_owner', request()->getSchemeAndHttpHost())->first();

        $sectionTitle = LandingSectionTitle::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->select('about_us', 'our_contact')->first();
        $sectionDesc = LandingSectionDesc::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->select('first_desc_about_us')->first()->first_desc_about_us;

        return view('template-1.about', compact('menus', 'aboutUs', 'sectionTitle', 'sectionDesc'));
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

        $sectionTitle = LandingSectionTitle::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->select('our_contact')->first();

        $aboutUs = AboutUs::where('domain_owner', request()->getSchemeAndHttpHost())->select('our_name')->first();

        return view('template-1.gallery', compact(
            'menus', 'galleryYoutube', 'galleryImg', 'sectionTitle', 'aboutUs'
        ));
    }
}
