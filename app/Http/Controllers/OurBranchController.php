<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\OurBranch;
use Illuminate\Http\Request;

class OurBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ourBranch = OurBranch::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->get();
        return view('admin.branch.index', compact('ourBranch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'icon' => ['required', 'file', 'mimes:jpg,png,jpeg,webp,svg', 'max:2048'],
            'telephone' => ['required', 'numeric', 'digits_between:8,16'],
            'address' => ['required'],
        ]);

        OurBranch::create([
            'name' => $request->name,
            'icon' => $request->icon,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'domain_owner' => request()->getSchemeAndHttpHost()
        ]);

        return Helper::returnSuccess('menambah cabang baru');
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
    public function update(Request $request, $id)
    {
        //
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
