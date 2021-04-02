<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTopup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_topup', function (Blueprint $table) {
            $table->increments('id_topup');
            $table->integer('id_nasabah')->unsigned();
            $table->foreign('id_nasabah')->references('id_nasabah')->on('tb_nasabah')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_lpd')->unsigned();
            $table->foreign('id_lpd')->references('id_lpd')->on('tb_lpd')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('id_detail_topup')->unsigned();
            $table->foreign('id_detail_topup')->references('id_detail_topup')->on('tb_detail_topup')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('jumlah_topup');
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
        Schema::dropIfExists('tb_topup');
    }
}
