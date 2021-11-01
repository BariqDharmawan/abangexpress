<?php

namespace App\Http\Controllers;

class ShipmentSupportController extends Controller
{
    public function guide()
    {
        $title = 'Panduan Penggunaan';
        return view('shipment.support', compact('title'));
    }

    public function regulation()
    {
        $title = 'Regulasi Pengiriman';
        return view('shipment.support', compact('title'));
    }
}
