<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BienTheSanPham extends Model
{
    use SoftDeletes;
    protected $table = 'bien_the_san_phams';
    protected $fillable = [
        'san_pham_id',
        'sku',
        'anh_bien_the',
        'gia_goc',
        'gia_ban',
        'so_luong',
        'trang_thai',
        'da_ban',
        'to_hop_gia_tri',
    ];
    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }
    public function bienTheThuocTinhs()
    {
        return $this->belongsToMany(GiaTriThuocTinh::class, 'bien_the_thuoc_tinhs', 'bien_the_id', 'gia_tri_id');
    }
    public function thongSoBienThe()
    {
        return $this->belongsToMany(BienTheThongSo::class, 'bien_the_thong_sos', 'bien_the_id', 'thong_so_id');
    }
    public function thongSos()
    {
        return $this->belongsToMany(ThongSo::class, 'bien_the_thong_sos', 'bien_the_id', 'thong_so_id')->withPivot('gia_tri');
    }

}
