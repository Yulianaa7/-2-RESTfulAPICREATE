<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    public $timestamps = false;
    
    protected $fillable = ['nama', 'alamat', 'telp', 'username', 'password'];
}