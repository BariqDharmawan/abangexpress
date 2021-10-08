<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShipmentInvoiceController extends Controller
{
    public function bill()
    {
        $title = 'Tagihan';
        return view('shipment.invoice.bill', compact('title'));
    }

    public function verifying()
    {
        $title = 'Dalam Prose Verifikasi';
        return view('shipment.invoice.verifying', compact('title'));
    }

    public function settled()
    {
        $title = 'Lunas';
        return view('shipment.invoice.settled', compact('title'));
    }
}
