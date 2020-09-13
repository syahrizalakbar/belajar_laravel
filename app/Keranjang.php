<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'tb_keranjang';

    protected $fillable = [
        'id_pegawai',
        'id_barang',
        'qty',
    ];

    public function pegawai() {
        return $this->hasOne('App\Pegawai', 'id', 'id_pegawai');
    }
    public function barang() {
        return $this->hasOne('App\Barang', 'id', 'id_barang');
    }
}
