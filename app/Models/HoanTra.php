<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoanTra extends Model
{
    protected $table = 'hoan_tras';
    protected $fillable = [
        'don_hang_id',
        'ly_do',
        'trang_thai',
        'tong_tien_hoan',
        'ghi_chu_admin',
        'ngay_yeu_cau',
        'ngay_xu_ly',
    ];
}
