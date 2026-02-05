<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BienTheThongSo extends Model
{
    protected $table = 'bien_the_thong_sos';
    protected $fillable = [
        'bien_the_id',
        'thong_so_id',
        'gia_tri',
    ];
}
