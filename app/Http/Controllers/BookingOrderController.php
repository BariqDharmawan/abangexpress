<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Form Booking Order';
        return view('shipment.order.book', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        print_r($_POST);
        $postdata='{
            "akun": "coloader",
            "key": "f03e563b71454776e2cb1e7b5f5ea5c4",
            "asal": {
                "nama": "nama_pengirim",
                "telepon": "-"
            },
            "tujuan": {
                "nama": "nama_penerima",
                "nomor_ktp": "BD1001 ",
                "file":"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACcAAAAnCAYAAAH7pGGjAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAIGNIUk0AAHolAACAgwAA+f8AAIDpAAB1MAAA6mAAADqYAAAXb5JfxUYAAAINSURBVHjabIyxCQAwDMOskP9fVodSkqGajIyNxkSyqCtwFPYNu5DKh36T+cUDAAD//2L8//8/mjrG/0zoAmhmIoxgwjSTgYEJXYCBgYEBAAAA//+CWoQpgWos3JkIJ6KyEXIsqLpRQwCLxzFNQLeBERLqmCaguxMAAAD//4ySuQ0AMAgDhfffOSnSgH1IoT4Jf0X1EKj5dnN9SukyoZY4wTNba7aDMSvPkU+bJtcshhLG+RD8EfgDLwAAAP//nJTBDgAgCEJn///PdbWJgN7juUGQIlQx8uSAjbEAVw1snAb3bwCQifQxAkRgbceZwVRjSvUdH+N28zAqi3s0zd32L/5ac5t88AMAAP//rJZJCsAwDANB/390Dz20BC2W29w9OERLfgLeMExfbnJdNFJI0gGXQg96dWAL5G6BF2tnuxDi56D3L/GrAuYgEOZPG3JNmiRRIh732beDLt+8bLBLXQ7EHJSB6DbyQPSFooHYNJMCHt+INiTlNTdpK725je1n7gIAAP//1JiBEcAgCAN7PfafuQsUCSEiDiC8ngnRn20qBkzN/sEh3wHpK9SJhR0nGfcLIuYOSLw+GFcVkPl6RPTNQvLrATi2Sf3kE3BoU911IOCY9MkJyXjVrb4MNOq2PZagMfOXg/LAVk/v/KvmdrWO9LmRE2LkbB2ZSp5mKBzSzkHFZv4BAAD//wMAWwA8PIvQEYoAAAAASUVORK5CYII=",
                "telepon": "0981784123",
                "alamat": "NO 8 GONGYE 7TH RDPINGZHEN CITY TAOYUAN COUNTY 32459",
                "kode_pos": "20442",
                "negara_tujuan": "TAIWAN"
            },
            "item_data": {
                "tipe": "NON-GARMENT",
                "deskripsi": "COSMETICS PERSONAL USED",
                "berat": 2,
                "pcs": 1,
                "panjang": 0,
                "lebar": 0,
                "tinggi": 0,
                "custom_value": 20
            },
            "item_detail": [
                {
                "deskripsi": "Night Cream",
                "qty": "2",
                "satuan": "PACK",
                "value": "5"},
                {
                "deskripsi": "Day Cream",
                "qty": "2",
                "satuan": "PACK",
                "value": "5"}]

        }';
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.abangexpress.id/shipments/tw/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$postdata,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        // $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
