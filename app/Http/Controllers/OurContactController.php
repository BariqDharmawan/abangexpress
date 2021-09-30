<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateContactValidation;
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

    public function update(UpdateContactValidation $request)
    {
        $ourContact = OurContact::where('id', 1)->update($request->validated());

        // return response()->json($ourContact);

        return redirect()->back()->with('success', 'Successfully update contact');
    }
}
