<?php

namespace App\Models\SmoneyModels;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = "notification";
    protected $primaryKey = "no_id";
    public $timestamps = false;
}
