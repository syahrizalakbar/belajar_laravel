<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    protected $table = 'tb_topping';

    protected $fillable = [
        'id_barang',
        'nama_topping',
        'harga_topping',
    ];
}
