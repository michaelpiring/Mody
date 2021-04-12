<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'tb_transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id_nasabah_pengirim',
        'id_nasabah_penerima',
        'tanggal_transaksi',
        'jumlah_transaksi'
    ];
    public $timestamps = true;
}
