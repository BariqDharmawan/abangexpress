<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceValidation;
use App\Models\OurService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OurServiceController extends Controller
{

    public function manage()
    {
        $ourService = OurService::orderBy('title', 'asc')->get();
        $listIcon = [
            'fab fa-angellist',
            'fas fa-anchor',
            'fab fa-angular',
            'fab fa-affiliatetheme'
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
        $icon = $request->file('icon');
        $pathIcon = Storage::putFile(
            'public/cover-vision-mission',
            $icon
        );

        OurService::create([
            'icon' => Str::replaceFirst('public/','/storage/',$pathIcon),
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
        
        $icon = $request->file('icon');
        if ($request->hasFile('icon')) {
            $pathIcon = Storage::putFile(
                'public/cover-vision-mission',
                $icon
            );
            $serviceToUpdate->icon = Str::replaceFirst('public/', '/storage/', $pathIcon);
        }

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
