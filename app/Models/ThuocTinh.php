<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThuocTinh extends Model
{
    protected $table = 'thuoc_tinhs';
    protected $fillable = [
        'ten',
        'kieu',
    ];
}
