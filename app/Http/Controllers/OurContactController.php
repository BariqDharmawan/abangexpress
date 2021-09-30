<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\OurContact;
use Illuminate\Http\Request;

class OurContactController extends Controller
{

    public function manage()
    {
        $contact = OurContact::first();
        $columns = ['address', 'telephone', 'email'];

        $addressEmbed = AboutUs::select('address_embed')->first()->address_embed;
        // $ourAddress = [$ourAddress, $address];

        // dd($ourAddress);

        return view('admin.contact.manage', compact('contact', 'columns', 'addressEmbed'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ourContact = OurContact::first();

        return response()->json($ourContact);
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
        //
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
