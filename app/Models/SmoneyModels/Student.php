<?php

namespace App\Models\SmoneyModels;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
// use Illuminate\Contracts\Auth\Authenticatable;
// use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Student extends Eloquent
{
    protected $connection='mongodb';
    protected $collection='Sinhvien_2';
    public $timestamps = false;
    protected $fillable = ['masv','hoten','avatar','code','gioitinh','ngaysinh','diachi','sdt','otherSdt','email','diem','lophc','chuyennganh','loaict','stk','truong','cccd','keyforgot'];
}
