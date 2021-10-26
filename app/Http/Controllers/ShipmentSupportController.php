<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShipmentSupportController extends Controller
{
    public function guide()
    {
        $title = 'Panduan Penggunaan';
        return view('shipment.support.guide', compact('title'));
    }

    public function regulation()
    {
        $title = 'Regulasi Pengiriman';
        return view('shipment.support.regulation', compact('title'));
    }
}
