<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\AboutUs;
use App\Models\Faq;
use App\Models\LandingSectionDesc;
use App\Models\OurContact;
use App\Models\OurService;
use App\Models\OurTeam;
use Illuminate\Http\Request;

class TemplateDuaController extends Controller
{
    public function __invoke(Request $request)
    {
        $menus = Helper::getJson('template-2-menu.json');

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

        $isProfileVideoExist = $aboutUs->our_video ? true : false;

        return view('template-2.index', compact(
            'landingSection', 'aboutUs', 'isProfileVideoExist', 
            'ourTeam', 'aboutUs', 'ourService', 'menus'
        ));
    }
}
