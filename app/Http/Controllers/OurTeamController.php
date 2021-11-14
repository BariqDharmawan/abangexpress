<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\StoreMemberValidation;
use App\Http\Requests\UpdateMemberValidation;
use App\Models\LandingSectionDesc;
use App\Models\LandingSectionTitle;
use App\Models\OurTeam;
use App\Models\PositionList;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OurTeamController extends Controller
{

    public function manage()
    {
        $teams = OurTeam::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->get();

        $positionList = PositionList::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->get();

        $sectionTitle = LandingSectionTitle::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->select('our_team')->first()->our_team;

        // $landingSection = LandingSectionDesc::where('id', 4)->first();

        return view('admin.team.manage', compact(
            'teams',
            'positionList',
            'sectionTitle'
        ));
    }

    public function store(StoreMemberValidation $request)
    {

        $pathAvatar = Helper::uploadFile('avatar', 'team');

        OurTeam::create([
            'name' => $request->name,
            'avatar' => $pathAvatar,
            'position_id' => $request->position_id,
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

        $editMember->position_id = $request->position_id_edit;
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
