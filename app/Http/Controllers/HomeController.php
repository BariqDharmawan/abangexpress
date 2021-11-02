<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\HomeHeadingValidation;
use App\Models\AboutUs;
use App\Models\FirstHeroCarouselLanding;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $heroCarousel = FirstHeroCarouselLanding::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->get();

        $identity = AboutUs::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->first();

        return view('admin.home.index', compact('heroCarousel', 'identity'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(HomeHeadingValidation $request)
    {
        if ($request->has('slogan')) {
            $ourIdentity = AboutUs::updateOrCreate(
                ['domain_owner' => request()->getSchemeAndHttpHost()],
                ['slogan' => $request->slogan]
            );
        }

        if ($request->has('our_name')) {
            $ourIdentity = AboutUs::updateOrCreate(
                ['domain_owner' => request()->getSchemeAndHttpHost()],
                ['our_name' => $request->our_name]
            );
        }

        return Helper::returnSuccess("mengubah heading");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
