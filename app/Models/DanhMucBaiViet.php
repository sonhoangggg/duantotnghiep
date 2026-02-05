<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhMucBaiViet extends Model
{
    protected $table = 'danh_muc_bai_viets';
    protected $fillable = [
        'ten',
        'slug',
        'mo_ta',
    ];
}
