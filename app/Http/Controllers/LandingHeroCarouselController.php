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
        $heroCarousel = $request->file('img');
        $pathHeroCarousel = Storage::putFile('public/hero-carousel', $heroCarousel);

        $xfiles = Str::replaceFirst('public/', 'storage/', $pathHeroCarousel);

            define('UPLOAD_DIR', 'storage/hero-carousel/');

            if (!is_dir(UPLOAD_DIR)) {
                mkdir(UPLOAD_DIR);
            }

            $file_tmp = $_FILES['img']['tmp_name'];
            move_uploaded_file($file_tmp,$xfiles);

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
