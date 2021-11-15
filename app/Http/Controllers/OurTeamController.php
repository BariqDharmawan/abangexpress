<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\StoreMemberValidation;
use App\Http\Requests\UpdateMemberValidation;
use App\Models\LandingSectionTitle;
use App\Models\OurTeam;
use Illuminate\Support\Str;
use Laravolt\Avatar\Facade as Avatar;

class OurTeamController extends Controller
{

    public function manage()
    {
        $teams = OurTeam::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->get();

        $sectionTitle = LandingSectionTitle::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->select('our_team')->first()->our_team ?? '';

        return view('admin.team.manage', compact('teams', 'sectionTitle'));
    }

    public function store(StoreMemberValidation $request)
    {
        if ($request->hasFile('avatar')) {
            $pathAvatar = Helper::uploadFile('avatar', 'team');
        }
        else {
            $pathAvatar = Avatar::create($request->name)->toBase64();
        }

        OurTeam::create([
            'name' => $request->name,
            'avatar' => $pathAvatar,
            'position' => $request->position,
            'short_desc' => $request->short_desc,
            'domain_owner' => request()->getSchemeAndHttpHost()
        ]);

        return Helper::returnSuccess('menambah anggota member baru');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMemberValidation $request, $id)
    {
        $editMember = OurTeam::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['id', $id]
        ])->firstOrFail();
        $editMember->name = $request->name;

        if ($request->hasFile('avatar_edit')) {
            $pathAvatar = Helper::uploadFile('avatar_edit', 'team');
            $editMember->avatar = Str::replaceFirst('public/', '/storage/', $pathAvatar);
        }

        $editMember->position = $request->position;
        $editMember->short_desc = $request->short_desc;
        $editMember->save();

        return Helper::returnSuccess('mengubah info member');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletePerson = OurTeam::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['id', $id]
        ])->firstOrFail();

        $personName = $deletePerson->name;

        $deletePerson->delete();

        return Helper::returnSuccess("menghapus member dengan nama $personName");
    }
}
