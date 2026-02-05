<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiaTriThuocTinh extends Model
{
    protected $table = 'gia_tri_thuoc_tinhs';
    protected $fillable = [
        'ten_hien_thi',
        'gia_tri'
    ];
}
