<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\StoreLandingCarouselValidation;
use App\Models\FirstHeroCarouselLanding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LandingHeroCarouselController extends Controller
{

    public function store(StoreLandingCarouselValidation $request)
    {
        $pathHeroCarousel = Helper::uploadFile('img', 'hero-carousel');

        FirstHeroCarouselLanding::create([
            'img' => Str::replaceFirst('public/', '/storage/', $pathHeroCarousel),
            'domain_owner' => request()->getSchemeAndHttpHost()
        ]);

        return Helper::returnSuccess('menambah hero image');
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
        return Helper::returnSuccess('menghapus slide');
    }
}
