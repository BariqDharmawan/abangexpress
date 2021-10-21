<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ShipmentController extends Controller
{

    public function index()
    {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://res.abangexpress.id/shipments/pull/dashboarddata/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => User::getKeyApi(),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $res = json_decode($response);

        if ($res->status == 'failed') {
            Auth::guard('web')->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            return redirect('/')->with('error', 'Kamu tidak bisa mengakses shipping');
        }
        else {
            $quickReport = collect($res->response);

            return view('shipment.index', compact('quickReport'));
        }
        
    }

    public function zipcode()
    {
        $title = "Zipcode berbagai negara";

        return view('shipment.zipcode', compact('title'));
    }
}
