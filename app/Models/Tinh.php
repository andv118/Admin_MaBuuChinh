<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tinh extends Model
{
    protected $table ='bc_tinh';
    protected $fillable=[
        'id',
        'ten',
        'ten_eng',
        'mbc',
        'dienthoai',
        'diachi',
        'email',
        'website',
        'ghichu',
    ];

    public function Huyen(){
        return $this->hasMany(\App\Models\Huyen::class,'id_tinh');
    }
    public function Dtgm(){
        return $this->hasMany(\App\Models\Dtgm::class,'id_tinh');
    }
}
