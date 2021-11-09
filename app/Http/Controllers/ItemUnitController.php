<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\StoreItemUnitValidation;
use App\Models\ItemUnit;
use Illuminate\Http\Request;

class ItemUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = ItemUnit::where('domain_owner', request()->getSchemeAndHttpHost())->get();
        return view('admin.unit.index', compact('units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemUnitValidation $request)
    {
        ItemUnit::create([
            'name' => $request->name,
            'domain_owner' => request()->getSchemeAndHttpHost()
        ]);

        return Helper::returnSuccess("menambah satuan unit bernama $request->name");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreItemUnitValidation $request, ItemUnit $itemUnit)
    {
        $itemUnit->update([
            'name' => $request->name,
            'domain_owner' => request()->getSchemeAndHttpHost()
        ]);

        return Helper::returnSuccess("merubah satuan unit bernama $request->name");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemUnit $itemUnit)
    {
        $itemUnit->delete();

        return Helper::returnSuccess('menghapus unit');
    }
}
