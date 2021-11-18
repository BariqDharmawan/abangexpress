<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class ShipmentController extends Controller
{

    public function index()
    {
        try {
            $response = Http::retry(10, 0)->withOptions([
                'CURLOPT_RETURNTRANSFER' => true
            ])->acceptJson()->post(
                'https://res.abangexpress.id/shipments/pull/xdashboarddata/',
                Helper::getKeyApiArray()
            );
            // dd($response);
        } catch (\Throwable $th) {
            dd($th);
        }

        $res = json_decode($response);

        $isAccountResponseLocked = Str::startsWith($res->response->nama, '(LOCK)');
        if (isset($res->response->nama) and $isAccountResponseLocked) {
            User::lockUser();
            return redirect()->back()->with('error', 'Akun kamu terkunci, silahkan hubungi admin. ');
        }

        if ($res->status == 'failed') {
            Helper::logout();

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
