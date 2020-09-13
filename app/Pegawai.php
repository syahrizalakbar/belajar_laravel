<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'tb_pegawai';

    protected $fillable = [
        'nama',
        'posisi',
        'gaji',
        'photo',
    ];


}
