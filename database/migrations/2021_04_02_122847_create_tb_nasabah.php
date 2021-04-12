<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbNasabah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_nasabah', function (Blueprint $table) {
            $table->increments('id_nasabah');
            $table->integer('id_dompet')->unsigned();
            $table->foreign('id_dompet')->references('id_dompet')->on('tb_dompet')->onDelete('restrict')->onUpdate('cascade');
            $table->string('nama_nasabah', 45);
            $table->string('nik_nasabah')->unique();
            $table->string('alamat_nasabah', 199);
            $table->date('tgl_lahir_nasabah');
            $table->string('email_nasabah')->unique();
            $table->string('no_telepon_nasabah')->unique();
            $table->string('username_nasabah')->unique();
            $table->string('password_nasabah');
            $table->enum('status_nasabah', ['aktif','nonaktif']);
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
        Schema::dropIfExists('tb_nasabah');
    }
}
