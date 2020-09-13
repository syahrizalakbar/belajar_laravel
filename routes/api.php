<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get-pegawai', 'ApiController@getPegawai');
Route::post('add-pegawai', 'ApiController@addPegawai');
Route::post('edit-pegawai', 'ApiController@editPegawai');
Route::post('delete-pegawai', 'ApiController@deletePegawai');
Route::post('search-pegawai', 'ApiController@searchPegawai');
Route::get('get-barang', 'ApiController@getBarang');
Route::post('add-keranjang', 'ApiController@addKeranjang');
Route::post('get-keranjang', 'ApiController@getKeranjangById');
Route::post('upload-photo-pegawai', 'ApiController@uploadPhotoPegawai');