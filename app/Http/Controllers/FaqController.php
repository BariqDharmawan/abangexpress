<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\StoreFaqValidation;
use App\Http\Requests\UpdateFaqValidation;
use App\Models\AboutUs;
use App\Models\Faq;
use App\Models\User;

class FaqController extends Controller
{

    public function manage()
    {
        $faqs = Faq::where('domain_owner', request()->getSchemeAndHttpHost())->get();
        // dd(auth()->id());
        return view('admin.faq.manage', compact('faqs'));
    }

    public function index()
    {
        $faqs = Faq::where('domain_owner', request()->getSchemeAndHttpHost())->get();

        return response()->json($faqs);
    }

    public function store(StoreFaqValidation $request)
    {
        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'domain_owner' => request()->getSchemeAndHttpHost()
        ]);

        return Helper::returnSuccess('add new FAQ');
    }

    public function update(UpdateFaqValidation $request, $id)
    {
        Faq::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['id', $id]
        ])->update([
            'question' => $request->question_edit,
            'answer' => $request->answer_edit
        ]);

        return Helper::returnSuccess('update FAQ');
    }

    public function destroy($id)
    {
        $faq = Faq::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['id', $id]
        ])->firstOrFail();
        
        $faq->delete();

        return Helper::returnSuccess('remove FAQ');
    }
}
