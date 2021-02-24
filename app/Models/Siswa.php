<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = "siswa";
    protected $primaryKey = "id";
    protected $fillable = [
        'NIK', 
        'Nama', 
        'Alamat', 
        'No_hp'
    ];

    protected $hidden = ['created_at', 'updated_at'];


}
