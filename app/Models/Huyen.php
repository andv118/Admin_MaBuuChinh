<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Huyen extends Model
{   
    protected $table='bc_huyen';
    protected $fillable=[
        'id',
        'id_tinh',
        'stt',
        'ten',
        'ten_eng',
        'mbc',
        'dienthoai',
        'diachi',
        'email',
        'website',
        'ghichu'
    ];
    public function Tinh(){
        return $this->belongsTo(\App\Models\Tinh::class,'id_tinh','id');
    }
    public function Dtgm(){
        return $this->hasMany(\App\Models\Dtgm::class,'stt_huyen', 'stt');
    }
}
