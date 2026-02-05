<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietGioHang extends Model
{
    protected $table = 'chi_tiet_gio_hangs';
    protected $fillable = [
        'gio_hang_id',
        'san_pham_id',
        'bien_the_id',
        'so_luong',
    ];
}
