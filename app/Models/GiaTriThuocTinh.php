<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiaTriThuocTinh extends Model
{
    protected $table = 'gia_tri_thuoc_tinhs';
    protected $fillable = [
        'thuoc_tinh_id',
        'ten_hien_thi',
        'gia_tri'
    ];
    public function thuocTinh(){
        return $this->belongsTo(ThuocTinh::class,'thuoc_tinh_id');
    }
}
