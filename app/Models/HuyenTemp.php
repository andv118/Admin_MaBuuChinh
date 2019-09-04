<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HuyenTemp extends Model
{
    protected $table="bc_huyen_temp";
    protected $fillable =[
        'id',
        'id_tinh',
        'stt',
        'ten',
        'mbc',
        'dienthoai',
        'diachi',
        'email',
        'website',
        'ghichu',
    ];
}
