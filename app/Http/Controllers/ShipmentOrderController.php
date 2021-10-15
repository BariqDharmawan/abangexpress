<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShipmentOrderController extends Controller
{
    public function index()
    {
        $title = 'Data order';
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
            "param":"and statustransaksi=`0`"

        }';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://res.abangexpress.id/shipments/pull/dataorder/',
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
        // dd($orderData);
        return view('shipment.order.index', compact('title','tableClass','orderData','statusRes'));

    }

    public function dummyPreviousRecipient($id)
    {
        $prevRecipient = Helper::getJson('prev-recipient.json')[$id - 1];
        //todo: change this to get data from database

        return response()->json($prevRecipient);
    }

    public function process()
    {
        $title = 'Dalam Proses';
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
            "param":"and statustransaksi=`2`"

        }';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://res.abangexpress.id/shipments/pull/dataorder/',
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
        // dd($orderData);
        return view('shipment.order.process', compact('title','tableClass','orderData','statusRes'));
    }

    public function pending()
    {
        $title = 'Pending Proses';
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
            "param":"and statustransaksi=`1`"

        }';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://res.abangexpress.id/shipments/pull/dataorder/',
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
        // dd($orderData);
        return view('shipment.order.pending', compact('title','tableClass','orderData','statusRes'));
    }

    public function history()
    {
        $title = 'History Kiriman';
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
            "param":"and statustransaksi=`3`"

        }';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://res.abangexpress.id/shipments/pull/dataorder/',
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
        // dd($orderData);
        return view('shipment.order.history', compact('title','tableClass','orderData','statusRes'));
    }

    public function receipt()
    {
        $title = 'Cetak Ulang Resi';
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
            "param":"and statustransaksi=`3`"

        }';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://res.abangexpress.id/shipments/pull/dataorder/',
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
        // dd($orderData);
        return view('shipment.order.receipt', compact('title','tableClass','orderData','statusRes'));
    }


    public function filterOrder(Request $request)
    {

        $title = 'Data order';
        $tableClass='dataOrder';
        $qw="";
        if (!empty($_POST['awal']) || !empty($_POST['akhir']) || !empty($_POST['pengirim']) ){
            $t1=$_POST['awal'];
            if (!empty($_POST['akhir'])){
                $t2=$_POST['akhir'];}
            else{
                $t2=$_POST['awal']    ;
            }
            if (!empty($_POST['awal']) || !empty($_POST['akhir'])){
                $qw=$qw."and (tglorder between '$t1' and '$t2') ";
            }
            if (!empty($_POST['pengirim'])){
                $qw=$qw."and pengirim like '%".$_POST['pengirim']."%'";
            }
            if (!empty($_POST['kodeanak'])){
                $qw=$qw."and kodeagen='".$_POST['kodeanak']."'";
            }
            // dd($qw);
        }
        $qw=str_replace("'","`",$qw);
        $uid=Auth::user()->username;
        $user = User::where([
            ['username', $uid]
        ])->first();

        $akun = $user->code_api;
        $tokenkey = $user->token_api;
        $postdata = '{
            "akun": "'.$akun.'",
            "key": "'.$tokenkey.'",
            "param":"and statustransaksi=`0` '.$qw.'"

        }';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://res.abangexpress.id/shipments/pull/dataorder/',
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
        // dd($postdata);
        return view('shipment.order.index', compact('title','tableClass','orderData','statusRes'));

    }

    public function filterHistory(Request $request)
    {

        $title = 'Data order';
        $tableClass='dataOrder';
        $qw="";
        if (!empty($_POST['awal']) || !empty($_POST['akhir']) || !empty($_POST['pengirim']) ){
            $t1=$_POST['awal'];
            if (!empty($_POST['akhir'])){
                $t2=$_POST['akhir'];}
            else{
                $t2=$_POST['awal']    ;
            }
            if (!empty($_POST['awal']) || !empty($_POST['akhir'])){
                $qw=$qw."and (tglorder between '$t1' and '$t2') ";
            }
            if (!empty($_POST['pengirim'])){
                $qw=$qw."and pengirim like '%".$_POST['pengirim']."%'";
            }
            if (!empty($_POST['kodeanak'])){
                $qw=$qw."and kodeagen='".$_POST['kodeanak']."'";
            }
            // dd($qw);
        }
        $qw=str_replace("'","`",$qw);
        $uid=Auth::user()->username;
        $user = User::where([
            ['username', $uid]
        ])->first();

        $akun = $user->code_api;
        $tokenkey = $user->token_api;
        $postdata = '{
            "akun": "'.$akun.'",
            "key": "'.$tokenkey.'",
            "param":"and statustransaksi=`3` '.$qw.'"

        }';

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://res.abangexpress.id/shipments/pull/dataorder/',
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
        // dd($postdata);
        return view('shipment.order.index', compact('title','tableClass','orderData','statusRes'));

    }

}
