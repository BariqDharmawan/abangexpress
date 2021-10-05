<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
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

    public function addNewCoverVisionMission(Request $request)
    {
        $coverVisionMission = $request->file('cover_vision_mission');
        $pathcoverVisionMission = Storage::putFile(
            'public/cover-vision-mission', $coverVisionMission
        );
        
        AboutUs::first()->update([
            'cover_vision_mission' => Str::replaceFirst(
                'public/', '/storage/', $pathcoverVisionMission
            )
        ]);

        return Helper::returnSuccess('change cover');
    }

}
