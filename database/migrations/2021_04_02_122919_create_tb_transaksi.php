<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->integer('id_nasabah_pengirim')->unsigned();
            $table->foreign('id_nasabah_pengirim')->references('id_nasabah')->on('tb_nasabah')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_nasabah_penerima');
            $table->datetime('tanggal_transaksi');
            $table->integer('jumlah_transaksi');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_transaksi');
    }
}
