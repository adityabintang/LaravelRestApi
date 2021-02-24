<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nama_Barang extends Model
{
    protected $table = "Barang";
    protected $primaryKey = "id";
    protected $fillable = [
        'kode_barang',
        'nama_barang', 
        'stock', 
        'deskripsi',
        'image'
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
