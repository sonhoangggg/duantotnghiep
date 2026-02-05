<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaGiamGia extends Model
{
    protected $table = 'ma_giam_gias';

    protected $fillable = [
        'ma',
        'mo_ta',
        'loai',
        'gia_tri',
        'gia_tri_toi_da',
        'don_toi_thieu',
        'so_luong',
        'da_su_dung',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'trang_thai',

    ];
}
