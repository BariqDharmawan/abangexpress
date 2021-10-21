<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class ShipmentController extends Controller
{

    public function index()
    {
        $response = Http::retry(10, 0)->withOptions([
            'CURLOPT_RETURNTRANSFER' => true
        ])->acceptJson()->post(
            'https://res.abangexpress.id/shipments/pull/dashboarddata/',
            Helper::getKeyApiArray()
        );

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
