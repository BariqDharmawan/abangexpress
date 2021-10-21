<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoicePayValidation;
use Illuminate\Http\Request;

class InvoicePayingController extends Controller
{
    
    public function index($invoiceNumber = null)
    {
        return view('shipment.invoice.pay', compact('invoiceNumber'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoicePayValidation $request, $invoiceNumber)
    {
        dd($request->validated(), $invoiceNumber);
    }

}
