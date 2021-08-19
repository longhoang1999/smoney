<?php

namespace App\Models\SmoneyModels;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class HoSoKhoanVay extends Eloquent
{
    protected $connection='mongodb';
    protected $collection='Hosokhoanvay';
    public $timestamps = true;
}
