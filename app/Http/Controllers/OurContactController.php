<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\UpdateContactValidation;
use App\Models\AboutUs;
use App\Models\LandingSectionDesc;
use App\Models\OurContact;
use Illuminate\Http\Request;

class OurContactController extends Controller
{

    public function manage()
    {
        $contact = OurContact::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();
        $titles = ['Alamat', 'Email', 'Telepon'];
        $columns = ['address', 'telephone', 'email'];

        $addressEmbed = AboutUs::select('address_embed')
                        ->where('user_id', auth()->id())
                        ->first()->address_embed;

        $landingSection = LandingSectionDesc::where('id', 5)->first();

        return view('admin.about-us.contact.manage', compact(
            'contact', 'columns', 'addressEmbed', 'titles', 'landingSection'
        ));
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
        OurContact::firstOrFail()->update([
            'address' => $request->address,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'link_address' => $request->link_address,
            'user_id' => auth()->id()
        ]);

        // return response()->json($ourContact);

        return Helper::returnSuccess('update contact');
    }
}
