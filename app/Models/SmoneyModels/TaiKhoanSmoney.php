<?php

namespace App\Models\SmoneyModels;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TaiKhoanSmoney extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;
    protected $table = 'tksmoney';
    protected $fillable = array('tks_sdt','ths_mk','tks_loaitk','tks_id','tks_sotk','tks_tentk','tks_key_device');
    public $timestamps = false;
    public static $rules = array();
    protected $primaryKey = 'tks_id';

    public function getAuthPassword()
    {
        return $this->ths_mk;
    }

}
