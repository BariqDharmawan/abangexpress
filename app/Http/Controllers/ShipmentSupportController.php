<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShipmentSupportController extends Controller
{
    public function guide()
    {
        $title = 'Panduan Penggunaan';
        $pdf = 'files/dummies.pdf';

        return view('shipment.support.guide', compact('title', 'pdf'));
    }

    public function regulation()
    {
        $title = 'Regulasi Pengiriman';
        $pdf = 'files/dummies.pdf';
        
        return view('shipment.support.regulation', compact('title', 'pdf'));
    }
}
