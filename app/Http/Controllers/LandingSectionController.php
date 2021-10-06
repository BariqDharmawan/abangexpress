<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\LandingSectionDesc;
use Illuminate\Http\Request;

class LandingSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectionHeading = LandingSectionDesc::all();
        return view('admin.contents.section-heading', compact('sectionHeading'));
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
        $sectionToUpdate = LandingSectionDesc::findOrFail($id);
        $sectionToUpdate->section_name = $request->section_name;
        if ($request->has('first_desc')) {
            $sectionToUpdate->first_desc = $request->first_desc;
        }
        if ($request->has('second_desc')) {
            $sectionToUpdate->second_desc = $request->second_desc;
        }
        $sectionToUpdate->user_id = auth()->id();
        
        $sectionToUpdate->save();
        return Helper::returnSuccess('change heading');
    }

}
