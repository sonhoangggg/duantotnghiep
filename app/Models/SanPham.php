<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SanPham extends Model
{
    use SoftDeletes;
    protected $table = 'san_phams';
    protected $fillable = [
        'ten',
        'slug',
        'sku',
        'gia_goc',
        'gia_ban',
        'so_luong',
        'mo_ta_ngan',
        'mo_ta_chi_tiet',
        'anh_chinh',
        'trang_thai',
        'loai',
        'noi_bat',
        'thuong_hieu_id',
        'luot_xem',
        'da_ban',
        'nguoi_tao'
    ];
    public function danhMucs(){
        return $this->belongsToMany(DanhMuc::class,'san_pham_danh_mucs','san_pham_id', 'danh_muc_id');
    }
    public function thuongHieu(){
        return $this->belongsTo(ThuongHieu::class,'thuong_hieu_id');
    }
    public function anhSanPhams(){
        return $this->hasMany(AnhSanPham::class,'san_pham_id');
    }

    public function bienThes(){
        return $this->hasMany(BienTheSanPham::class,'san_pham_id');
    }
    public function thongSos(){
        return $this->belongsToMany(ThongSo::class,'san_pham_thong_sos','san_pham_id','thong_so_id')->withPivot('gia_tri');
    }

    public function thuocTinhs(){
        return $this->belongsToMany(ThuocTinh::class,'san_pham_thuoc_tinhs','san_pham_id','thuoc_tinh_id');
    }
}
