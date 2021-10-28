<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\IdentityValidation;
use App\Http\Requests\UpdateEmbedMapValidation;
use App\Models\AboutUs;
use App\Models\LandingSectionDesc;
use App\Models\TemplateChoosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AboutUsController extends Controller
{

    public function getVisionMission()
    {
        $visionMission = AboutUs::select('our_vision', 'our_mission')->get();
        return response()->json($visionMission);
    }

    public function identity()
    {
        $identity = AboutUs::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();

        $aboutUs = LandingSectionDesc::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();
        $templateChoosen = TemplateChoosen::select('version')->where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();

        $columnsIdentity = [
            'Our Vision',
            'Our Mission',
            'Heading',
            'Deskripsi 1',
            'Video / gambar'
        ];

        if ($templateChoosen->version == 2) {
            array_splice($columnsIdentity, 4, 0, ['Deskripsi 2']);
        }

        // dd($identity);

        return view('admin.about-us.identity', compact(
            'identity', 'aboutUs', 'columnsIdentity'
        ));
    }

    public function updateEmbedMap(UpdateEmbedMapValidation $request)
    {
        AboutUs::where('domain_owner', request()->getSchemeAndHttpHost())->first()->update([
                    'address_embed' => $request->address_embed
                ]);
        return Helper::returnSuccess('mengubah embed map');
    }

    public function update(IdentityValidation $request)
    {
        //todo: add validation
        // dd($request->validated());

        $ourIdentity = AboutUs::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->firstOrFail();

        $ourIdentity->our_vision = $request->our_vision;
        $ourIdentity->our_mission = $request->our_mission;

        if ($request->hasFile('cover_vision_mission')) {
            $coverVisionMission = $request->file('cover_vision_mission');
            $pathcoverVisionMission = $coverVisionMission->store(
                'public/cover-vision-mission'
            );
            $ourIdentity->cover_vision_mission = $pathcoverVisionMission;

            $xfiles = Str::replaceFirst('public/', 'storage/', $pathcoverVisionMission);
            if(isset($_FILES['cover_vision_mission'])){
                define('UPLOAD_DIR', 'storage/cover-vision-mission/');

                if (!is_dir(UPLOAD_DIR)) {
                    //Create our directory if it does not exist
                    mkdir(UPLOAD_DIR);
                }

                $errors = array();

                $file_name = $_FILES['cover_vision_mission']['name'];
                $file_size = $_FILES['cover_vision_mission']['size'];
                $file_tmp = $_FILES['cover_vision_mission']['tmp_name'];
                $file_type = $_FILES['cover_vision_mission']['type'];
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
            }
            else {
               // echo "gambar gk ada";
            }
        }

        $ourIdentity->save();

        LandingSectionDesc::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->firstOrFail()->update([
            'section_name' => $request->section_name,
            'first_desc' => $request->first_desc,
            'second_desc' => $request->second_desc
        ]);

        return Helper::returnSuccess("mengubah tentang kita");

    }

}

