<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    protected $table = 'bai_viets';
    protected $fillable = [
        'tieu_de',
        'slug',
        'anh_dai_dien',
        'mo_ta_ngan',
        'noi_dung',
        'danh_muc_id',
        'nguoi_tao',
        'luot_xem',
        'trang_thai'
    ];
}
