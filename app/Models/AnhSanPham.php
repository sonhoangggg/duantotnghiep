<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnhSanPham extends Model
{
    protected $table = 'anh_san_phams';
    protected $fillable = [
        'san_pham_id',	'duong_dan',
    ];
}
