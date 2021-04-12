<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;
    protected $table = 'tb_detail_transaksi';
    protected $primaryKey = 'id_detail_transaksi';
    protected $fillable = [
        'id_transaksi',
        'id_nasabah_pengirim',
        'id_nasabah_penerima',
        'keterangan',
        'jumlah_transaksi',
        'tanggal_transaksi'
    ];
    public $timestamps = true;
}
