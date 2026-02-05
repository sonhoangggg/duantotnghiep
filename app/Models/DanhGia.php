<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    protected $table = 'danh_gias';
    protected $fillable = [
        'chi_tiet_don_hang_id',
        'nguoi_dung_id',
        'diem_so',
        'noi_dung',
        'trang_thai',

    ];
}
