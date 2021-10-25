<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Carbon\Carbon;
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

        $orderData = collect($res->response)->map(function ($item, $key){
            return [
                'noresi' => $item->noresi,
                'pengirim' => $item->pengirim,
                'telepon' => $item->telepon,
                'penerima' => $item->penerima,
                'teleponp' => $item->teleponp,
                'alamat' => $item->alamat,
                'tujuan' => $item->tujuan,
                'berat' => $item->berat,
                'qty' => $item->qty,
                'tglOrder' => Carbon::parse($item->tglOrder)->format('d F Y')
            ];
        });

        // dd($orderData);
        
        $statusRes = $res->status;
        $underling = $res->underling;
        // dd($res);
        return view('shipment.order.index', compact('title','tableClass','orderData','statusRes','underling'));

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
        $underling = $res->underling;
        // dd($orderData);
        return view('shipment.order.history', compact('title','tableClass','orderData','statusRes','underling'));
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
            "param":"and not(statustransaksi=`C`)"

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
        if (!empty($request->awal) || !empty($request->akhir) || !empty($request->pengirim) || !empty($request->kodeanak)){
            $t1=$request->awal;
            if (!empty($request->akhir)){
                $t2=$request->akhir;}
            else{
                $t2=$request->awal    ;
            }
            if (!empty($request->awal) || !empty($request->akhir)){
                $qw=$qw."and (tglorder between '$t1' and '$t2') ";
            }
            if (!empty($request->pengirim)){
                $qw=$qw."and pengirim like '%".$request->pengirim."%'";
            }
            if (!empty($request->kodeanak)){
                $qw=$qw."and kodeagen='".$request->kodeanak."'";
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
        $underling = $res->underling;
        // dd($postdata);
        return view('shipment.order.index', compact('title','tableClass','orderData','statusRes','underling'));

    }

    public function filterHistory(Request $request)
    {

        $title = 'Data order';
        $tableClass='dataOrder';
        $qw="";
        if (!empty($request->awal) || !empty($request->akhir) || !empty($request->pengirim) ){
            $t1=$request->awal;
            if (!empty($request->akhir)){
                $t2=$request->akhir;}
            else{
                $t2=$request->awal;
            }
            if (!empty($request->awal) || !empty($request->akhir)){
                $qw=$qw."and (tglorder between '$t1' and '$t2') ";
            }
            if (!empty($request->pengirim)){
                $qw=$qw."and pengirim like '%".$request->pengirim."%'";
            }
            if (!empty($request->kodeanak)){
                $qw=$qw."and kodeagen='".$request->kodeanak."'";
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
        $underling = $res->underling;
        // dd($postdata);
        return view('shipment.order.history', compact('title','tableClass','orderData','statusRes','underling'));

    }

}
