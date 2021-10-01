<?php

namespace App\Http\Controllers;

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
        return view('admin.identity.manage', compact('identity'));
    }

    public function updateEmbedMap(UpdateEmbedMapValidation $request)
    {
        AboutUs::first()->update(['address_embed' => $request->address_embed]);
        return redirect()->back()->with('success', 'Successfully update our embed map');
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
        //todo: add validation
        $ourIdentity = AboutUs::findOrFail(1);

        // dd($ourIdentity, $request->all());

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

        $ourIdentity->save();
        return redirect()->back()->with(
            'success', 
            'Successfully update ' . $isEditOurIdentityInfo ? 'our identity' : 'video promo'
        );
    }

}
