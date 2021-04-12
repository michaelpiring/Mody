<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDetailTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detail_transaksi', function (Blueprint $table) {
            $table->increments('id_detail_transaksi');
            $table->integer('id_transaksi')->unsigned();
            $table->foreign('id_transaksi')->references('id_transaksi')->on('tb_transaksi')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_nasabah_pengirim')->unsigned();
            $table->foreign('id_nasabah_pengirim')->references('id_nasabah')->on('tb_nasabah')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_nasabah_penerima');
            $table->string('keterangan', 199);
            $table->integer('jumlah_transaksi');
            $table->datetime('tanggal_transaksi');
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
        Schema::dropIfExists('tb_detail_transaksi');
    }
}
