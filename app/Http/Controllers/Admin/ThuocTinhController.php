<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThuocTinh;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;

class ThuocTinhController extends Controller
{

    public function index()
    {
        $thuocTinhs = ThuocTinh::with('giaTri')->get();
        // dd($thuocTinhs);
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
        Swal::success([
            'title' => 'Thêm thành công!',
            'text' => 'Thuộc tính đã được thêm thành công.',
        ]);
        return redirect()->route('admin.thuoc-tinh./');
    }

    public function edit($id)
    {

        $thuocTinh = ThuocTinh::findOrFail($id);
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
        Swal::success([
            'title' => 'Cập nhập thành công!',
            'text' => 'Thuộc tính đã được cập nhập thành công.',
        ]);
        return redirect()->route('admin.thuoc-tinh./');
    }
    public function delete($id)
    {
        $thuocTinh  = ThuocTinh::findOrFail($id);
        $thuocTinh->delete();
        Swal::success([
            'title' => 'Xóa thành công!',
            'text' => 'Thuộc tính đã được xóa thành công.',
        ]);
        return redirect()->route('admin.thuoc-tinh./');
    }
}
