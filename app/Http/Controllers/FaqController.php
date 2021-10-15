<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\StoreFaqValidation;
use App\Http\Requests\UpdateFaqValidation;
use App\Models\Faq;
use App\Models\LandingSectionDesc;
use App\Models\User;

class FaqController extends Controller
{

    public function manage()
    {
        $faqs = Faq::where('domain_owner', request()->getSchemeAndHttpHost())->get();
        $landingSection = LandingSectionDesc::where('id', 5)->first();
        
        return view('admin.faq.manage', compact('faqs', 'landingSection'));
    }

    public function index()
    {
        $faqs = Faq::all();

        return response()->json($faqs);
    }

    public function store(StoreFaqValidation $request)
    {
        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'user_id' => auth()->id()
        ]);

        return Helper::returnSuccess('add new FAQ');
    }

    public function edit($id)
    {
        //
    }

    public function update(UpdateFaqValidation $request, $id)
    {
        Faq::findOrFail($id)->update([
            'question' => $request->question_edit,
            'answer' => $request->answer_edit,
            'user_id' => auth()->id()
        ]);

        return Helper::returnSuccess('update FAQ');
    }

    public function destroy($id)
    {
        if (auth()->user()->role == 'admin') {
            Faq::findOrFail($id)->delete();
            return Helper::returnSuccess('remove FAQ');
        }
        else {
            abort(403);
        }
    }
}
