<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackingOrderController extends Controller
{

    public function index(Request $request)
    {
        $request->validate([
            'track_order' => ['required', 'min:3', 'string']
        ]);

        $noresi = $request->track_order;
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
        $res=json_decode($response);
        $trackStatus=$res->status;
        // dd($tanggal);
        // echo $response;

        //todo: integrate search result here
        // dd($result);
        if ($trackStatus=="success"){

            $response=collect($res->trackresult,true);

            $tanggal=$response->map(function($item,$key){
                return[
                    'date' => $item->date,
                    'time' => $item->time,
                    'status' => $item->status
                ];
            });

            $result=$response->map(function($item,$key){
                return[
                    'desc' => $item->desc,
                    'location' => $item->location
                ];
            });


            return redirect('/#search-resi-section')->with(['trackingstatus'=>$trackStatus,'datetime'=>$tanggal,'trackresult'=>$result]);
        }else{
            return redirect('/#search-resi-section');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

}
