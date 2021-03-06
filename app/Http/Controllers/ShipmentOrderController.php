<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShipmentOrderController extends Controller
{

    private function getDataOrder($requiredParam)
    {
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
            CURLOPT_POSTFIELDS => $requiredParam,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);
    }

    public function index()
    {
        $postdata = [
            "akun" => Auth::user()->code_api,
            "key" => Auth::user()->token_api,
            "param" => "and statustransaksi=`0`"
        ];

        $res = $this->getDataOrder(json_encode($postdata));

        $orderData = Helper::responseDataOrder($res->response);

        $statusRes = $res->status;
        $underling = $res->underling;
        // dd($res);
        return view('shipment.order.index', compact('orderData','statusRes','underling'));

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

        $postdata = [
            "akun" => Auth::user()->code_api,
            "key" => Auth::user()->token_api,
            "param" => "and statustransaksi=`2`"
        ];

        $res = $this->getDataOrder(json_encode($postdata));
        $orderData = $res->response;
        $statusRes = $res->status;

        return view('shipment.order.process', compact('title','orderData','statusRes'));
    }

    public function pending()
    {
        $title = 'Pending Proses';

        $postdata = [
            "akun" => Auth::user()->code_api,
            "key" => Auth::user()->token_api,
            "param" => "and statustransaksi=`1`"
        ];

        $res = $this->getDataOrder(json_encode($postdata));
        $orderData = Helper::responseDataOrder($res->response);

        $statusRes = $res->status;
        // dd($orderData);
        return view('shipment.order.pending', compact('title','orderData','statusRes'));
    }

    public function history()
    {
        $postdata = [
            "akun" => Auth::user()->code_api,
            "key" => Auth::user()->token_api,
            "param" => "and statustransaksi=`3`"
        ];

        $res = $this->getDataOrder(json_encode($postdata));

        $orderData = $res->response;
        $statusRes = $res->status;
        $underling = $res->underling;
        // dd($orderData);
        return view('shipment.order.history', compact('orderData','statusRes','underling'));
    }

    public function receipt()
    {
        $postdata = [
            "akun" => Auth::user()->code_api,
            "key" => Auth::user()->token_api,
            "param" => "and not(statustransaksi=`C`)"
        ];

        $res = $this->getDataOrder(json_encode($postdata));
        $orderData = $res->response;
        $statusRes = $res->status;

        return view('shipment.order.receipt', compact('orderData','statusRes'));
    }


    public function filterOrder(Request $request)
    {
        $startDate = Carbon::createFromFormat('d M Y', $request->start_date)->toDateString();

        $qw = "";
        if (!empty($startDate) || !empty($request->end_date) || !empty($request->pengirim) || !empty($request->kodeanak)){

            if ($request->has('akhir')) {
                $endDate = Carbon::createFromFormat('d M Y', $request->end_date)->toDateString();
            }

            $endDate = $endDate ?? $startDate;

            if (!empty($startDate) || !empty($endDate)){
                $qw = $qw."and (tglorder between '$startDate' and '$endDate') ";
            }
            if (!empty($request->pengirim)){
                $qw = $qw."and pengirim like '%".$request->pengirim."%'";
            }
            if (!empty($request->kodeanak)){
                $qw = $qw."and kodeagen='".$request->kodeanak."'";
            }
        }

        $qw = str_replace("'","`",$qw);

        $postdata = [
            "akun" => Auth::user()->code_api,
            "key" => Auth::user()->token_api,
            "param" => "and statustransaksi=`0`" . $qw
        ];

        $res = $this->getDataOrder(json_encode($postdata));
        $orderData = Helper::responseDataOrder($res->response);

        $statusRes = $res->status;
        $underling = $res->underling;

        return view('shipment.order.index', compact(
            'orderData','statusRes','underling'
        ));

    }

    public function filterHistory(Request $request)
    {

        $title = 'Data order';
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

        $postdata = '{
            "akun": "'.Auth::user()->code_api.'",
            "key": "'.Auth::user()->token_api.'",
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
        return view('shipment.order.history', compact('title','orderData','statusRes','underling'));
    }

    public function cancelOrder(Request $request)
    {
        Http::retry(10, 0)->withOptions(['CURLOPT_RETURNTRANSFER' => true])->acceptJson()->post(
            'https://res.abangexpress.id/shipments/push/ordercancel/', [
                'akun' => Auth::user()->code_api,
                'key' => Auth::user()->token_api,
                'awb_key' => $request->token
            ]
        );
        return redirect('/shipping/order/');
    }

}
