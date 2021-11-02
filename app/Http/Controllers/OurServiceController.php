<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\StoreServiceValidation;
use App\Http\Requests\UpdateServiceValidation;
use App\Models\LandingSectionDesc;
use App\Models\LandingSectionTitle;
use App\Models\OurService;
use Illuminate\Http\Request;

class OurServiceController extends Controller
{

    public function manage()
    {
        $ourService = OurService::orderBy('title', 'asc')
                    ->where('domain_owner', request()->getSchemeAndHttpHost())->get();
        $listIcon = Helper::getJson('list-icon-service.json', true);

        $sectionTitle = LandingSectionTitle::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->select('our_service')->first()->our_service ?? '';

        return view('admin.services.manage', compact(
            'ourService', 'listIcon', 'sectionTitle'
        ));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ourService = OurService::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->orderBy('title', 'asc')->get();
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
            'desc' => $request->desc,
            'domain_owner' => request()->getSchemeAndHttpHost()
        ]);

        return Helper::returnSuccess('menambah service baru');
    }

    public function update(UpdateServiceValidation $request, $id)
    {
        $serviceToUpdate = OurService::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['id', $id]
        ])->firstOrFail();

        $serviceToUpdate->icon = $request->icon;
        $serviceToUpdate->title = $request->title;
        $serviceToUpdate->desc = $request->desc;
        $serviceToUpdate->save();

        LandingSectionTitle::updateOrCreate(
            ['domain_owner' => request()->getSchemeAndHttpHost()],
            ['our_service' => $request->section_name]
        );

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
        $serviceToDelete = OurService::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['id', $id]
        ])->first();

        $serviceName = $serviceToDelete->title;

        $serviceToDelete->delete();
        return redirect()->back()->with(
            'success', "Successfully remove service $serviceName"
        );
    }
}
