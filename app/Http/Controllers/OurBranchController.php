<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\StoreBranchValidation;
use App\Http\Requests\UpdateBranchValidation;
use App\Models\OurBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OurBranchController extends Controller
{
    private function uploadIcon(Request $request)
    {
        $icon = $request->file('icon');
        $fileIcon = $icon->store('public/branch');

        $pathIcon = Str::replaceFirst('public/', 'storage/', $fileIcon);

        if (!is_dir('storage/branch/')) {
            mkdir('storage/branch/');
        }

        $file_tmp = $_FILES['icon']['tmp_name'];

        move_uploaded_file($file_tmp, $pathIcon);

        return $pathIcon;
    }

    public function index()
    {
        $ourBranch = OurBranch::where(
            'domain_owner',
            request()->getSchemeAndHttpHost()
        )->get();
        return view('admin.branch.index', compact('ourBranch'));
    }

    public function store(StoreBranchValidation $request)
    {
        OurBranch::create([
            'name' => $request->name,
            'icon' => $this->uploadIcon($request),
            'telephone' => $request->telephone,
            'address' => $request->address,
            'domain_owner' => request()->getSchemeAndHttpHost()
        ]);

        return Helper::returnSuccess('menambah cabang baru');
    }

    public function update(UpdateBranchValidation $request, $id)
    {
        $ourBranch = OurBranch::findOrFail($id);
        $ourBranch->name = $request->name;
        if ($request->hasFile('icon')) {
            unlink($ourBranch->icon);
            $ourBranch->icon = $this->uploadIcon($request);
        }
        $ourBranch->telephone = $request->telephone;
        $ourBranch->address = $request->address;

        $ourBranch->save();
        return Helper::returnSuccess("mengedit cabang $ourBranch->name");
    }

    public function destroy($id)
    {
        $branch = OurBranch::findOrFail($id);
        $branchName = $branch->name;

        unlink($branch->icon);
        $branch->delete();

        return Helper::returnSuccess("hapus cabang $branchName");
    }
}
