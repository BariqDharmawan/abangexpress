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

        $galleries = Gallery::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        );

        $menus = Helper::getJson('template-2-menu.json');
        $menus = collect($menus);

        $menus = Helper::removeMenuIfContentEmpty($menus, $ourTeam->count(), '/#our-team');
        $menus = Helper::removeMenuIfContentEmpty($menus, $ourService->count(), '/#services');
        $menus = Helper::removeMenuIfContentEmpty($menus, $ourBranch->count(), '/#our-branch');
        $menus = Helper::removeMenuIfContentEmpty($menus, $faqs->count(), '/#faq');
        $menus = Helper::removeMenuIfContentEmpty($menus, $galleries->count(), '/gallery');

        return [$ourService, $ourTeam, $ourBranch, $faqs, $menus];
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


        $ourService = $this->getCommonContent()[0]->get();
        $ourTeam = $this->getCommonContent()[1]->get();
        $ourBranch = $this->getCommonContent()[2]->get();

        $faqs = $this->getCommonContent()[3]->get();
        $totalFaqs = $this->getCommonContent()[3]->count();

        $menus = $this->getCommonContent()[4];

        return view('template-2.index', compact(
            'sectionTitle', 'aboutUs', 'ourBranch', 'sectionDesc', 'totalFaqs', 'faqs',
            'ourTeam', 'aboutUs', 'ourService', 'menus'
        ));

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

        $aboutUs = AboutUs::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();

        $menus = $this->getCommonContent()[4];

        return view('template-2.gallery', compact(
            'menus', 'galleryYoutube', 'galleryImg', 'sectionTitle', 'aboutUs'
        ));
    }
}
