<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThuongHieu extends Model
{
    use SoftDeletes;
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
