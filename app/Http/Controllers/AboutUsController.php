<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\IdentityValidation;
use App\Http\Requests\UpdateEmbedMapValidation;
use App\Models\AboutUs;
use App\Models\LandingSectionDesc;
use App\Models\LandingSectionTitle;
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

        $sectionTitle = LandingSectionTitle::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->select('about_us')->first()->about_us;

        $sectionDesc = LandingSectionDesc::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->select('first_desc_about_us', 'second_desc_about_us')->first();

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
            'identity', 'sectionTitle', 'columnsIdentity', 'sectionDesc'
        ));
    }

    public function updateEmbedMap(UpdateEmbedMapValidation $request)
    {
        AboutUs::updateOrCreate(
            ['domain_owner' => request()->getSchemeAndHttpHost()],
            ['address_embed' => $request->address_embed]
        );

        return Helper::returnSuccess('mengubah embed map');
    }

    public function update(IdentityValidation $request)
    {
        if ($request->hasFile('cover_vision_mission')) {
            $pathcoverVisionMission = Helper::uploadFile('cover_vision_mission', 'cover-vision-mission');
            AboutUs::updateOrCreate(
                ['domain_owner' => request()->getSchemeAndHttpHost()],
                [
                    'our_vision' => $request->our_vision,
                    'our_mission' => $request->our_mission,
                    'cover_vision_mission' => $pathcoverVisionMission
                ]
            );
        }
        else {
            AboutUs::updateOrCreate(
                ['domain_owner' => request()->getSchemeAndHttpHost()],
                [
                    'our_vision' => $request->our_vision,
                    'our_mission' => $request->our_mission,
                ]
            );
        }

        LandingSectionTitle::updateOrCreate(
            ['domain_owner' => request()->getSchemeAndHttpHost()],
            ['about_us' => $request->section_name]
        );

        LandingSectionDesc::updateOrCreate(
            ['domain_owner' => request()->getSchemeAndHttpHost()],
            [
                'first_desc_about_us' => $request->first_desc,
                'second_desc_about_us' => $request->second_desc ?? null
            ]
        );

        return Helper::returnSuccess("mengubah tentang kita");

    }

}

