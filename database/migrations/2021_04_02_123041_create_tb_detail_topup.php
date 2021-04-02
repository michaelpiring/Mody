<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDetailTopup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detail_topup', function (Blueprint $table) {
            $table->increments('id_detail_topup');
            $table->integer('id_nasabah');
            $table->integer('id_lpd');
            $table->integer('jumlah_topup');
            $table->datetime('tanggal_topup');
            $table->enum('status', ['berhasil','gagal']);
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
        Schema::dropIfExists('tb_detail_topup');
    }
}
