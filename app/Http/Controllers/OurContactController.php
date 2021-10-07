<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\UpdateContactValidation;
use App\Models\AboutUs;
use App\Models\OurContact;
use Illuminate\Http\Request;

class OurContactController extends Controller
{

    public function manage()
    {
        $contact = OurContact::where('user_id', auth()->id())->first();
        $columns = ['address', 'telephone', 'email'];

        $addressEmbed = AboutUs::select('address_embed')
                        ->where('user_id', auth()->id())
                        ->first()->address_embed;

        return view('admin.about-us.contact.manage', compact(
            'contact', 'columns', 'addressEmbed'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ourContact = OurContact::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();

        return response()->json($ourContact);
    }

    public function update(UpdateContactValidation $request)
    {
        // dd($request->validated());
        $updateContact = OurContact::where('user_id', auth()->id())->first();
        dd($updateContact);
        $updateContact->address = $request->address;
        $updateContact->telephone = $request->telephone;
        $updateContact->email = $request->email;
        $updateContact->link_address = $request->link_address;
        $updateContact->user_id = auth()->id();
    
        $updateContact->save();
        return Helper::returnSuccess('update contact');
    }
}
