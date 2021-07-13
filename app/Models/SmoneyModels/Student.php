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
    protected $collection='Sinhvien';
    public $timestamps = false;
    protected $fillable = ['masv','hoten','gioitinh','ngaysinh','diachi','sdt','email','diem','lophc','chuyennganh','loaict','stk'];
}
