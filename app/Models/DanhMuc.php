<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    protected $table = 'danh_mucs';
    protected $fillable = [
        'ten',
        'slug',
        'logo',
        'mo_ta',
        'parent_id',
    ];

    public function sanPhams(){
        return $this->belongsToMany(SanPham::class,'san_pham_danh_mucs');
    }

}
