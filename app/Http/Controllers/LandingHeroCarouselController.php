<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\FirstHeroCarouselLanding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LandingHeroCarouselController extends Controller
{
    
    public function index()
    {
        $heroCarousel = FirstHeroCarouselLanding::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->get();
        return view('admin.contents.hero-carousel', compact('heroCarousel'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'img' => ['required', 'mimes:png,jpg,jpeg']
        ]);
        
        $heroCarousel = $request->file('img');
        $pathHeroCarousel = Storage::putFile('public/hero-carousel', $heroCarousel);

        FirstHeroCarouselLanding::create([
            'img' => Str::replaceFirst('public/', '/storage/', $pathHeroCarousel),
            'domain_owner' => request()->getSchemeAndHttpHost()
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
        $carouselToDelete = FirstHeroCarouselLanding::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['id', $id]
        ])->firstOrFail();

        $carouselToDelete->delete();
        return Helper::returnSuccess('remove slide');
    }
}
