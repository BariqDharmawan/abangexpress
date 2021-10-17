<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class ShipmentInvoiceController extends Controller
{
    public function bill()
    {
        $title = 'Tagihan';
        // api pull data tagihan here
        $tableClass='dataOrder';

        $uid=Auth::user()->username;
        $user = User::where([
            ['username', $uid]
        ])->first();

        $akun = $user->code_api;
        $tokenkey = $user->token_api;
        $postdata = '{
            "akun": "'.$akun.'",
            "key": "'.$tokenkey.'",
            "xparam":"tagihan"
        }';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://res.abangexpress.id/shipments/pull/datainvoice/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postdata,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $res = json_decode($response);
        $orderData = $res->response;
        $statusRes = $res->status;
        // dd($res);
        // return view('shipment.order.index', compact('title','tableClass','orderData','statusRes','underling'));
        return view('shipment.invoice.bill', compact('title','tableClass','orderData','statusRes'));
    }

    public function verifying()
    {
        $title = 'Dalam Prose Verifikasi';
        // api pull data tagihan here
        $tableClass='dataOrder';

        $uid=Auth::user()->username;
        $user = User::where([
            ['username', $uid]
        ])->first();

        $akun = $user->code_api;
        $tokenkey = $user->token_api;
        $postdata = '{
            "akun": "'.$akun.'",
            "key": "'.$tokenkey.'",
            "xparam":"vp"
        }';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://res.abangexpress.id/shipments/pull/datainvoice/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postdata,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $res = json_decode($response);
        $orderData = $res->response;
        $statusRes = $res->status;

        return view('shipment.invoice.verifying', compact('title','tableClass','orderData','statusRes'));
    }

    public function settled()
    {
        $title = 'Lunas';
                // api pull data tagihan here
                $tableClass='dataOrder';

                $uid=Auth::user()->username;
                $user = User::where([
                    ['username', $uid]
                ])->first();

                $akun = $user->code_api;
                $tokenkey = $user->token_api;
                $postdata = '{
                    "akun": "'.$akun.'",
                    "key": "'.$tokenkey.'",
                    "xparam":"lunas"
                }';

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://res.abangexpress.id/shipments/pull/datainvoice/',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => $postdata,
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                $res = json_decode($response);
                $orderData = $res->response;
                $statusRes = $res->status;

        return view('shipment.invoice.settled', compact('title','tableClass','orderData','statusRes'));
    }
}
