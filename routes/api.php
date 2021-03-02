<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::any('tambah', "App\Http\Controllers\ApiController@addData");
Route::any('tampil', "App\Http\Controllers\ApiController@getData");
Route::any('search', "App\Http\Controllers\ApiController@searchData");
Route::any('hapus', "App\Http\Controllers\ApiController@deleteData");
Route::any('edit', "App\Http\Controllers\ApiController@editData");
Route::any('register', "App\Http\Controllers\ApiController@register");
// Route::any('login', "App\Http\Controllers\ApiController@login");
//Route::any('add', "App\Http\Controllers\ApiControl@addProduk");
Route::any('get', "App\Http\Controllers\ApiControl@getProduk");
Route::any('cari', "App\Http\Controllers\ApiControl@searchProduk");
Route::any('delete', "App\Http\Controllers\ApiControl@deleteProduk");
Route::any('modif/{id}', "App\Http\Controllers\ApiControl@editProduk");
Route::any('upload', "App\Http\Controllers\ApiControl@upload");

Route::any('addSiswa', "App\Http\Controllers\ApiSiswa@addSiswa");
Route::any('getSiswa', "App\Http\Controllers\ApiSiswa@getSiswa");
Route::any('searchSiswa', "App\Http\Controllers\ApiSiswa@searchSiswa");
Route::any('deleteSiswa', "App\Http\Controllers\ApiSiswa@deleteSiswa");
Route::any('editSiswa/{id}', "App\Http\Controllers\ApiSiswa@editSiswa");

Route::any('tambahUser', "App\Http\Controllers\UserController@tambahUser");
Route::any('updateUser/{id}', "App\Http\Controllers\UserController@updateUser");
Route::any('getUser', "App\Http\Controllers\UserController@getUser");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $requany>user();
});
