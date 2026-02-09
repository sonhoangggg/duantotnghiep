<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DanhMucController extends Controller
{
    public function index()
    {
        $danhMucs = DanhMuc::whereNull('deleted_at')->get();
        return view('admin.danh_muc.index', compact('danhMucs'));
    }

    public function create()
{
    $danhMucs = DanhMuc::whereNull('parent_id')->get();
    // hoặc DanhMuc::all() nếu muốn chọn tất

    return view('admin.danh_muc.create', compact('danhMucs'));
}


    public function store(Request $request)
    {
        $request->validate([
            'ten' => 'required|unique:danh_mucs,ten',
            'logo' => 'nullable|image',
        ]);

        $data = $request->only(['ten', 'mo_ta', 'parent_id']);
        $data['slug'] = Str::slug($request->ten);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('danh-muc', 'public');
        }

        DanhMuc::create($data);

return redirect()->route('admin.danh-muc.index')
    ->with('success', 'Thêm danh mục thành công');
    }


    public function edit($id)
    {
        $danhMuc = DanhMuc::findOrFail($id);
        $parents = DanhMuc::whereNull('parent_id')->where('id', '!=', $id)->get();
        return view('admin.danh_muc.edit', compact('danhMuc', 'parents'));
    }

   public function update(Request $request, $id)
{
    $danhMuc = DanhMuc::findOrFail($id);

    $request->validate([
        'ten' => 'required|unique:danh_mucs,ten,' . $id,
        'logo' => 'nullable|image',
    ]);

    $data = $request->only(['ten', 'mo_ta', 'parent_id']);
    $data['slug'] = Str::slug($request->ten);

    if ($request->hasFile('logo')) {
        $data['logo'] = $request->file('logo')->store('danh-muc', 'public');
    }

    $danhMuc->update($data);

    return redirect()
        ->route('admin.danh-muc.index')
        ->with('success', 'Cập nhật danh mục thành công');
}


    public function destroy($id)
    {
        DanhMuc::findOrFail($id)->delete();
        return back();
    }

    public function trash()
    {
        $danhMucs = DanhMuc::onlyTrashed()->get();
        return view('admin.danh_muc.trash', compact('danhMucs'));
    }

    public function restore($id)
    {
        DanhMuc::onlyTrashed()->findOrFail($id)->restore();
        return back();
    }

    public function forceDelete($id)
    {
        DanhMuc::onlyTrashed()->findOrFail($id)->forceDelete();
        return back();
    }
}
