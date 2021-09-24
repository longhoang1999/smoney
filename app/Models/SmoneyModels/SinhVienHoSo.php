<?php

namespace App\Models\SmoneyModels;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class SinhVienHoSo extends Eloquent
{
    protected $connection='mongodb';
    protected $collection='Sinhvien_in_hoso';
    public $timestamps = true;
}
