<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnhHoanTra extends Model
{
    protected $table = 'hoan_tra_chi_tiets';
    protected $fillable = [
        'hoan_tra_id',
        'chi_tiet_don_hang_id',
        'so_luong_hoan',
        'gia',
        'thanh_tien',

    ];
}
