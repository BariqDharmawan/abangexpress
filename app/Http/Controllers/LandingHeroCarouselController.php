<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\FirstHeroCarouselLanding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LandingHeroCarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heroCarousel = FirstHeroCarouselLanding::all();
        return view('admin.hero-carousel.manage', compact('heroCarousel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'img' => ['required', 'mimes:png,jpg,jpeg']
        ]);
        
        $heroCarousel = $request->file('img');
        $pathHeroCarousel = Storage::putFile('public/hero-carousel', $heroCarousel);

        FirstHeroCarouselLanding::create([
            'img' => Str::replaceFirst('public/', '/storage/', $pathHeroCarousel)
        ]);

        return Helper::returnSuccess('add new hero');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carouselToDelete = FirstHeroCarouselLanding::findOrFail($id);
        $carouselToDelete->delete();
        return Helper::returnSuccess('remove slide');
    }
}