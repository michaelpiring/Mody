<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;
    protected $table = 'tb_nasabah';
    protected $primaryKey = 'id_nasabah';
    protected $fillable = [
        'id_dompet',
        'nama_nasabah',
        'nik_nasabah',
        'tgl_lahir_nasabah',
        'alamat_nasabah',
        'no_telepon_nasabah',
        'email_nasabah',
        'username_nasabah',
        'password_nasabah',
        'status_nasabah'
    ];
    public $timestamps = true;
}
