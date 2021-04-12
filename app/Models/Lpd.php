<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lpd extends Model
{
    use HasFactory;
    protected $table = 'tb_lpd';
    protected $primaryKey = 'id_lpd';
    protected $fillable = [
        'nama_lpd',
        'alamat_lpd',
        'no_telepon_lpd'
    ];
    public $timestamps = true;
}
