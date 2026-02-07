<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GiaTriThuocTinh;
use App\Models\ThuocTinh;
use Illuminate\Http\Request;

class GiaTriThuocTinhController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $thuocTinh = ThuocTinh::find($id);
        // dd($thuocTinh);die;
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

        $thuocTinh = ThuocTinh::find($id);
        $request->validate([
            'ten' => 'required|max:50|unique:gia_tri_thuoc_tinhs,gia_tri'
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
                    'gia_tri' => '/storage/'. $path
                ]);
            }
        }
        else{
            GiaTriThuocTinh::create([
                'thuoc_tinh_id' => $id,
                'ten_hien_thi' => $request->ten
            ]);

        }

        return redirect()->route('admin.thuoc-tinh.gia-tri.them',$id)->with([
            'success' => 'Thêm thành công'
        ]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
