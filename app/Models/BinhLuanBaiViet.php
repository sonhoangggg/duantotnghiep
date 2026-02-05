<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BinhLuanBaiViet extends Model
{
    protected $table = 'binh_luan_bai_viets';
    protected $fillable = [
        'bai_viet_id',
        'nguoi_dung_id',
        'ten_khach',
        'email_khach',
        'noi_dung',
        'parent_id',
    ];
}
