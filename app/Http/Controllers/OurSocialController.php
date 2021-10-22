<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\StoreSocialMediaValidation;
use App\Http\Requests\UpdateContactValidation;
use App\Http\Requests\UpdateSocialMediaValidation;
use App\Models\LandingSectionDesc;
use App\Models\OurSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OurSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function manage()
    {
        $socialMedia = Helper::getJson('social-media.json', true);
        $platforms = Arr::pluck($socialMedia, 'platform');

        $socialMedia = OurSocial::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->get();

        $listIcon = [
            "fab fa-instagram",
            "fab fa-facebook-square",
            "fab fa-linkedin",
            "fab fa-twitter",
            "fab fa-youtube"
        ];

        return view('admin.about-us.social.manage', compact(
            'platforms', 'listIcon', 'socialMedia'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSocialMediaValidation $request)
    {
        $username = $request->username;
        $platform = $request->platform;

        OurSocial::create([
            'icon' => $request->icon,
            'platform' => $platform,
            'username' => $username,
            'link' => OurSocial::generateUrl($username, $platform),
            'domain_owner' => request()->getSchemeAndHttpHost()
        ]);

        return Helper::returnSuccess('menambah social media');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $social = OurSocial::findOrFail($id);
        $platforms = Helper::getListSocialPlatform();

        $listIcon = Helper::getJson('list-icon-service.json', true);

        return view('admin.about-us.social.edit', compact(
            'social', 'platforms', 'listIcon'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSocialMediaValidation $request, $id)
    {
        $updateSocial = OurSocial::findOrFail($id);

        $username = $request->username;
        $platform = $request->platform;

        $updateSocial->icon = $request->icon;
        $updateSocial->platform = $platform;
        $updateSocial->username = $username;
        $updateSocial->link = OurSocial::generateUrl($username, $platform);
        $updateSocial->save();

        //todo: remove old icon after update

        return redirect()->route('admin.our-social.manage')->with(
            'success', "Successfully update $updateSocial->platform"
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $socialToDelete = OurSocial::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['id', $id]
        ])->firstOrFail();
        $platformName = $socialToDelete->platform;
        $socialToDelete->delete();

        return Helper::returnSuccess("menghapus $platformName kita");
    }
}
