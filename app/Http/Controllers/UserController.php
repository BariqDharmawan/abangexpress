<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Helper\Helper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['role', 'sub-admin']
        ])->get();

        return view('admin.user.manage', compact('users'));
    }


    public function store(Request $request)
    {

        $uid=Auth::user()->username;
        $user = User::where([
            ['username', $uid]
        ])->first();

        $kode = $user->code_api;
        $anak=substr($kode,4);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'domain_owner' => request()->getSchemeAndHttpHost(),
            'plain_password' =>  $request->sandi,
            'code_api' =>  $request->kodeagen,
            'lt' =>  $anak,
            'token_api' =>  $request->tokenkey,
            'password' => Hash::make( $request->sandi)
        ]);

        return Helper::returnSuccess('menambah sub admin');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $subAdmin = User::findOrFail($id);
        $peopleName = $subAdmin->name;
        $subAdmin->update([
            'name' => $request->name,
            'username' => $request->username,
            'domain_owner' => $request->domain_owner,
            'plain_password' => $request->password,
            'password' => Hash::make('password')
        ]);

        return Helper::returnSuccess("update sub-admin $peopleName");
    }

    public function destroy($id)
    {
        $subAdmin = User::findOrFail($id);
        $peopleName = $subAdmin->name;

        $subAdmin->delete();
        return Helper::returnSuccess("Remove sub-admin $peopleName");
    }
}
