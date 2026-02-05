<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThongSo extends Model
{
    protected $table = 'thong_sos';
    protected $fillable = [
        'ten',
        'don_vi'
    ];
}
