<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookOrderValidation;
use App\Http\Requests\StoreInvoiceValidation;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Http\Request;

class BookingOrderController extends Controller
{

    public function index()
    {
        $title = 'Form Booking Order';

        $postdata = [
            'akun' => Auth::user()->code_api,
            'key' => Auth::user()->token_api
        ];
        $postdata = json_encode($postdata);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://res.abangexpress.id/shipments/pull/consigneedata/',
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
        $prevRecipient = $res->response;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://res.abangexpress.id/shipments/pull/countrylist/',
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

        $countryList = $res->response;

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://res.abangexpress.id/shipments/pull/commoditylist/',
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

        $commodityList = $res->response;

        return view('shipment.order.book', compact(
            'title', 'prevRecipient','countryList','commodityList'
        ));
    }
    public function order(BookOrderValidation $request)
    {
        return redirect('/shipping/order/book/invoice');
    }
    public function ambilPenerima($id)
    {
        $uid=Auth::user()->username;
        $user = User::where([
            ['username', $uid]
        ])->first();

        $akun=$user->code_api;
        $tokenkey=$user->token_api;
        $postdata='{
            "akun": "'.$akun.'",
            "key": "'.$tokenkey.'"

        }';
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://res.abangexpress.id/shipments/pull/consigneedata/',
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
        $res=json_decode($response);
        $res1=json_encode($res->response);
        // $prevRecipient = Helper::getJson('prev-recipient.json');
        $prevRecipient =$res->response;
        $prevRecipient=$prevRecipient[$id-1];
        return response()->json($prevRecipient);
    }
    // public function order(Request $request)
    // {
    //     // dd($request->all());
    //     $validatedData = $request->validate([
    //         'sender_name' => ['required'],
    //         'sender_telephone' => ['required'],
    //         // 'recipient_previous' => ['required'],
    //         'recipient_name' => ['required'],
    //         'recipient_telephone' => ['required'],
    //         'recipient_nik' => ['required'],
    //         'recipient_zipcode' => ['required'],
    //         'recipient_country' => ['required'],
    //         'recipient_address' => ['required'],
    //         'recipient_idcard' => ['required'],
    //         'package_fee' => ['required'],
    //         'package_weight' => ['required'],
    //         'package_type' => ['required'],
    //         'package_detail' => ['required'],
    //         'package_koli' => ['required'],
    //         'package_value' => ['required'],
    //     ]);

    //     if(empty($request->session()->get('book_order'))){
    //         // $product = new Product();
    //         // $product->fill($validatedData);
    //         $request->session()->put('book_order', $validatedData);
    //     }
    //     else{
    //         $product = $request->session()->get('book_order');
    //         // $product->fill($validatedData);
    //         $request->session()->put('book_order', $validatedData);
    //     }

    //     // return redirect()->route('shipping.order.book.invoice');
    //     return redirect('/shipping/order/book/invoice');
    // }

    public function invoice(Request $request)
    {
        $title = 'Form Invoice';
        $booked = $request->session()->get('book_order');

        return view('shipment.order.invoice', compact('title', 'booked'));
    }

    public function storeInvoice(StoreInvoiceValidation $request)
    {
        $commercialInvoice = json_encode($request->validated());

        return response()->json([
            'commercialInvoice' => $commercialInvoice,
            'data' => $commercialInvoice,
            'message' => 'success'
        ]);
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
        $berat = str_replace(",",".",$request->package_weight);
        $jenis = $request->package_type;
        $desc = $request->package_detail;
        $pcs = $request->package_koli;
        $commercialInvoice = $request->commercialInvoice;
        // $customvalue=$_POST['package_value'];
        $customvalue = str_replace(".","",$request->package_value);
        $customvalue = str_replace(",",".",$customvalue);

        // $file_tmp= file_get_contents($_FILES['recipient_idcard']['tmp_name']);
        // $b64=base64_encode($file_tmp);
        $b64=$request->idcard_input_hidden;
        // echo "<pre>".
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
                "file":"'.$b64.'",
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
            "item_detail": ['.$commercialInvoice.']

        }';
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://res.abangexpress.id/shipments/tw/',
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
        $response=json_decode($response);
        $response=$response->response;
        // print_r($response);


        return response()->json([
            'data' => $response,
            'message' => 'success'
        ]);
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
    public function prints(Request $request)
    {
        $token=$request->link;
        if (!empty($token)){
            $halaman=file_get_contents("https://duniaexportimport.com/".$token);
        }else{
            $token=$_GET['key'];
            $halaman=file_get_contents("https://duniaexportimport.com/resi/".$token);
            // dd($token);
        }

        echo $halaman;
    }
}


