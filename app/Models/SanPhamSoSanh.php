<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPhamSoSanh extends Model
{
    protected $table = 'san_pham_so_sanhs';
    protected $fillable = [
        'san_pham_id',
        'bien_the_id',
        'nguoi_dung_id',
        'session_id',
    ];
}
