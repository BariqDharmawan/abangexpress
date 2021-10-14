<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackingOrderController extends Controller
{
    
    public function index(Request $request)
    {   
        $request->validate([
            'track_order' => ['required', 'min:3', 'string']
        ]);

        //todo: integrate search result here
        $result = $request->track_order;
        // dd($result);

        return redirect()->back()->with('result', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

}
