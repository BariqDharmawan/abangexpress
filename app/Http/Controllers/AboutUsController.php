<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\IdentityValidation;
use App\Http\Requests\UpdateEmbedMapValidation;
use App\Models\AboutUs;
use App\Models\LandingSectionDesc;
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

        $aboutUs = LandingSectionDesc::first();

        return view('admin.about-us.identity', compact('identity', 'aboutUs'));
    }

    public function updateEmbedMap(UpdateEmbedMapValidation $request)
    {
        AboutUs::where('domain_owner', request()->getSchemeAndHttpHost())->first()->update([
                    'address_embed' => $request->address_embed
                ]);
        return Helper::returnSuccess('update our embed map');
    }

    public function update(IdentityValidation $request)
    {
        //todo: add validation
        $ourIdentity = AboutUs::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();

        $ourIdentity->our_vision = $request->our_vision;
        $ourIdentity->our_mission = $request->our_mission;
        $ourIdentity->our_video = $request->our_video;
        
        if ($request->hasFile('cover_vision_mission')) {
            $coverVisionMission = $request->file('cover_vision_mission');
            $pathcoverVisionMission = Storage::putFile(
                'public/cover-vision-mission', $coverVisionMission
            );
            $ourIdentity->cover_vision_mission = Str::replaceFirst(
                'public/', '/storage/', $pathcoverVisionMission
            );
        }

        $ourIdentity->save();

        LandingSectionDesc::first()->update([
            'section_name' => $request->section_name,
            'first_desc' => $request->first_desc,
            'second_desc' => $request->second_desc
        ]);

        return Helper::returnSuccess("change about us");
        
    }

}

