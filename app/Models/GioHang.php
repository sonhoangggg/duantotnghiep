<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GioHang extends Model
{
     protected $table='gio_hangs';
     protected $fillable = ['nguoi_dung_id'];
}
