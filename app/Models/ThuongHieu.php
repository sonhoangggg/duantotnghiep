<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThuongHieu extends Model
{
    protected $table = 'thuong_hieus';
    protected $fillable = [
        'ten',
        'slug',
        'logo',
        'mo_ta',
    ];
    public function sanPhams(){
        return $this->hasMany(SanPham::class,'thuong_hieu_id');
    }
}
