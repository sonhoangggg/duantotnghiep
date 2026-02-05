<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
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
}
