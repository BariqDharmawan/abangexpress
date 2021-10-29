<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\AboutUs;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\LandingSectionDesc;
use App\Models\OurBranch;
use App\Models\OurContact;
use App\Models\OurService;
use App\Models\OurTeam;
use Illuminate\Http\Request;

class TemplateDuaController extends Controller
{
    public function index(Request $request)
    {
        $menus = Helper::getJson('template-2-menu.json');
        $menus = collect($menus);

        $landingSection = LandingSectionDesc::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->get();

        $aboutUs = AboutUs::where('domain_owner', request()->getSchemeAndHttpHost())
                ->first();

        $ourTeam = OurTeam::where('domain_owner', request()->getSchemeAndHttpHost())
                ->get();

        $faqs = Faq::where('domain_owner', request()->getSchemeAndHttpHost())->get();

        $ourService = OurService::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->orderBy('title', 'asc')->get();

        $ourContactList = Helper::getJson('our-contact-list.json');

        $ourBranch = OurBranch::where('domain_owner', request()->getSchemeAndHttpHost())
                ->get();

        $menus = Helper::removeMenuIfContentEmpty($menus, $ourTeam, '/#our-team');
        $menus = Helper::removeMenuIfContentEmpty($menus, $ourService, '/#services');
        $menus = Helper::removeMenuIfContentEmpty($menus, $ourBranch, '/#our-branch');

        return view('template-2.index', compact(
            'landingSection', 'aboutUs', 'ourBranch',
            'ourTeam', 'aboutUs', 'ourService', 'menus', 'ourContactList'
        ));

    }

    public function gallery()
    {
        $menus = Helper::getJson('template-2-menu.json');
        $menus = collect($menus);

        $galleryImg = Gallery::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['img', '!=', null]
        ])->get();

        $galleryYoutube = Gallery::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['youtube', '!=', null]
        ])->get();

        $landingSection = LandingSectionDesc::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
        ])->get();

        $ourContactList = Helper::getJson('our-contact-list.json');
        // dd($landingSection);

        $aboutUs = AboutUs::where('domain_owner', request()->getSchemeAndHttpHost())
                ->first();

        return view('template-2.gallery', compact(
            'menus', 'galleryYoutube', 'galleryImg', 'landingSection',
            'ourContactList', 'aboutUs'
        ));
    }
}
