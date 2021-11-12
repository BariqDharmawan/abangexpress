<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\StoreSocialMediaValidation;
use App\Http\Requests\UpdateSocialMediaValidation;
use App\Models\IconList;
use App\Models\OurSocial;
use Illuminate\Support\Arr;

class OurSocialController extends Controller
{

    public function index()
    {
        $socialMedia = Helper::getJson('social-media.json', true);
        $platforms = Helper::getListSocialPlatform();

        $socialMedia = OurSocial::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->get();

        $listIcon = IconList::where('content', 'social')->select('icon')->get()->pluck('icon');

        return view('admin.about-us.social.manage', compact(
            'platforms', 'listIcon', 'socialMedia'
        ));
    }

    public function store(StoreSocialMediaValidation $request)
    {
        $username = $request->username;
        $platform = $request->platform;

        OurSocial::create([
            'icon' => $request->icon,
            'platform' => $platform,
            'username' => $username,
            'link' => Helper::generateSocialLink($username, $platform),
            'domain_owner' => request()->getSchemeAndHttpHost()
        ]);

        return Helper::returnSuccess('menambah social media');

    }

    public function edit($id)
    {
        $social = OurSocial::findOrFail($id);
        $platforms = Helper::getListSocialPlatform();

        $listIcon = Helper::getJson('list-icon-social.json', true);

        return view('admin.about-us.social.edit', compact(
            'social', 'platforms', 'listIcon'
        ));
    }

    public function update(UpdateSocialMediaValidation $request, $id)
    {
        $updateSocial = OurSocial::findOrFail($id);

        $username = $request->username;
        $platform = $request->platform;

        $updateSocial->icon = $request->icon;
        $updateSocial->platform = $platform;
        $updateSocial->username = $username;
        $updateSocial->link = Helper::generateSocialLink($username, $platform);
        $updateSocial->save();

        //todo: remove old icon after update

        return redirect()->route('admin.our-social.index')->with(
            'success', "Successfully update $updateSocial->platform"
        );
    }

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
