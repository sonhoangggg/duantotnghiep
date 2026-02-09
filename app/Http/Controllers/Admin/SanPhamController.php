<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BienTheSanPham;
use App\Models\DanhMuc;
use App\Models\GiaTriThuocTinh;
use App\Models\SanPham;
use App\Models\ThongSo;
use App\Models\ThuocTinh;
use App\Models\ThuongHieu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sanPhams = SanPham::orderBy('created_at', 'desc')->paginate(10);
        $sanPhams->load('bienThes');
        return view('admin.san_pham.index')->with(['sanPhams' => $sanPhams]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $danhMucs = DanhMuc::all();
        $thuongHieus = ThuongHieu::all();
        $thongSos = ThongSo::all();
        return view('admin.san_pham.create')->with([
            'danhMucs' => $danhMucs,
            'thuongHieus' => $thuongHieus,
            'thongSos' => $thongSos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'ten_sp' => 'required|string|max:255|unique:san_phams,ten',
            'slug_sp' => 'required|string|max:100|unique:san_phams,slug',
            'sku_sp' => 'required|string|max:100|unique:san_phams,sku',
            'so_luong' => 'required|numeric',
            'gia_tt' => 'required|numeric',
            'gia_km' => 'numeric|nullable',
            'anh_chinh' => 'required|image',
            'anh_phu.*' => 'image',
        ]);
        if ($request->hasFile('anh_chinh')) {
            $anh_chinh = $request->file('anh_chinh');
            $ten_anh = time() . '.' . $anh_chinh->getClientOriginalExtension();
            $duong_dan = $anh_chinh->storeAs('image', $ten_anh, 'public');
        }
        if ($request->sp_noi_bat) {
            $noi_bat = 1;
        } else {
            $noi_bat = 0;
        }
        $slug = Str::slug($request->ten_sp, '-');

        $sanPham = SanPham::create([
            'ten' => $request->ten_sp,
            'slug' => Str::limit($slug, 100, ''),
            'sku' => $request->sku_sp,
            'so_luong' => $request->so_luong,
            'gia_goc' => $request->gia_tt,
            'gia_ban' => $request->gia_km,
            'anh_chinh' => '/storage/' . $duong_dan,
            'thuong_hieu_id' => $request->thuong_hieu,
            'mo_ta_ngan' => $request->mo_ta_ngan,
            'mo_ta_chi_tiet' => $request->mo_ta,
            'trang_thai' => $request->sp_hien_thi ? 'hien' : 'an',
            'noi_bat' => $noi_bat,
            'nguoi_tao' => 1,
        ]);
        if (isset($request->danh_muc)) {
            $sanPham->danhMucs()->attach($request->danh_muc);
        }
        if ($request->hasFile('anh_phu')) {
            $anh_phus = $request->file('anh_phu');
            foreach ($anh_phus as $anh_phu) {
                $ten_anh_phu = time() . uniqid() . '.' . $anh_phu->getClientOriginalExtension();
                $duong_dan_phu = $anh_phu->storeAs('image', $ten_anh_phu, 'public');
                $sanPham->anhSanPhams()->create([
                    'duong_dan' => '/storage/' . $duong_dan_phu,
                ]);
            }
        }
        if (isset($request->gia_tri_thong_so)) {
            foreach ($request->gia_tri_thong_so as $thong_so_id => $value) {
                if ($value !== null) {
                    $sanPham->thongSos()->attach([
                        $thong_so_id => ['gia_tri' => $value]
                    ]);
                }
            }
        }
        return redirect()->route('admin.san-pham./')->with('success', 'Thêm sản phẩm thành công!');
        // dd($request->gia_tri_thong_so);die;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $sanPham = SanPham::with('danhMucs', 'thuongHieu', 'thongSos', 'anhSanPhams')->where('slug', $slug)->first();
        $sanPham  = $sanPham->load('bienThes.bienTheThuocTinhs');

        $gia_min = [];
        $gia_max = [];
        if($sanPham->loai === 'don'){
            $giaHienThi = $sanPham->gia_ban ?? $sanPham->gia_goc;
        }
        else{
            $giaBienthe = [];
            foreach($sanPham->bienThes as $bienThe){
                $giaBienthe[] = $bienThe->gia_ban ?? $bienThe->gia_goc;
            }
            $gia_min = min($giaBienthe);
            $gia_max = max($giaBienthe);

        }
        return view('admin.san_pham.show')->with([
            'sanPham' => $sanPham,
            'gia_min' => $gia_min,
            'gia_max' => $gia_max
            // 'bienThes' => $bienThes
            ]);
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
    public function dsBienThe($slug)
    {
        $sanPham = SanPham::where('slug', $slug)->first();
        $bienThes = $sanPham->bienThes()->get();
        $bienThes->load([
            'bienTheThuocTinhs.thuocTinh'
        ]);
        return view('admin.san_pham.bien_the.index')->with([
            'sanPham' => $sanPham,
            'bienThes' => $bienThes,
        ]);
    }
    public function themBienThe($slug)
    {
        $thongSos = ThongSo::all();
        $sanPham = SanPham::where('slug', $slug)->first();
        $thuocTinhs = ThuocTinh::with('giaTri')->get();
        // dd($thuocTinhs);die;
        return view('admin.san_pham.bien_the.create')->with([
            'sanPham' => $sanPham,
            'thuocTinhs' => $thuocTinhs,
            'thongSos' => $thongSos,
        ]);
    }
    public function luuBienThe(Request $request, $slug)
    {
        $request->validate(
            [
                'sku_bien_the' => 'required|string|max:100|unique:bien_the_san_phams,sku',
                'gia_tt' => 'required|numeric',
                'gia_km' => 'required|numeric|lt:gia_tt',
                'so_luong' => 'required|numeric',
                'anh_bien_the' => 'required|image',
                'gia_tri' => 'required|array',
                'thuoc_tinh' => 'required|array',
            ],
            [
                'gia_tri.required' => 'Vui lòng chọn giá trị cho thuộc tính.',
                'thuoc_tinh.required' => 'Vui lòng chọn thuộc tính.',
                'gia_tt.required' => 'Vui lòng nhập giá gốc.',
                'gia_km.required' => 'Vui lòng nhập giá khuyến mãi.',
                'gia_tt.numeric' => 'Giá gốc phải là số.',
                'gia_km.numeric' => 'Giá khuyến mãi phải là số.',
                'so_luong.required' => 'Vui lòng nhập số lượng.',
                'anh_bien_the.required' => 'Vui lòng chọn ảnh biến thể.',
                'sku_bien_the.required' => 'Vui lòng nhập SKU cho biến thể.',
                'sku_bien_the.unique' => 'SKU đã tồn tại, vui lòng nhập SKU khác.',
                'sku_bien_the.max' => 'SKU không được vượt quá 100 ký tự.',
                'gia_km.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc.',
            ]
        );
        $sanPham = SanPham::where('slug', $slug)->first();
        if ($request->hasFile('anh_bien_the')) {
            $anh_bien_the = $request->file('anh_bien_the');
            $ten_anh = time() . '.' . $anh_bien_the->getClientOriginalExtension();
            $duong_dan = $anh_bien_the->storeAs('image', $ten_anh, 'public');
        }
        $bienThe = BienTheSanPham::create([
            'san_pham_id' => $sanPham->id,
            'sku' => Str::slug($request->sku_bien_the, '-'),
            'anh_bien_the' => '/storage/' . $duong_dan,
            'gia_goc' => $request->gia_tt,
            'gia_ban' => $request->gia_km,
            'so_luong' => $request->so_luong,
            'trang_thai' => isset($request->trang_thai) ? 'hien' : 'an',
        ]);
        foreach ($request->gia_tri as $thuoc_tinh_id => $gia_tri_id) {
            $bienThe->bienTheThuocTinhs()->attach([
                $gia_tri_id => ['thuoc_tinh_id' => $thuoc_tinh_id]
            ]);
        }
        if(isset($request->gia_tri_thong_so)){
            foreach($request->gia_tri_thong_so as $thong_so_id => $gia_tri){
                if($gia_tri !== null){
                    $bienThe->thongSoBienThe()->attach([
                        $thong_so_id => ['gia_tri' => $gia_tri]
                    ]);
            }
        }
        if ($sanPham->loai !== 'bien_the') {
            $sanPham->update([
                'loai' => 'bien_the',
                'gia_goc' => null,
                'gia_ban' => null,
                'so_luong' => null,
            ]);
        }
        return redirect()->route('admin.san-pham.quan-ly-bien-the', ['slug' => $sanPham->slug])
            ->with('success', 'Thêm biến thể sản phẩm thành công!');
    }
}

}
