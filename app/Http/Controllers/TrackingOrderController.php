<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrackOrderValidation;
use Illuminate\Http\Request;

class TrackingOrderController extends Controller
{

    public function index(TrackOrderValidation $request)
    {
        $noresi = $request->receipt_number;
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.abangexpress.id/track/global/',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "akun": "coloader",
            "key": "f03e563b71454776e2cb1e7b5f5ea5c4",
            "awb": "'.$noresi.'"
            }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $res = json_decode($response);
        $trackStatus = $res->status;
        $trackUpdate = $res->result;

        if ($trackStatus == "success" && count($res->trackresult)>0){

            $response = collect($res->trackresult,true);

            $tanggal = $response->map(function($item,$key){
                return[
                    'date' => $item->date,
                    'time' => $item->time,
                    'status' => $item->status
                ];
            });

            $result = $response->map(function($item,$key){
                return[
                    'desc' => $item->desc,
                    'location' => $item->location
                ];
            });

            $lastUpdate=$tanggal->first();
            $lastUpdate=$lastUpdate['status'];

            return redirect(url()->previous() . '#search-resi-section')->with([
                'trackingstatus' => $trackStatus,
                'datetime'=>$tanggal,
                'trackresult'=>$result,
                'lastUpdate' => $lastUpdate,
                'trackUpdate' => $trackUpdate
            ]);
        }else{
            $trackStatus="failed";
            return redirect(url()->previous() . '#search-resi-section')->with(
                'trackingstatus', $trackStatus
            );
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

}
