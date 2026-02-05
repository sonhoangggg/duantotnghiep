<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BienTheSanPham extends Model
{
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
    ];
}
