<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShipmentOrderController extends Controller
{
    public function index()
    {
        $title = 'Data order';
        return view('shipment.order.index', compact('title'));
    }

    public function process()
    {
        $title = 'Dalam Proses';
        return view('shipment.order.process', compact('title'));
    }

    public function pending()
    {
        $title = 'Pending Proses';
        return view('shipment.order.pending', compact('title'));
    }

    public function history()
    {
        $title = 'History Kiriman';
        return view('shipment.order.history', compact('title'));
    }

    public function receipt()
    {
        $title = 'Cetak Ulang Resi';
        return view('shipment.order.receipt', compact('title'));
    }

}
