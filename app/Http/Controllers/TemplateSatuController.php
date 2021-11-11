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

        return [$ourService, $ourTeam, $ourBranch, $faqs];
    }

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

        $aboutUs = AboutUs::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();

        $totalOurService = $this->getCommonContent()[0]->count();
        $ourService = $this->getCommonContent()[0]->get();

        $totalOurTeam = $this->getCommonContent()[1]->count();
        $ourTeam = $this->getCommonContent()[1]->get();

        $totalOurBranch = $this->getCommonContent()[2]->count();
        $ourBranch = $this->getCommonContent()[2]->get();

        $totalFaqs = $this->getCommonContent()[3]->count();
        $faqs = $this->getCommonContent()[3]->get();

        $menus = Helper::removeMenuIfContentEmpty($menus, $totalOurTeam, '/#our-team');
        $menus = Helper::removeMenuIfContentEmpty($menus, $totalOurService, '/#services');
        $menus = Helper::removeMenuIfContentEmpty($menus, $totalOurBranch, '/#our-branch');
        $menus = Helper::removeMenuIfContentEmpty($menus, $totalFaqs, '/#faq');

        $ourContact = OurContact::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();

        return view('template-1.index', compact(
            'heroCarousel', 'menus', 'aboutUs', 'sectionDesc', 'faqs',
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

        $totalOurService = $this->getCommonContent()[0]->count();
        $totalOurTeam = $this->getCommonContent()[1]->count();
        $totalOurBranch = $this->getCommonContent()[2]->count();
        $totalFaqs = $this->getCommonContent()[3]->count();

        $menus = Helper::removeMenuIfContentEmpty($menus, $totalOurService, '/#our-team');
        $menus = Helper::removeMenuIfContentEmpty($menus, $totalOurTeam, '/#services');
        $menus = Helper::removeMenuIfContentEmpty($menus, $totalOurBranch, '/#our-branch');
        $menus = Helper::removeMenuIfContentEmpty($menus, $totalFaqs, '/#faq');

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

        $totalOurService = $this->getCommonContent()[0]->count();
        $totalOurTeam = $this->getCommonContent()[1]->count();
        $totalOurBranch = $this->getCommonContent()[2]->count();
        $totalFaqs = $this->getCommonContent()[3]->count();

        $menus = Helper::removeMenuIfContentEmpty($menus, $totalOurService, '/#our-team');
        $menus = Helper::removeMenuIfContentEmpty($menus, $totalOurTeam, '/#services');
        $menus = Helper::removeMenuIfContentEmpty($menus, $totalOurBranch, '/#our-branch');
        $menus = Helper::removeMenuIfContentEmpty($menus, $totalFaqs, '/#faq');

        return view('template-1.gallery', compact(
            'menus', 'galleryYoutube', 'galleryImg', 'sectionTitle', 'aboutUs'
        ));
    }
}
