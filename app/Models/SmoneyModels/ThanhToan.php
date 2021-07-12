<?php

namespace App\Models\SmoneyModels;

use Illuminate\Database\Eloquent\Model;

class ThanhToan extends Model
{
    protected $table = "thanhtoan";
    protected $primaryKey = "tt_id";
    public $timestamps = false;
}
