<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\StoreFaqValidation;
use App\Http\Requests\UpdateFaqValidation;
use App\Models\Faq;

class FaqController extends Controller
{

    public function manage()
    {
        $faqs = Faq::all();
        return view('admin.faq.manage', compact('faqs'));
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
            'admin_id' => 1
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
            'admin_id' => 1
        ]);

        return Helper::returnSuccess('update FAQ');
    }

    public function destroy($id)
    {
        Faq::findOrFail($id)->delete();
        return Helper::returnSuccess('remove FAQ');
    }
}
