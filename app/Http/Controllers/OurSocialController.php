<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\StoreSocialMediaValidation;
use App\Http\Requests\UpdateContactValidation;
use App\Http\Requests\UpdateSocialMediaValidation;
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
        return view('admin.social.manage', compact('platforms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $iconSocial = $request->file('icon');
        $pathIconSocial = Storage::putFile('public/our-social', $iconSocial);

        OurSocial::create([
            'icon' => Str::replaceFirst('public/', '/storage/', $pathIconSocial),
            'platform' => $platform,
            'username' => $username,
            'link' => OurSocial::generateUrl($username, $platform)
        ]);

        return redirect()->back()->with('success', 'Successfully add new social media');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        return view('admin.social.edit', compact('social', 'platforms'));
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

        if ($request->hasFile('icon')) {
            $iconSocial = $request->file('icon');
            $pathIconSocial = Storage::putFile('public/our-social', $iconSocial);
            $updateSocial->icon = Str::replaceFirst('public/', '/storage/', $pathIconSocial);
        }
        $updateSocial->platform = $platform;
        $updateSocial->username = $username;
        $updateSocial->link = OurSocial::generateUrl($username, $platform);
        $updateSocial->save();

        //todo: remove old icon after update

        return redirect()->route('admin.our-social.manage')->with(
            'success', "Successfully update $updateSocial->platform"
        );

        // return 'coba';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $socialToDelete = OurSocial::findOrFail($id);
        $platformName = $socialToDelete->platform;
        $socialToDelete->delete();

        return redirect()->back()->with('success', "Successfully remove our $platformName");
    }
}
