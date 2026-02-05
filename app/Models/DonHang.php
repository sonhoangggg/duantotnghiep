<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    protected $table = 'don_hangs';
    protected $fillable = [
    'ma_don_hang',
    'nguoi_dung_id',
    'ho_ten',
    'email',
    'so_dien_thoai',
    'dia_chi',
    'phuong_xa',
    'quan_huyen',
    'tinh_thanh',
    'tong_tien',
    'phi_van_chuyen',
    'giam_gia',
    'tong_thanh_toan',
    'trang_thai',
    'phuong_thuc_thanh_toan',
    'trang_thai_thanh_toan',
    'ghi_chu',
    'ma_giam_gia_id',
];
}
