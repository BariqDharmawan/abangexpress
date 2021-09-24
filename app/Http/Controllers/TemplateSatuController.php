<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\AboutUs;
use App\Models\Faq;
use App\Models\OurContact;
use App\Models\OurService;
use App\Models\OurTeam;
use Illuminate\Http\Request;

class TemplateSatuController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $heroCarousel = Helper::getJson('dummy/carousel.json');
        $menus = Helper::getJson('template-1-menu.json');

        $aboutUs = AboutUs::first();
        $firstWordAppName = strtok($aboutUs->our_name, ' ');

        $ourService = OurService::orderBy('title', 'asc')->get();

        $ourTeam = OurTeam::all();

        $faqs = Faq::all();

        $ourContact = OurContact::first();

        return view('template-1.index', compact(
            'firstWordAppName', 'heroCarousel', 'menus', 'aboutUs', 
            'ourService', 'ourTeam', 'faqs', 'ourContact'
        ));
    }
}
