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
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use SweetAlert2\Laravel\Swal;

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
            'anh_chinh' =>  $duong_dan,
            'thuong_hieu_id' => $request->thuong_hieu,
            'mo_ta_ngan' => $request->mo_ta_ngan,
            'mo_ta_chi_tiet' => $request->mo_ta,
            'trang_thai' => $request->sp_hien_thi ? 'hien' : 'an',
            'noi_bat' => $noi_bat,
            'nguoi_tao' => 3,
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
                    'duong_dan' =>  $duong_dan_phu,
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
        Swal::success([
            'title' => 'Thêm thành công!',
            'text' => 'Sản phẩm đã được thêm thành công.',
        ]);
        return redirect()->route('admin.san-pham./')->with('success', 'Thêm sản phẩm thành công!');
        // dd($request->gia_tri_thong_so);die;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {

        $san_pham = SanPham::with('bienThes.bienTheThuocTinhs.thuocTinh')->where('slug', $slug)->firstOrFail();
        // dd($san_pham->bienThes);


        switch ($san_pham->loai) {
            case 'don':
                $gia_goc = $san_pham->gia_goc;
                $gia_ban = $san_pham->gia_ban;
                return view('admin.san_pham.show')->with([
                    'san_pham' => $san_pham,
                    'gia_goc' => $gia_goc,
                    'gia_ban' => $gia_ban,
                ]);
                break;

            case 'bien_the':
                $bien_thes =  $san_pham->bienThes;
                $gia = $bien_thes->map(function ($bienThe) {
                    return $bienThe->gia_ban ?? $bienThe->gia_goc;
                })->filter();
                $thuocTinhs = $san_pham->bienThes
                    ->flatMap->bienTheThuocTinhs
                    ->groupBy(fn($gt) => $gt->thuocTinh->ten);

                $gia_goc = $gia->max();
                $gia_ban = $gia->min();

                $gia_tri_thuoc_tinh = [];

                foreach ($san_pham->bienThes as $bt) {
                    if($bt->trang_thai == 'hien'){
                        foreach ($bt->bienTheThuocTinhs as $gt) {

                        $thuocTinh = $gt->thuocTinh;

                        $gia_tri_thuoc_tinh[$thuocTinh->id]['id']   = $thuocTinh->id;
                        $gia_tri_thuoc_tinh[$thuocTinh->id]['ten']  = $thuocTinh->ten;
                        $gia_tri_thuoc_tinh[$thuocTinh->id]['kieu'] = $thuocTinh->kieu;


                        $gia_tri_thuoc_tinh[$thuocTinh->id]['gia_tri'][$gt->id] = [
                            'id'  => $gt->id,
                            'ten' => $gt->ten_hien_thi,
                            'gia_tri' => $gt->gia_tri
                        ];
                    }
                    }
                }


                // dd($gia_tri_thuoc_tinh);


                return view('admin.san_pham.show')->with([
                    'san_pham' => $san_pham,
                    'gia_goc' => $gia_goc,
                    'gia_ban' => $gia_ban,
                    'gia_tri_thuoc_tinh' => $gia_tri_thuoc_tinh,
                    'thuocTinhs' => $thuocTinhs
                ]);
                break;
            default:
                # code...
                break;
        }
        // dd( $san_pham );

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $san_pham = SanPham::where('slug', $slug)->firstOrFail();
        // dd($san_pham);
        $danhMucs = DanhMuc::all();
        $thuongHieus = ThuongHieu::all();
        $thongSos = ThongSo::all();
        return view('admin.san_pham.edit')->with([
            'danhMucs' => $danhMucs,
            'thuongHieus' => $thuongHieus,
            'thongSos' => $thongSos,
            'san_pham' => $san_pham
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'ten_sp' => 'required|string|max:255|unique:san_phams,ten,' . $slug . ',slug',
            'slug_sp' => 'required|string|max:100|unique:san_phams,slug,' . $slug . ',slug',
            'gia_tt' => 'numeric|nullable',
            'so_luong' => 'numeric|nullable',
            'gia_km' => 'numeric|nullable|lte:gia_tt',
            'sku_sp' => 'required|string|max:100|unique:san_phams,sku,' . $slug . ',slug',
            'anh_chinh' => 'image',
            'anh_phu.*' => 'image',
        ], [
            'ten_sp.required' => 'Tên sản phẩm không được để trống',
            'slug_sp.required' => 'Slug sản phẩm không được để trống',
            'sku_sp.required' => 'SKU sản phẩm không được để trống',

            'ten_sp.unique' => 'Tên sản phẩm đã tồn tại',
            'slug_sp.unique' => 'Slug sản phẩm đã tồn tại',
            'sku_sp.unique' => 'SKU sản phẩm đã tồn tại',
            'gia_km.lte' => 'Giá khuyến mãi phải nhỏ hơn hoặc bằng giá gốc',
            'anh_chinh.image' => 'Ảnh chính phải là định dạng hình ảnh',
            'anh_phu.*.image' => 'Ảnh phụ phải là định dạng hình ảnh',
        ]);
        $san_pham = SanPham::where('slug', $slug)->first();
        if ($request->hasFile('anh_chinh')) {
            if ($san_pham->anh_chinh && Storage::disk('public')->exists($san_pham->anh_chinh)) {
                Storage::disk('public')->delete($san_pham->anh_chinh);
            }

            $file = $request->file('anh_chinh');
            $tenFile = time() . '.' . $file->getClientOriginalExtension();
            $duong_dan = $file->storeAs('image', $tenFile, 'public');
        }
        $slug = Str::slug($request->ten_sp, '-');
        if (isset($request->danh_muc)) {
            $san_pham->danhMucs()->syncWithoutDetaching($request->danh_muc);
        } else {
            $san_pham->danhMucs()->detach($request->danh_muc);
        }
        if ($request->hasFile('anh_phu')) {
            $anh_phus = $request->file('anh_phu');
            if ($san_pham->anhSanPhams) {
                foreach ($san_pham->anhSanPhams as $value) {
                    if (Storage::disk('public')->exists($value->duong_dan)) {
                        Storage::disk('public')->delete($value->duong_dan);
                    }
                }
                $san_pham->anhSanPhams()->delete();
            }
            foreach ($anh_phus as $anh_phu) {
                $ten_anh_phu = time() . uniqid() . '.' . $anh_phu->getClientOriginalExtension();
                $duong_dan_phu = $anh_phu->storeAs('image', $ten_anh_phu, 'public');
                $san_pham->anhSanPhams()->create([
                    'duong_dan' =>  $duong_dan_phu,
                ]);
            }
        }

        if ($request->filled('thong_so')) {
            foreach ($request->thong_so as $thong_so_id => $value) {
                if ($value !== null && $value !== '') {
                    $san_pham->thongSos()->syncWithoutDetaching([
                        $thong_so_id => ['gia_tri' => $value]
                    ]);
                }
            }
        }

        $san_pham->update([
            'ten' => $request->ten_sp,
            'slug' => $request->slug_sp,
            'sku' => $request->sku_sp,
            'so_luong' => isset($request->so_luong) ? $request->so_luong : null,
            'gia_goc' => isset($request->gia_tt) ? $request->gia_tt : null,
            'gia_ban' => isset($request->gia_km) ? $request->gia_km : null,
            'mo_ta_ngan' => $request->mo_ta_ngan,
            'mo_ta_chi_tiet' => $request->mo_ta,
            'noi_bat' => $request->sp_noi_bat ? 1 : 0,
            'trang_thai' => $request->sp_hien_thi ? 'hien' : 'an',
            'thuong_hieu_id' => $request->thuong_hieu_id,
            'anh_chinh' => isset($duong_dan) ? $duong_dan : $san_pham->anh_chinh,
            'nguoi_tao' => 1,
            'loai' => $request->loai_sp,

        ]);
        Swal::success([
            'title' => 'Cập nhật thành công!',
            'text' => 'Sản phẩm đã được cập nhật thành công.',
        ]);
        return redirect()->route('admin.san-pham./');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function delete($slug)
    {
        $san_pham = SanPham::where('slug', $slug)->first();
        $san_pham->delete();
        Swal::success([
            'title' => 'Xóa thành công!',
            'text' => 'Sản phẩm đã được xóa thành công.',
        ]);

        return redirect()->route('admin.san-pham./');
    }



    public function themThuocTinhChoSanPham($slug)
    {
        $sanPham = SanPham::where('slug', $slug)->firstOrFail();
        $thuocTinhs = ThuocTinh::all();
        return view('admin.san_pham.them_thuoc_tinh_cho_san_pham')->with([
            'sanPham' => $sanPham,
            'thuocTinhs' => $thuocTinhs,
        ]);
    }

    public function luuThuocTinhSanPham(Request $request, $slug)
    {
        $sanPham = SanPham::where('slug', $slug)->firstOrFail();
        $new_thuoc_tinh = collect($request->thuoc_tinh)->sort()->values()->all();
        $request->merge([
            'thuoc_tinh_check' => $new_thuoc_tinh
        ]);
        // dd($request->all());
        $request->validate([
            'thuoc_tinh' => 'required|array',
            'thuoc_tinh_check' => Rule::unique('san_pham_thuoc_tinhs', 'thuoc_tinh_id')
                ->where('san_pham_id', $sanPham->id),

        ], [
            'thuoc_tinh.required' => 'Vui lòng chọn thuộc tính.',
            'thuoc_tinh_check.unique' => 'Thuộc tính đã tồn tại cho sản phẩm.',
        ]);
        $bien_the =  $sanPham->bienThes()->exists();
        if ($bien_the) {
            foreach ($sanPham->bienThes()->get() as $bienThe) {
                if ($bienThe->trang_thai != 'ngung_ban') {
                    $bienThe->update([
                        'trang_thai' => 'cap_nhap'
                    ]);
                }
            }
        }
        foreach ($request->thuoc_tinh as $thuoc_tinh_id) {
            $sanPham->thuocTinhs()->attach($thuoc_tinh_id);
        }
        Swal::success([
            'title' => 'Thêm thành công!',
            'text' => 'Thuộc tính đã được thêm cho sản phẩm thành công.',
        ]);
        return redirect()->route('admin.san-pham.bien-the.danh-sach', ['slug' => $sanPham->slug])
            ->with('success', 'Thêm thuộc tính cho sản phẩm thành công! Vui lòng thêm biến thể cho sản phẩm.');
    }
    public function suaThuocTinhSanPham($slug, $id)
    {
        $san_pham = SanPham::where('slug', $slug)->first();
        $thuoc_tinhs = ThuocTinh::all();
        $thuoc_tinh_sp = $san_pham->thuocTinhs()->first();
        return view('admin.san_pham.sua_thuoc_tinh')->with([
            'thuoc_tinh_sp' => $thuoc_tinh_sp,
            'thuoc_tinhs' => $thuoc_tinhs,
            'san_pham' => $san_pham,
            'thuoc_tinh_id' => $id
        ]);
    }

    public function capNhapThuocTinhSanPham(Request $request, $slug)
    {
        $san_pham = SanPham::where('slug', $slug)->first();
        $extit = $san_pham->thuocTinhs()->where('thuoc_tinh_id', $request->thuoc_tinh)->exists();
        if ($extit) {
            return back()->withErrors([
                'loi_thuoc_tinh' => 'Thuộc tính đã tồn tại'
            ]);
        } else {
            $san_pham->thuocTinhs()->detach($request->thuoc_tinh_id);
            $san_pham->thuocTinhs()->attach($request->thuoc_tinh);
            foreach ($san_pham->bienThes as $bien_the) {
                if ($bien_the->trang_thai != 'ngung_ban') {
                    $bien_the->update([
                        'trang_thai' => 'cap_nhap'
                    ]);
                }
            }
            return redirect()->route('admin.san-pham.bien-the.danh-sach', $slug);
        }
    }





    public function xoaThuocTinhSanPham($slug, $id)
    {
        $san_pham = SanPham::where('slug', $slug)->firstOrFail();
        $thuoc_tinh =  ThuocTinh::where('id', $id)->first();
        $bien_thes =  $san_pham->bienThes()->where('san_pham_id', $san_pham->id)->get();
        foreach ($bien_thes as $bien_the) {
            $bien_the->update([
                'trang_thai' => 'cap_nhap'
            ]);
        }
        $san_pham->thuocTinhs()->detach($thuoc_tinh->id);
        Swal::success([
            'title' => 'Xóa thành công!',
            'text' => 'Thuộc tính sản phẩm đã được xóa thành công.',
        ]);
        return redirect()->route('admin.san-pham.bien-the.danh-sach', $san_pham->slug);
    }






    public function suaBienThe($slug) {}
}
