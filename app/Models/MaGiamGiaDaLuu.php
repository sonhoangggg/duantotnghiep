<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaGiamGiaDaLuu extends Model
{
    protected $table = 'ma_giam_gia_da_luus';
    protected $fillable = [
        'ma_giam_gia_id',
        'nguoi_dung_id',
        'luu_luc',
    ];
}
