<?php

namespace App\Http\Controllers;

use App\Pegawai;
use App\Barang;
use App\Keranjang;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    
    public function getPegawai(Request $req) {
        $pegawai = Pegawai::all();

        if ($pegawai->isNotEmpty()) {
            $res['is_success'] = true;
            $res['message'] = 'Sukses mendapatkan data pegawai';
            $res['data'] = $pegawai;
        } else {
            $res['is_success'] = false;
            $res['message'] = 'Tidak ada data pegawai';
            $res['data'] = null;
        }

        return response()->json($res);
    }

    public function searchPegawai(Request $req) {
        $q = $req->keyword;

        $pegawai = Pegawai::where('nama', 'LIKE', '%'.$q.'%')
                            ->orWhere('posisi', 'LIKE', '%'.$q.'%')
                            ->get();

        if ($pegawai->isNotEmpty()) {
            $res['is_success'] = true;
            $res['message'] = 'Sukses mendapatkan data pegawai';
            $res['data'] = $pegawai;
        } else {
            $res['is_success'] = false;
            $res['message'] = 'Tidak ada data pegawai';
            $res['data'] = null;
        }

        return response()->json($res);
    }

    public function addPegawai(Request $req) {

        $namaPegawai = $req->nama;
        $posisiPegawai = $req->posisi;
        $gajiPegawai = $req->gaji;

        $pegawai = new Pegawai();
        $pegawai->nama = $namaPegawai;
        $pegawai->posisi = $posisiPegawai;
        $pegawai->gaji = $gajiPegawai;

        $saved = $pegawai->save();

        if ($saved) {
            $res['is_success'] = true;
            $res['message'] = 'Sukses menambah data pegawai';
            $res['data'] = $pegawai;
        } else {
            $res['is_success'] = false;
            $res['message'] = 'Gagal menambah data pegawai';
            $res['data'] = null;
        }

        return response()->json($res);
    }

    public function editPegawai(Request $req) {

        $idPegawai = $req->id;
        $namaPegawai = $req->nama;
        $posisiPegawai = $req->posisi;
        $gajiPegawai = $req->gaji;

        $pegawai = Pegawai::find($idPegawai);

        if ($pegawai != null) {
            $pegawai->nama = $namaPegawai;
            $pegawai->posisi = $posisiPegawai;
            $pegawai->gaji = $gajiPegawai;
    
            $updated = $pegawai->update();

            if ($updated) {
                $res['is_success'] = true;
                $res['message'] = 'Sukses edit data pegawai';
                $res['data'] = $pegawai;
            } else {
                $res['is_success'] = false;
                $res['message'] = 'Gagal edit data pegawai';
                $res['data'] = null;
            }
        } else {
            $res['is_success'] = false;
            $res['message'] = 'id pegawai tidak ditemukan';
            $res['data'] = null;
        }

    
        return response()->json($res);
    }

    public function deletePegawai(Request $req) {
        $idPegawai = $req->id;

        $pegawai = Pegawai::find($idPegawai);

        if ($pegawai != null) {
            $deleted = $pegawai->delete();

            if ($deleted) {
                $res['is_success'] = true;
                $res['message'] = 'Berhasil hapus pegawai';
                $res['data'] = null;
            } else {
                $res['is_success'] = false;
                $res['message'] = 'Gagal hapus pegawai';
                $res['data'] = null;
            }
        } else {
            $res['is_success'] = false;
            $res['message'] = 'id pegawai tidak ditemukan';
            $res['data'] = null;
        }

        return response()->json($res);
    }

    public function getBarang(Request $req) {
        $barang = Barang::all();

        if ($barang->isNotEmpty()) {
            $res['is_success'] = true;
            $res['message'] = 'Sukses mendapatkan data barang';
            $res['data'] = $barang;
        } else {
            $res['is_success'] = false;
            $res['message'] = 'Tidak ada data barang';
            $res['data'] = null;
        }

        return response()->json($res);
    }

    public function addKeranjang(Request $req) {

        $idPegawai = $req->id_pegawai;
        $idBarang = $req->id_barang;
        $qty = $req->qty;

        $keranjang = new Keranjang();
        $keranjang->id_pegawai = $idPegawai;
        $keranjang->id_barang = $idBarang;
        $keranjang->qty = $qty;

        $saved = $keranjang->save();

        if ($saved) {
            $res['is_success'] = true;
            $res['message'] = 'Sukses menambah data keranjang';
            $res['data'] = $keranjang;
        } else {
            $res['is_success'] = false;
            $res['message'] = 'Gagal menambah data keranjang';
            $res['data'] = null;
        }

        return response()->json($res);
    }

    public function getKeranjangById(Request $req) {
        $idPegawai = $req->id_pegawai;

        $keranjang = Keranjang::where('id_pegawai', '=', $idPegawai)
            ->with(['barang' => function($barang) {
                $barang->with('topping');
            }, 'pegawai'])
            ->get();

        if ($keranjang->isNotEmpty()) {
            $res['is_success'] = true;
            $res['message'] = 'Sukses mendapatkan data keranjang';
            $res['data'] = $keranjang;
        } else {
            $res['is_success'] = false;
            $res['message'] = 'Tidak ada data keranjang';
            $res['data'] = null;
        }

        return response()->json($res);
    }

    public function uploadPhotoPegawai(Request $req) {
        $image = $req->file('photo');
        $idPegawai = $req->id_pegawai;

        $pegawai = Pegawai::find($idPegawai);
        if ($pegawai == null) {
            $res['is_success'] = false;
            $res['message'] = 'Gagal pegawai tidak ada';
            $res['data'] = null;
            return response()->json($res);
        }

        $date = Date('Y-m-d-His');
        $randomString = Str::random(10);
        $extension = $image->extension();

        $imageName =  $pegawai->nama . '-' . $date . '-' . $randomString . '.' . $extension;
        $destinationPath = 'images/photo';
        $isUploaded = $image->move($destinationPath, $imageName);
        if ($isUploaded) {
            $pegawai->photo = $imageName;
            $updated = $pegawai->update();

            if ($updated) {
                $res['is_success'] = true;
                $res['message'] = 'Berhasil upload gambar pegawai';
                $res['data'] = $pegawai;
            } else {
                $res['is_success'] = false;
                $res['message'] = 'Gagal update pegawai';
                $res['data'] = null;
            }
        } else {
            $res['is_success'] = false;
            $res['message'] = 'Gagal upload gambar';
            $res['data'] = null;
        }

        return response()->json($res);
    }    
}
