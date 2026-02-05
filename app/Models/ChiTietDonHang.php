<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    protected $table = 'chi_tiet_don_hangs';
    protected $fillable = [
        'don_hang_id',
        'san_pham_id',
        'bien_the_id',
        'ten_san_pham',
        'sku',
        'gia',
        'so_luong',
        'bien_the_snap',
    ];
}
