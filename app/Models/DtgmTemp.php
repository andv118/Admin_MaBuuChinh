<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DtgmTemp extends Model
{
    protected $table="bc_chitiet_temp";
    protected $fillable =[
        'id',
        'stt_huyen',
        'id_tinh',
        'ten',
        'mbc',
        'dienthoai',
        'diachi',
        'email',
        'website',
        'ghichu',
    ];
}
