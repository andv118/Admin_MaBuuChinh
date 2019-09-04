<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dtgm extends Model
{
    protected $table="bc_chitiet";
    protected $fillable =[
        'id',
        'stt_huyen',
        'id_tinh',
        'ten',
        'ten_eng',
        'mbc',
        'dienthoai',
        'diachi',
        'email',
        'website',
        'ghichu'
    ];
    public function Huyen(){
        return $this->belongsTo(\App\Models\Huyen::class,'stt_huyen','stt');
    }

    public function Tinh(){
        return $this->belongsTo(\App\Models\Tinh::class,'id_tinh','id');
    }
}
