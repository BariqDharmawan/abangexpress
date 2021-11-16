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

    private function getCommonContent()
    {
        $ourService = OurService::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->orderBy('title', 'asc');
        $ourTeam = OurTeam::where('domain_owner', request()->getSchemeAndHttpHost());
        $ourBranch = OurBranch::where('domain_owner', request()->getSchemeAndHttpHost());
        $faqs = Faq::where('domain_owner', request()->getSchemeAndHttpHost());

        $totalGalleries = Gallery::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->count();

        $totalOurContact = OurContact::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->count();

        $menus = Helper::getJson('template-1-menu.json');
        $menus = collect($menus);

        $menus = Helper::removeMenuIfContentEmpty($menus, $ourTeam->count(), '/#our-team');
        $menus = Helper::removeMenuIfContentEmpty($menus, $ourService->count(), '/#services');
        $menus = Helper::removeMenuIfContentEmpty($menus, $ourBranch->count(), '/#our-branch');
        $menus = Helper::removeMenuIfContentEmpty($menus, $faqs->count(), '/#faq');
        $menus = Helper::removeMenuIfContentEmpty($menus, $totalGalleries, '/gallery');
        $menus = Helper::removeMenuIfContentEmpty($menus, $totalOurContact, '/#contact');

        return [$ourService, $ourTeam, $ourBranch, $faqs, $menus];
    }

    public function index(Request $request)
    {
        $sectionTitle = LandingSectionTitle::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();

        $sectionDesc = LandingSectionDesc::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->get();

        $heroCarousel = FirstHeroCarouselLanding::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->get();

        $aboutUs = AboutUs::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();

        $ourService = $this->getCommonContent()[0]->get();
        $ourTeam = $this->getCommonContent()[1]->get();
        $ourBranch = $this->getCommonContent()[2]->get();
        $faqs = $this->getCommonContent()[3]->get();

        $menus = $this->getCommonContent()[4];

        return view('template-1.index', compact(
            'heroCarousel', 'menus', 'aboutUs', 'sectionDesc', 'faqs',
            'ourService', 'ourTeam', 'sectionTitle', 'ourBranch'
        ));
    }

    public function aboutUs()
    {
        $aboutUs = AboutUs::where('domain_owner', request()->getSchemeAndHttpHost())->first();

        $sectionTitle = LandingSectionTitle::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->select('about_us', 'our_contact')->first();
        $sectionDesc = LandingSectionDesc::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->select('first_desc_about_us')->first()->first_desc_about_us;

        $menus = $this->getCommonContent()[4];

        return view('template-1.about', compact('menus', 'aboutUs', 'sectionTitle', 'sectionDesc'));
    }

    public function gallery()
    {
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

        $menus = $this->getCommonContent()[4];

        return view('template-1.gallery', compact(
            'menus', 'galleryYoutube', 'galleryImg', 'sectionTitle', 'aboutUs'
        ));
    }
}
