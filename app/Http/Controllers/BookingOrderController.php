<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Http\Request;

class BookingOrderController extends Controller
{
    
    public function index()
    {
        $title = 'Form Booking Order';
        $prevRecipient = Helper::getJson('prev-recipient.json');
        
        return view('shipment.order.book', compact('title', 'prevRecipient'));
    }

    public function order(Request $request)
    {
        dd($request->all());
        $validatedData = $request->validate([
            'sender_name' => ['required'],
            'sender_telephone' => ['required'],
            // 'recipient_previous' => ['required'],
            'recipient_name' => ['required'],
            'recipient_telephone' => ['required'],
            'recipient_nik' => ['required'],
            'recipient_zipcode' => ['required'],
            'recipient_country' => ['required'],
            'recipient_address' => ['required'],
            'recipient_idcard' => ['required'],
            'package_fee' => ['required'],
            'package_weight' => ['required'],
            'package_type' => ['required'],
            'package_detail' => ['required'],
            'package_koli' => ['required'],
            'package_value' => ['required'],
        ]);

        if(empty($request->session()->get('book_order'))){
            // $product = new Product();
            // $product->fill($validatedData);
            $request->session()->put('book_order', $validatedData);
        }
        else{
            $product = $request->session()->get('book_order');
            // $product->fill($validatedData);
            $request->session()->put('book_order', $validatedData);
        }

        return redirect()->route('shipping.order.book.invoice');
    }

    public function invoice(Request $request)
    {
        $title = 'Form Invoice';
        $booked = $request->session()->get('book_order');

        return view('shipment.order.invoice', compact('title', 'booked'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {


        $uid=Auth::user()->username;
        $users = User::where([
            ['username', $uid]
        ])->get();
        // if(count($users)==1){} // count data found
            foreach ($users as $user)
            $akun=$user->code_api;
            $tokenkey=$user->token_api;

        $pengirim = $request->sender_name;
        $telepon = $request->sender_telephone;
        $penerima = $request->recipient_name;
        $teleponpenerima = $request->recipient_telephone;
        $ktp = $request->recipient_nik;
        $tujuan = $request->destination_country;
        $alamat = $request->recipient_address;
        $kodepos = $request->recipient_zipcode;
        $berat = $request->package_weight;
        $jenis = $request->package_type;
        $desc = $request->package_detail;
        $pcs = $request->package_pcs;
        // $customvalue=$_POST['package_value'];
        $customvalue = 12;

        $file_tmp= file_get_contents($_FILES['recipient_idcard']['tmp_name']);
        echo $b64=base64_encode($file_tmp);

        //todo: make this into table for better code
        $postdata='{
            "akun": "'.$akun.'",
            "key": "'.$tokenkey.'",
            "asal": {
                "nama": "'.$pengirim.'",
                "telepon": "'.$telepon.'"
            },
            "tujuan": {
                "nama": "'.$penerima.'",
                "nomor_ktp": "'.$ktp.'",
                "file":"data:image/png;base64,'.$b64.'",
                "telepon": "'.$teleponpenerima.'",
                "alamat": "'.$alamat.'",
                "kode_pos": "'.$kodepos.'",
                "negara_tujuan": "'.$tujuan.'"
            },
            "item_data": {
                "tipe": "'.$jenis.'",
                "deskripsi": "'.$desc.'",
                "berat": '.$berat.',
                "pcs": '.$pcs.',
                "panjang": 0,
                "lebar": 0,
                "tinggi": 0,
                "custom_value": '.$customvalue.'
            },
            "item_detail": [
                {
                    "deskripsi": "Night Cream",
                    "qty": "2",
                    "satuan": "PACK",
                    "value": "5"
                },
                {
                    "deskripsi": "Day Cream",
                    "qty": "2",
                    "satuan": "PACK",
                    "value": "5"
                }
            ]

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

        $response = curl_exec($curl);

        curl_close($curl);
        echo "<pre>".
         $response;
    }

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
