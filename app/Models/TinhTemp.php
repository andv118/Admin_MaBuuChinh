<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TinhTemp extends Model
{
    protected $table="bc_tinh_temp";
    protected $fillable =[
        'id',
        'ten',
        'mbc',
        'dienthoai',
        'diachi',
        'email',
        'website',
        'ghichu',
    ];
}
