<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\FirstHeroCarouselLanding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LandingHeroCarouselController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'img' => ['required', 'mimes:png,jpg,jpeg']
        ]);

        $heroCarousel = $request->file('img');
        $pathHeroCarousel = Storage::putFile('public/hero-carousel', $heroCarousel);

        $xfiles = Str::replaceFirst('public/', 'storage/', $pathHeroCarousel);
        if(isset($_FILES['img'])){
            define('UPLOAD_DIR', 'storage/hero-carousel/');

            if (!is_dir(UPLOAD_DIR)) {
                //Create our directory if it does not exist
                mkdir(UPLOAD_DIR);
            }

            $errors = array();

            $file_name = $_FILES['img']['name'];
            $file_size = $_FILES['img']['size'];
            $file_tmp = $_FILES['img']['tmp_name'];
            $file_type = $_FILES['img']['type'];
            // $file_ext=strtolower(end(explode('.',$file_name)));

            // $extensions= array("jpeg","jpg","png");
            // if(in_array($file_ext,$extensions)=== false){
            //     $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            // }

            if ($file_size > 2097152){
                $errors[] = 'File size must be excately 2 MB';
            }

            if (empty($errors)==true){
                move_uploaded_file($file_tmp,$xfiles);
                // echo "Success";
            } else{
                // print_r($errors);
            }
        }else {
           // echo "gambar gk ada";
        }

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
