<?php

namespace App\Models\SmoneyModels;

use Illuminate\Database\Eloquent\Model;

class TaiKhoanNganHang extends Model
{
    protected $table = "tknganhang";
    protected $primaryKey = "tknn_id";
    public $timestamps = false;
}
