<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceValidation;
use App\Models\OurService;
use Illuminate\Http\Request;

class OurServiceController extends Controller
{

    public function manage()
    {
        $ourService = OurService::orderBy('title', 'asc')->get();
        $listIcon = [
            'fab fa-angellist',
            'fas fa-anchor',
            'fab fa-angular',
            'fas fa-battery-full', 
            'fab fa-affiliatetheme',
            'fab fa-algolia', 
            'fab fa-amazon-pay'
        ];

        return view('admin.services.manage', compact('ourService', 'listIcon'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ourService = OurService::orderBy('title', 'asc')->get();
        return response()->json($ourService);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceValidation $request)
    {
        OurService::create([
            'icon' => $request->icon,
            'title' => $request->title,
            'desc' => $request->desc
        ]);

        return redirect()->back()->with('success', 'Successfully add new service');
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
        $serviceToUpdate = OurService::findOrFail($id);
        $serviceToUpdate->icon = $request->icon;
        $serviceToUpdate->title = $request->title;
        $serviceToUpdate->desc = $request->desc;

        $serviceToUpdate->save();
        return redirect()->back()->with(
            'success', "Successfully change service $serviceToUpdate->title"
        );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serviceToDelete = OurService::findOrFail($id);
        $serviceName = $serviceToDelete->title;

        $serviceToDelete->delete();
        return redirect()->back()->with(
            'success', "Successfully remove service $serviceName"
        );
    }
}
