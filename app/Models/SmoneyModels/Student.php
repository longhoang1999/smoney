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
    // public $primaryKey='id_post';
    // protected $fillable = [
    // 	'_id','user_id','name','phone','password','studentcode','dateofbirth','sex','address','image','university','specialized','points','healthcertification','dateModified','code'
    // ];
    protected $fillable = ['masv','hoten','gioitinh','ngaysinh','diachi','sdt','email','diem','lophc','chuyennganh','loaict','stk'];
}
