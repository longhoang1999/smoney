<?php

namespace App\Models\SmoneyModels;

use Illuminate\Database\Eloquent\Model;

class TaiKhoanSmoney_Log extends Model
{
    protected $table = "tksmoney_log";
    protected $primaryKey = "log_id";
    public $timestamps = false;
}
