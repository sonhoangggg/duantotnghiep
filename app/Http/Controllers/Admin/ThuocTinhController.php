<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThuocTinh;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class ThuocTinhController extends Controller
{

    public function index()
    {
        $thuocTinhs = ThuocTinh::with('giaTri')->get();
        return view('admin.thuoc_tinh.index')->with([
            'thuocTinhs' => $thuocTinhs,
        ]);
    }
    public function create()
    {
        return view('admin.thuoc_tinh.creat');
    }
    public function add(Request $request)
    {
        $request->validate([
            'ten' => 'required|max:50|unique:thuoc_tinhs,ten',
            'kieu' => 'required'
        ], [
            'ten.required' => 'Tên không được bỏ trống',
            'ten.unique'   => 'Tên thuộc tính đã tồn tại',
            'kieu.required' => 'Kiểu thuộc tính là bắt buộc',
        ]);
        ThuocTinh::create([
            'ten' => $request->ten,
            'kieu' => $request->kieu
        ]);
        return redirect()->route('admin.thuoc-tinh./')->with([
            'success' => 'Thêm thành công '
        ]);
    }

    public function edit($id)
    {

        $thuocTinh = ThuocTinh::find($id);
        return view('admin.thuoc_tinh.edit')->with([
            'thuocTinh' => $thuocTinh
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'ten' =>  'required|max:50|unique:thuoc_tinhs,ten,' . $id,
            'kieu' => 'required'
        ], [
            'ten.required' => 'Tên không được bỏ trống',
            'ten.unique'   => 'Tên thuộc tính đã tồn tại',
            'kieu.required' => 'Kiểu thuộc tính là bắt buộc',
        ]);
        ThuocTinh::where('id', $id)->update([
            'ten'  => $request->ten,
            'kieu' => $request->kieu
        ]);
        return redirect()->route('admin.thuoc-tinh./')->with([
            'success' => 'Cập nhập thành công '
        ]);
    }
    public function delete($id){
        $thuocTinh  = ThuocTinh::find($id);
        $thuocTinh->delete();
        return redirect()->route('admin.thuoc-tinh./')->with([
            'success' => 'Cập nhập thành công '
        ]);
    }
}
