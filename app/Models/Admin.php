<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = "admin";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama',
        'alamat', 
        'jenis_kelamin', 
        'hobi',
        'agama'
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
