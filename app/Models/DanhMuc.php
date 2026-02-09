<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DanhMuc extends Model
{
     use SoftDeletes; 
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
public function parent()
{
    return $this->belongsTo(DanhMuc::class, 'parent_id');
}

}
