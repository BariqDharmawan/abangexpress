<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\UpdateSocialMediaValidation;
use App\Models\OurSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
    public function store(Request $request)
    {
        $username = $request->username;
        $linkSocial = OurSocial::generateUrl($username, $request->platform);

        $addSocial = OurSocial::create([
            'icon' => $request->icon,
            'platform' => $request->platform,
            'username' => $username,
            'link' => $linkSocial
        ]);

        return response()->json($addSocial);

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
        //
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
        $username = $request->username;
        $linkSocial = OurSocial::generateUrl($username, $request->platform);

        $updateSocial = OurSocial::where('id', $id)->update([
            'icon' => $request->icon,
            'platform' => $request->platform,
            'username' => $username,
            'link' => $linkSocial
        ]);

        return response()->json($updateSocial);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
