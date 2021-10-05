<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\StoreMemberValidation;
use App\Http\Requests\UpdateMemberValidation;
use App\Models\OurTeam;
use App\Models\PositionList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OurTeamController extends Controller
{

    public function manage()
    {
        $teams = OurTeam::all();
        $positionList = PositionList::all();

        return view('admin.team.manage', compact('teams', 'positionList'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ourTeam = OurTeam::with('position')->get();
        return response()->json($ourTeam);
    }

    public function store(StoreMemberValidation $request)
    {
        $avatar = $request->file('avatar');
        $pathAvatar = Storage::putFile('public/team', $avatar);
        
        OurTeam::create([
            'name' => $request->name,
            'avatar' => Str::replaceFirst('public/', '/storage/', $pathAvatar),
            'position_id' => $request->position_id,
            'short_desc' => $request->short_desc,
        ]);

        return Helper::returnSuccess('add new member');

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
    public function update(UpdateMemberValidation $request, $id)
    {
        $editMember = OurTeam::findOrFail($id);
        $editMember->name = $request->name;

        if ($request->hasFile('avatar_edit')) {
            $avatar = $request->file('avatar_edit');
            $pathAvatar = Storage::putFile('public/team', $avatar);

            $editMember->avatar = Str::replaceFirst('public/', '/storage/', $pathAvatar);
        }

        $editMember->position_id = $request->position_id_edit;
        $editMember->short_desc = $request->short_desc;
        $editMember->save();

        return Helper::returnSuccess('add new member');
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
