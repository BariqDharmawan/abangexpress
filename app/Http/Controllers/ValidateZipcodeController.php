<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ValidateZipcodeController extends Controller
{
    public function validating(Request $request)
    {
        $zipcodeList = Http::retry(10, 0)->withOptions(['CURLOPT_RETURNTRANSFER' => true])->acceptJson()->post(
            'https://res.abangexpress.id/shipments/pull/zipcode/', [
                'akun' => $request->akun,
                'key' => $request->key,
                'country' => $request->country,
                'zipcode' => $request->zipcode
            ]
        );

        return json_decode($zipcodeList);
    }
}
