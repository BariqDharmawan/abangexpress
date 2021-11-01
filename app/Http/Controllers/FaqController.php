<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\StoreFaqValidation;
use App\Http\Requests\UpdateFaqValidation;
use App\Models\AboutUs;
use App\Models\Faq;
use App\Models\LandingSectionDesc;
use App\Models\LandingSectionTitle;
use App\Models\User;

class FaqController extends Controller
{

    public function manage()
    {
        $faqs = Faq::where('domain_owner', request()->getSchemeAndHttpHost())->get();

        $sectionTitle = LandingSectionTitle::where(
            'domain_owner', request()->getSchemeAndHttpHost()
        )->select('faq')->first()->faq;

        $faqSectionDesc = LandingSectionDesc::where('domain_owner', request()->getSchemeAndHttpHost())->get();
        $landingSection = $faqSectionDesc;

        return view('admin.faq.manage', compact('faqs', 'landingSection', 'sectionTitle'));
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

        return Helper::returnSuccess('menambah FAQ baru');
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

        return Helper::returnSuccess('mengubah FAQ');
    }

    public function destroy($id)
    {
        $faq = Faq::where([
            ['domain_owner', request()->getSchemeAndHttpHost()],
            ['id', $id]
        ])->firstOrFail();

        $faq->delete();

        return Helper::returnSuccess('menghapus FAQ');
    }
}
