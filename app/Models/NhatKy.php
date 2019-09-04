<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NhatKy extends Model
{
    protected $table="nhatky";
    protected $fillable =[
        'id',
        'name',
        'email',
        'action',
        'time'
    ];
    
}