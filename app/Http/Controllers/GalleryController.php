<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\StoreGalleryValidation;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleryImg = Gallery::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['img', '!=', null]
        ])->get();

        $galleryYoutube = Gallery::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['youtube', '!=', null]
        ])->get();

        // dd($galleryImg, $galleryYoutube);

        return view('admin.gallery.index', compact('galleryYoutube', 'galleryImg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGalleryValidation $request)
    {
        $addGallery = new Gallery;

        if ($request->hasFile('img')) {
            $gallery = $request->file('img');
            $fileGallery = $gallery->store('public/branch');
            $pathGallery = Str::replaceFirst('public/', 'storage/', $fileGallery);

            if (!is_dir('storage/gallery/')) {
                mkdir('storage/gallery/');
            }

            $file_tmp = $_FILES['img']['tmp_name'];
            move_uploaded_file($file_tmp, $pathGallery);

            $addGallery->img = $pathGallery;
        }
        else if ($request->has('youtube')) {
            $addGallery->youtube = $request->youtube;
        }

        $addGallery->domain_owner = request()->getSchemeAndHttpHost();
        $addGallery->save();

        return Helper::returnSuccess('menambah gallery');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gallery::findOrFail($id)->delete();

        return Helper::returnSuccess('menghapus gallery');
    }
}
