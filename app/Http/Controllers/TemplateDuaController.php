<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\AboutUs;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\LandingSectionDesc;
use App\Models\LandingSectionTitle;
use App\Models\OurBranch;
use App\Models\OurContact;
use App\Models\OurService;
use App\Models\OurTeam;
use Illuminate\Http\Request;

class TemplateDuaController extends Controller
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
        $menus = Helper::getJson('template-2-menu.json');
        $menus = collect($menus);

        $sectionTitle = LandingSectionTitle::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();

        $sectionDesc = LandingSectionDesc::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();

        $aboutUs = AboutUs::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();

        $totalOurTeam = $this->getCommonContent()[1]->count();
        $ourTeam = $this->getCommonContent()[1]->get();

        $totalFaqs = $this->getCommonContent()[3]->count();
        $faqs = $this->getCommonContent()[3]->get();

        $totalOurService = $this->getCommonContent()[0]->count();
        $ourService = $this->getCommonContent()[0]->get();

        $ourContact = OurContact::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();

        $totalOurBranch = $this->getCommonContent()[2]->count();
        $ourBranch = $this->getCommonContent()[2]->get();

        $totalGallery = Gallery::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->count();

        // dd($menus);
        $menus = Helper::removeMenuIfContentEmpty($menus, $totalOurTeam, '/#team');
        $menus = Helper::removeMenuIfContentEmpty($menus, $totalOurService, '/#services');
        $menus = Helper::removeMenuIfContentEmpty($menus, $totalFaqs, '/#faq');
        $menus = Helper::removeMenuIfContentEmpty($menus, $totalOurBranch, '/#our-branch');
        $menus = Helper::removeMenuIfContentEmpty($menus, $totalGallery, '/gallery');
        $menus = Helper::removeMenuIfContentEmpty($menus, $ourContact !== null ? 1 : 0, '/#contact');
        $menus = Helper::removeMenuIfContentEmpty($menus, $aboutUs !== null ? 1 : 0, '/#why-us');

        return view('template-2.index', compact(
            'sectionTitle', 'aboutUs', 'ourBranch', 'sectionDesc', 'totalFaqs', 'faqs',
            'ourTeam', 'aboutUs', 'ourService', 'menus', 'ourContact'
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

        $sectionTitle = LandingSectionTitle::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->select('our_contact')->first();

        $ourContact = OurContact::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();

        $aboutUs = AboutUs::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();

        $totalOurTeam = $this->getCommonContent()[1]->count();
        $ourTeam = $this->getCommonContent()[1]->get();

        $totalOurService = $this->getCommonContent()[0]->count();
        $ourService = $this->getCommonContent()[0]->get();

        $totalOurBranch = $this->getCommonContent()[2]->count();
        $ourBranch = $this->getCommonContent()[2]->get();

        $menus = Helper::removeMenuIfContentEmpty($menus, $ourTeam, '/#our-team');
        $menus = Helper::removeMenuIfContentEmpty($menus, $ourService, '/#services');
        $menus = Helper::removeMenuIfContentEmpty($menus, $ourBranch, '/#our-branch');
        $menus = Helper::removeMenuIfContentEmpty($menus, $aboutUs, '/#why-us');

        return view('template-2.gallery', compact(
            'menus', 'galleryYoutube', 'galleryImg', 'sectionTitle',
            'ourContact', 'aboutUs'
        ));
    }
}
