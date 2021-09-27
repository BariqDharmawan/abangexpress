<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\LandingSectionDesc;
use App\Models\OurContact;
use Illuminate\Http\Request;

class TemplateDuaController extends Controller
{
    public function __invoke(Request $request)
    {
        $landingSection = LandingSectionDesc::all();
        $aboutUs = AboutUs::first();

        $ourContact = OurContact::first();

        return view('template-2.index', compact(
            'landingSection', 'aboutUs', 'ourContact'
        ));
    }
}
