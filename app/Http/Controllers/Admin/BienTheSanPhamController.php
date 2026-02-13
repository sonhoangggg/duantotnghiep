<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BienTheSanPham;
use Illuminate\Http\Request;
use App\Models\ThongSo;
use App\Models\GiaTriThuocTinh;
use App\Models\SanPham;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use SweetAlert2\Laravel\Swal;

class BienTheSanPhamController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }


    public function suaBienThe(string $id)
    {
        $bien_the = BienTheSanPham::findOrFail($id);
        $thong_sos = ThongSo::all();

        return view('admin.bien_the_sp.edit')->with([
            'bien_the' => $bien_the,
            'thong_sos' => $thong_sos,
        ]);
    }


    public function capNhapBienThe(Request $request, string $id)
    {
        $new_gia_tri = $request->gia_tri;
        $new_gia_tri = collect($new_gia_tri)->sort()->values()->all();
        $new_gia_tri = implode('-', $new_gia_tri);
        $request->merge([
            'to_hop_gia_tri' => $new_gia_tri
        ]);
        $bien_the = BienTheSanPham::findOrFail($id);
        $request->validate([
            'gia_tri' => 'required|array',
            'gia_tri.*' => 'required|integer|exists:gia_tri_thuoc_tinhs,id',
            'gia_tt' => 'required|numeric',
            'gia_km' => 'required|numeric|lt:gia_tt',
            'so_luong' => 'required|numeric',
            'to_hop_gia_tri' => [
                    Rule::unique('bien_the_san_phams', 'to_hop_gia_tri')
                        ->where('san_pham_id', $bien_the->san_pham_id)->ignore($bien_the->id),
                ],
        ],
            [
                'gia_tri.*.required' => 'Vui lòng chọn giá trị cho thuộc tính.',
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
                'to_hop_gia_tri.unique' => 'Biến thể với tổ hợp thuộc tính này đã tồn tại.',
            ]);
        // dd($request->all());

        if ($request->hasFile('anh_bien_the')) {
            // Xóa ảnh cũ nếu có
            if ($bien_the->anh_bien_the) {
                Storage::delete($bien_the->anh_bien_the);
            }
            // Lưu ảnh mới
            $anh_bien_the = $request->file('anh_bien_the');
            $ten_anh = time() . '.' . $anh_bien_the->getClientOriginalExtension();
            $duong_dan = $anh_bien_the->storeAs('image', $ten_anh, 'public');
        }
        if ($request->filled('thong_so')) {

            $data = collect($request->thong_so)
                ->filter(fn($v) => filled($v))
                ->mapWithKeys(fn($v, $thong_so_id) => [
                    $thong_so_id => ['gia_tri' => $v]
                ])
                ->toArray();

            if (!empty($data)) {
                $bien_the->thongSoBienThe()->syncWithoutDetaching($data);
            }
        }
        $bien_the->bienTheThuocTinhs()->sync($request->gia_tri);
        $bien_the->update([
            'to_hop_gia_tri' => $new_gia_tri,
            'sku' => $request->sku_bien_the,
            'anh_bien_the' => $duong_dan ?? null,
            'gia_goc' => $request->gia_tt,
            'gia_ban' => $request->gia_km,
            'so_luong' => $request->so_luong,
            'trang_thai' => $request->trang_thai == 0 ? 'an' : 'hien',
            'anh_bien_the' => $request->file('anh_bien_the') ?? $bien_the->anh_bien_the
        ]);
        return redirect()->route('admin.san-pham.bien-the.danh-sach', $bien_the->sanPham->slug)
            ->with('success', 'Cập nhật biến thể sản phẩm thành công!');
    }

    public function dsBienThe($slug)
    {
        $sanPham = SanPham::where('slug', $slug)->firstOrFail();
        $bienThes = $sanPham->bienThes()->get();
        $bienThes->load([
            'bienTheThuocTinhs.thuocTinh'
        ]);
        $thuoc_tinhs = $sanPham->thuocTinhs()->pluck('ten', 'id');
        return view('admin.bien_the_sp.index')->with([
            'sanPham' => $sanPham,
            'bienThes' => $bienThes,
            'thuoc_tinhs' => $thuoc_tinhs
        ]);
    }
    public function themBienThe($slug)
    {

        $thongSos = ThongSo::all();
        $sanPham = SanPham::with('thuocTinhs')->where('slug', $slug)->first();

        $thuoc_tinhs = $sanPham->thuocTinhs->pluck('id', 'ten');
        $gia_tri_thuoc_tinhs = GiaTriThuocTinh::whereIn('thuoc_tinh_id', $thuoc_tinhs)->get()->groupBy('thuoc_tinh_id');

        $gia_tri_thuoc_tinh = $gia_tri_thuoc_tinhs->map(function ($value) {
            return $value->pluck('ten_hien_thi', 'id');
        });

        // dd($gia_tri_thuoc_tinh);
        return view('admin.bien_the_sp.create')->with([
            'sanPham' => $sanPham,
            'thongSos' => $thongSos,
            'thuoc_tinhs' => $thuoc_tinhs,
            'gia_tri_thuoc_tinh' => $gia_tri_thuoc_tinh
        ]);
    }
    public function luuBienThe(Request $request, $slug)
    {
        // dd($request->all());
        $new_gia_tri = $request->gia_tri_thuoc_tinh;
        $new_gia_tri = collect($new_gia_tri)->sort()->values()->all();
        $new_gia_tri = implode('-', $new_gia_tri);
        $request->merge([
            'to_hop_gia_tri' => $new_gia_tri
        ]);
        $sanPham = SanPham::where('slug', $slug)->firstOrFail();
        $request->validate(
            [
                'sku_bien_the' => 'required|string|max:100|unique:bien_the_san_phams,sku',
                'gia_tt' => 'required|numeric',
                'gia_km' => 'required|numeric|lt:gia_tt',
                'so_luong' => 'required|numeric',
                'anh_bien_the' => 'required|image',
                'gia_tri_thuoc_tinh.*' => 'required|',
                'to_hop_gia_tri' => [
                    Rule::unique('bien_the_san_phams', 'to_hop_gia_tri')
                        ->where('san_pham_id', $sanPham->id),
                ],

            ],
            [
                'gia_tri_thuoc_tinh.*.required' => 'Vui lòng chọn giá trị cho thuộc tính.',
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
                'to_hop_gia_tri.unique' => 'Biến thể với tổ hợp thuộc tính này đã tồn tại.',
            ]
        );


        if ($request->hasFile('anh_bien_the')) {
            $anh_bien_the = $request->file('anh_bien_the');
            $ten_anh = time() . '.' . $anh_bien_the->getClientOriginalExtension();
            $duong_dan = $anh_bien_the->storeAs('image', $ten_anh, 'public');
        }
        $bienThe = BienTheSanPham::create([
            'san_pham_id' => $sanPham->id,
            'to_hop_gia_tri' => $new_gia_tri,
            'sku' => Str::slug($request->sku_bien_the, '-'),
            'anh_bien_the' =>  $duong_dan,
            'gia_goc' => $request->gia_tt,
            'gia_ban' => $request->gia_km,
            'so_luong' => $request->so_luong,
            'trang_thai' => isset($request->trang_thai) ? 'hien' : 'an',
        ]);
        foreach ($request->gia_tri_thuoc_tinh as  $gia_tri_id) {
            $bienThe->bienTheThuocTinhs()->attach($gia_tri_id);
        }
        if (isset($request->gia_tri_thong_so)) {
            foreach ($request->gia_tri_thong_so as $thong_so_id => $gia_tri) {
                if ($gia_tri !== null) {
                    $bienThe->thongSoBienThe()->attach([
                        $thong_so_id => ['gia_tri' => $gia_tri]
                    ]);
                }
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
        Swal::success([
            'title' => 'Thêm thành công!',
            'text' => 'Biến thể sản phẩm đã được thêm thành công.',
        ]);
        return redirect()->route('admin.san-pham.bien-the.danh-sach', ['slug' => $sanPham->slug]);
    }
    public function xoaBienThe(string $id)
    {
        $bien_the = BienTheSanPham::findOrFail($id);
        $bien_the->delete();
        Swal::success([
            'title' => 'Xóa thành công!',
            'text' => 'Biến thể sản phẩm đã được xóa.'
        ]);
        return back();
    }
}
