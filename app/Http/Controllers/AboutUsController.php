<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\IdentityValidation;
use App\Http\Requests\UpdateEmbedMapValidation;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{

    public function getVisionMission()
    {
        $visionMission = AboutUs::select('our_vision', 'our_mission')->get();
        return response()->json($visionMission);
    }

    public function identity()
    {
        $identity = AboutUs::first();
        return view('admin.about-us.identity', compact('identity'));
    }

    public function updateEmbedMap(UpdateEmbedMapValidation $request)
    {
        AboutUs::first()->update(['address_embed' => $request->address_embed]);
        return Helper::returnSuccess('update our embed map');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IdentityValidation $request)
    {
        //todo: add validation
        $ourIdentity = AboutUs::findOrFail(1);

        $isEditOurIdentityInfo = $request->hasAny([
            'our_name', 'our_vision', 'our_mission', 'sub_slogan'
        ]);

        if($isEditOurIdentityInfo) {
            $ourIdentity->our_name = $request->our_name;
            $ourIdentity->our_vision = $request->our_vision;
            $ourIdentity->our_mission = $request->our_mission;
            $ourIdentity->sub_slogan = $request->sub_slogan;
        }
        else {
            $ourIdentity->our_video = $request->our_video;
        }

        $ourIdentity->user_id = auth()->id();

        $ourIdentity->save();

        $message = $isEditOurIdentityInfo ? 'our identity' : 'video promo';

        return Helper::returnSuccess("update $message");
        
    }

}
