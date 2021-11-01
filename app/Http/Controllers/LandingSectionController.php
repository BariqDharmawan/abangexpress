<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\LandingSectionDesc;
use App\Models\LandingSectionTitle;
use Illuminate\Http\Request;

class LandingSectionController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        if ($request->has('our_service_title')) {
            LandingSectionTitle::updateOrCreate(
                ['domain_owner' => request()->getSchemeAndHttpHost()],
                ['our_service' => $request->our_service_title]
            );
        }

        if ($request->has('our_team_title')) {
            LandingSectionTitle::updateOrCreate(
                ['domain_owner' => request()->getSchemeAndHttpHost()],
                ['our_team' => $request->our_team_title]
            );
        }

        if ($request->has('faq_title')) {
            LandingSectionTitle::updateOrCreate(
                ['domain_owner' => request()->getSchemeAndHttpHost()],
                ['faq' => $request->faq_title]
            );
        }

        if ($request->has('our_contact_title')) {
            LandingSectionTitle::updateOrCreate(
                ['domain_owner' => request()->getSchemeAndHttpHost()],
                ['our_contact' => $request->our_contact_title]
            );
        }

        if ($request->has('our_contact_first_desc')) {
            LandingSectionDesc::updateOrCreate(
                ['domain_owner' => request()->getSchemeAndHttpHost()],
                ['first_desc_contact_us' => $request->our_contact_first_desc]
            );
        }

        return Helper::returnSuccess('mengganti heading');
    }

}
