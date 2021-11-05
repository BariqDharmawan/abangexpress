<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\BookOrderValidation;
use App\Http\Requests\StoreInvoiceValidation;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookingOrderController extends Controller
{

    public function index()
    {
        $title = 'Form Booking Order';

        $response = Http::retry(10, 0)->withOptions([
            'CURLOPT_RETURNTRANSFER' => true
        ])->acceptJson()->post(
            'https://res.abangexpress.id/shipments/pull/consigneedata/',
            Helper::getKeyApiArray()
        );

        $prevRecipient = json_decode($response)->response;

        $response = Http::retry(10, 0)->withOptions([
            'CURLOPT_RETURNTRANSFER' => true
        ])->acceptJson()->post(
            'https://res.abangexpress.id/shipments/pull/countrylist/',
            Helper::getKeyApiArray()
        );

        $countryList = json_decode($response)->response;

        $response = Http::retry(10, 0)->withOptions([
            'CURLOPT_RETURNTRANSFER' => true
        ])->acceptJson()->post(
            'https://res.abangexpress.id/shipments/pull/commoditylist/',
            Helper::getKeyApiArray()
        );

        $commodityList = json_decode($response)->response;

        return view('shipment.order.book', compact(
            'title', 'prevRecipient','countryList','commodityList'
        ));
    }

    public function order(BookOrderValidation $request)
    {
        return redirect()->route('shipping.order.book.save-invoice');
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

        $prevRecipient =$res->response;
        $prevRecipient=$prevRecipient[$id-1];
        return response()->json($prevRecipient);
    }

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
        $height = $request->package_height;
        $width = $request->package_width;
        $length = $request->package_length;
        $kurir = $request->courier;
        $commercialInvoice = $request->commercialInvoice;
        $customvalue = str_replace(".","",$request->package_value);
        $customvalue = str_replace(",",".",$customvalue);

        $b64=$request->idcard_input_hidden;
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
                "negara_tujuan": "'.$tujuan.'",
                "kurir": "'.$kurir.'"
            },
            "item_data": {
                "tipe": "'.$jenis.'",
                "deskripsi": "'.$desc.'",
                "berat": '.$berat.',
                "pcs": '.$pcs.',
                "panjang": '.$length.',
                "lebar": '.$width.',
                "tinggi": '.$height.',
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
        $response = json_decode($response);
        $response = $response->response;
        // print_r($response);


        return response()->json([
            'data' => $response,
            'message' => 'success'
        ]);
    }

    public function prints(Request $request)
    {
        $token = $request->link;
        if (!empty($token)){
            $halaman = file_get_contents("https://duniaexportimport.com/".$token);
        }else{
            $token = $_GET['key'];
            $halaman = file_get_contents("https://duniaexportimport.com/resi/".$token);
            // dd($token);
        }

        echo $halaman;
    }
}


