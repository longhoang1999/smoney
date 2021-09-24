<?php

namespace App\Models\SmoneyModels;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = "admin";
    protected $primaryKey = "ad_id";
    public $timestamps = false;
}
