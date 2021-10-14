<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use Illuminate\Http\Request;

class ShipmentOrderController extends Controller
{
    public function index()
    {
        $title = 'Data order';
        return view('shipment.order.index', compact('title'));
    }

    public function dummyPreviousRecipient($id)
    {
        $prevRecipient = Helper::getJson('prev-recipient.json')[$id - 1];
        //todo: change this to get data from database

        return response()->json($prevRecipient);
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
