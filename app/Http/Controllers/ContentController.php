<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\FirstHeroCarouselLanding;
use App\Models\LandingSectionDesc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function coverVisionMission()
    {
        $cover = AboutUs::select('cover_vision_mission')->first()->cover_vision_mission;
        return view('admin.cover-vision-mission.manage', compact('cover'));
    }

    public function heroCarousel()
    {
        $heroCarousel = FirstHeroCarouselLanding::all();
        return view('admin.hero-carousel.manage', compact('heroCarousel'));
    }

    public function addNewHeroCarousel(Request $request)
    {
        $request->validate([
            'img' => ['required', 'mimes:png,jpg,jpeg']
        ]);
        
        $heroCarousel = $request->file('img');
        $pathHeroCarousel = Storage::putFile('public/hero-carousel', $heroCarousel);

        FirstHeroCarouselLanding::create([
            'img' => Str::replaceFirst('public/', '/storage/', $pathHeroCarousel)
        ]);

        return redirect()->back()->with('success', 'Successfully add new hero');
    }

    public function destroyHeroCarousel($id)
    {
        FirstHeroCarouselLanding::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Successfully remove slide');
    }
    
    public function sectionHeading()
    {
        $sectionHeading = LandingSectionDesc::all();
        return view('admin.section-heading.manage', compact('sectionHeading'));
    }

}
