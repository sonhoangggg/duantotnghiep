<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPhamThongSo extends Model
{
    protected $table = 'san_pham_thong_sos';
    protected $fillable = [
        'san_pham_id',
        'thong_so_id',
        'gia_tri',
    ];
}
