<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GiaTriThuocTinh;
use App\Models\ThuocTinh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SweetAlert2\Laravel\Swal;

class GiaTriThuocTinhController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $thuocTinh = ThuocTinh::findOrFail($id);
        return view('admin.gia_tr_thuoc_tinh.index')->with([
            'thuocTinh' => $thuocTinh
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {

        // dd($id);die;

        $thuocTinh = ThuocTinh::findOrFail($id);
        $request->validate([
            'ten' => 'required|max:50|unique:gia_tri_thuoc_tinhs,ten_hien_thi',
        ], [
            'ten.required' => 'Tên hiển thị không được bỏ trống',
            'ten.unique'   => 'Tên hiển thị đã tồn tại',
        ]);
        if ($thuocTinh->kieu == 'mau') {
            GiaTriThuocTinh::create([
                'thuoc_tinh_id' => $id,
                'ten_hien_thi' => $request->ten,
                'gia_tri' => $request->gia_tri
            ]);
        } elseif ($thuocTinh->kieu == 'anh') {
            if ($request->hasFile('gia_tri')) {
                $file = $request->file('gia_tri');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('image', $fileName, 'public');
                GiaTriThuocTinh::create([
                    'thuoc_tinh_id' => $id,
                    'ten_hien_thi' => $request->ten,
                    'gia_tri' => $path
                ]);
            }
        } else {
            GiaTriThuocTinh::create([
                'thuoc_tinh_id' => $id,
                'ten_hien_thi' => $request->ten
            ]);
        }
        Swal::success([
            'title' => 'Thêm thành công!',
            'text' => 'Giá trị thuộc tính đã được thêm thành công.',
        ]);
        return redirect()->route('admin.thuoc-tinh.gia-tri.cau-hinh', $id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gia_tri = GiaTriThuocTinh::findOrFail($id);
        // dd($gia_tri->thuocTinh );
        return view('admin.gia_tr_thuoc_tinh.edit')->with([
            'gia_tri' => $gia_tri
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'ten_hien_thi' => 'required|max:50|unique:gia_tri_thuoc_tinhs,ten_hien_thi,' . $id
        ], [
            'ten_hien_thi.required' => 'Tên hiển thị không được bỏ trống',
            'ten_hien_thi.unique'   => 'Tên hiển thị đã tồn tại',

        ]);
        $gia_tri = GiaTriThuocTinh::with('thuocTinh')->findOrFail($id);
        switch ($gia_tri->thuocTinh->kieu) {
            case 'mau':
                $gia_tri->update([
                    'ten_hien_thi' => $request->ten_hien_thi,
                    'gia_tri' => $request->gia_tri
                ]);
                break;
            case 'anh':

                if ($request->hasFile('gia_tri')) {
                    if ($gia_tri->gia_tri) {
                        Storage::disk('public')->delete($gia_tri->gia_tri);
                    }
                    $file = $request->file('gia_tri');
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('image', $fileName, 'public');
                    $gia_tri->update([
                        'ten_hien_thi' => $request->ten_hien_thi,
                        'gia_tri' => $path
                    ]);
                } else {
                    $gia_tri->update([
                        'ten_hien_thi' => $request->ten_hien_thi
                    ]);
                }
                break;

            default:
                $gia_tri->update([
                    'ten_hien_thi' => $request->ten_hien_thi
                ]);
                # code...
                break;
        }

        Swal::success(
            [
                'title' => 'Sửa thành công',
                'text' => 'Sửa giá trị thuộc tính thành công'
            ]
        );
        return redirect()->route('admin.thuoc-tinh.gia-tri.cau-hinh', $gia_tri->thuocTinh->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gia_tri = GiaTriThuocTinh::findOrFail($id);
        $gia_tri->delete();
        Swal::success([
            'title' => 'Xóa thành công!',
            'text' => 'Giá trị thuộc tính đã được xóa thành công.',
        ]);
        return redirect()->route('admin.thuoc-tinh.gia-tri.cau-hinh', $gia_tri->thuocTinh->id);
    }
}
