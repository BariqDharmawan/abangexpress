<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\StoreMemberValidation;
use App\Http\Requests\UpdateMemberValidation;
use App\Models\LandingSectionDesc;
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

        $landingSection = LandingSectionDesc::where('id', 4)->first();

        return view('admin.team.manage', compact(
            'teams',
            'positionList',
            'landingSection'
        ));
    }

    public function store(StoreMemberValidation $request)
    {
        $avatar = $request->file('avatar');
        $pathAvatar = $avatar->store('public/team');

        $xfiles = Str::replaceFirst('public/', 'storage/', $pathAvatar);
            if (isset($_FILES['avatar'])) {
                define('UPLOAD_DIR', 'storage/team/');


                if (!is_dir(UPLOAD_DIR)) {
                    //Create our directory if it does not exist
                    mkdir(UPLOAD_DIR);
                }
                $errors = array();
                $file_name = $_FILES['avatar']['name'];
                $file_size = $_FILES['avatar']['size'];
                $file_tmp = $_FILES['avatar']['tmp_name'];
                $file_type = $_FILES['avatar']['type'];
                // $file_ext=strtolower(end(explode('.',$file_name)));

                // $extensions= array("jpeg","jpg","png");

                // if(in_array($file_ext,$extensions)=== false){
                //     $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                // }

                if ($file_size > 2097152) {
                    $errors[] = 'File size must be excately 2 MB';
                }

                if (empty($errors) == true) {
                    move_uploaded_file($file_tmp, $xfiles);
                    // echo "Success";
                    // dd("Success");
                } else {
                    // print_r($errors);
                }
            }
            else {
                // echo "gambar gk ada";
        }

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
            $avatar = $request->file('avatar_edit');
            $pathAvatar = Storage::putFile('public/team', $avatar);

            $editMember->avatar = Str::replaceFirst('public/', '/storage/', $pathAvatar);


            $xfiles = Str::replaceFirst('public/', 'storage/', $pathAvatar);
            if (isset($_FILES['avatar_edit'])) {
                define('UPLOAD_DIR', 'storage/team/');


                if (!is_dir(UPLOAD_DIR)) {
                    //Create our directory if it does not exist
                    mkdir(UPLOAD_DIR);
                }
                $errors = array();
                $file_name = $_FILES['avatar_edit']['name'];
                $file_size = $_FILES['avatar_edit']['size'];
                $file_tmp = $_FILES['avatar_edit']['tmp_name'];
                $file_type = $_FILES['avatar_edit']['type'];
                // $file_ext=strtolower(end(explode('.',$file_name)));

                // $extensions= array("jpeg","jpg","png");

                // if(in_array($file_ext,$extensions)=== false){
                //     $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                // }

                if ($file_size > 2097152) {
                    $errors[] = 'File size must be excately 2 MB';
                }

                if (empty($errors) == true) {
                    move_uploaded_file($file_tmp, $xfiles);
                    // echo "Success";
                    // dd("Success");
                } else {
                    // print_r($errors);
                }
            }
            else {
                // echo "gambar gk ada";
            }
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
