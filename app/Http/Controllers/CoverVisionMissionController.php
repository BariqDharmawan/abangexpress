<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CoverVisionMissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cover = AboutUs::where('user_id', auth()->id())
                ->select('cover_vision_mission')
                ->first()->cover_vision_mission;
        return view('admin.contents.vision-mission', compact('cover'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $coverVisionMission = $request->file('cover_vision_mission');
        $pathcoverVisionMission = Storage::putFile(
            'public/cover-vision-mission', $coverVisionMission
        );
        
        AboutUs::first()->update([
            'cover_vision_mission' => Str::replaceFirst(
                'public/', '/storage/', $pathcoverVisionMission
            ),
            'user_id' => auth()->id()
        ]);

        return Helper::returnSuccess('change cover');
    }

}
