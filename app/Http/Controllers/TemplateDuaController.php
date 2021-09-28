<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Faq;
use App\Models\LandingSectionDesc;
use App\Models\OurContact;
use App\Models\OurTeam;
use Illuminate\Http\Request;

class TemplateDuaController extends Controller
{
    public function __invoke(Request $request)
    {
        $landingSection = LandingSectionDesc::all();
        $aboutUs = AboutUs::first();

        $ourTeam = OurTeam::all();
        
        $faqs = Faq::all();

        $isProfileVideoExist = $aboutUs->our_video ? true : false;

        return view('template-2.index', compact(
            'landingSection', 'aboutUs', 'isProfileVideoExist', 
            'ourTeam', 'aboutUs'
        ));
    }
}
