<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThuocTinh extends Model
{
    use SoftDeletes;
    protected $table = 'thuoc_tinhs';
    protected $fillable = [
        'ten',
        'kieu',
    ];
    public function giaTri(){
        return $this->hasMany(GiaTriThuocTinh::class,'thuoc_tinh_id');
    }
}
