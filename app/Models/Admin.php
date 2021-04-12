<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'tb_admin';
    protected $primaryKey = 'id_admin';
    protected $fillable = [
        'nama_admin',
        'nik_admin',
        'alamat_admin',
        'tgl_lahir_admin',
        'email_admin',
        'username_admin',
        'password_admin',
        'status_admin'
    ];
    public $timestamps = true;
}
