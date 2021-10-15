<?php

namespace App\Http\Controllers;

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
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'domain_owner' => request()->getSchemeAndHttpHost(),
            'plain_password' => 'passwordsubadmin',
            'password' => Hash::make('passwordsubadmin')
        ]);

        return Helper::returnSuccess('add new sub admin');
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
