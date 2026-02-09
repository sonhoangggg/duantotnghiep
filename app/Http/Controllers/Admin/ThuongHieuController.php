<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThuongHieu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ThuongHieuController extends Controller
{
    public function index()
    {
        $thuongHieus = ThuongHieu::latest()->get();
        return view('admin.thuong_hieu.index', compact('thuongHieus'));
    }

    public function create()
    {
        return view('admin.thuong_hieu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten' => 'required|unique:thuong_hieus,ten',
            'logo' => 'nullable|image',
        ]);

        $data = $request->only('ten', 'mo_ta');
        $data['slug'] = Str::slug($request->ten);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('thuong-hieu', 'public');
        }

        ThuongHieu::create($data);

        return redirect()->route('admin.thuong-hieu.index')
            ->with('success', 'Thêm thương hiệu thành công');
    }

    public function edit($id)
    {
        $thuongHieu = ThuongHieu::findOrFail($id);
        return view('admin.thuong_hieu.edit', compact('thuongHieu'));
    }

    public function update(Request $request, $id)
    {
        $thuongHieu = ThuongHieu::findOrFail($id);

        $request->validate([
            'ten' => 'required|unique:thuong_hieus,ten,' . $id,
        ]);

        $data = $request->only('ten', 'mo_ta');
        $data['slug'] = Str::slug($request->ten);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('thuong-hieu', 'public');
        }

        $thuongHieu->update($data);

        return redirect()->route('admin.thuong-hieu.index')
            ->with('success', 'Cập nhật thành công');
    }

    public function destroy($id)
    {
        ThuongHieu::findOrFail($id)->delete();
        return back();
    }

    public function trash()
    {
        $thuongHieus = ThuongHieu::onlyTrashed()->get();
        return view('admin.thuong_hieu.trash', compact('thuongHieus'));
    }

    public function restore($id)
    {
        ThuongHieu::onlyTrashed()->findOrFail($id)->restore();
        return back();
    }

    public function forceDelete($id)
    {
        ThuongHieu::onlyTrashed()->findOrFail($id)->forceDelete();
        return back();
    }
}
