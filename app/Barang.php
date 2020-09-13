<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'tb_barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'harga_barang',
    ];

    public function topping() {
        return $this->hasMany('App\Topping', 'id_barang', 'id');
    }
}
