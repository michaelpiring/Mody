<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dompet extends Model
{
    use HasFactory;
    protected $table = 'tb_dompet';
    protected $primaryKey = 'id_dompet';
    protected $fillable = [
        'saldo_dompet'
    ];
    public $timestamps = true;
}
