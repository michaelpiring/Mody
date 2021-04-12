<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_admin', function (Blueprint $table) {
            $table->increments('id_admin');
            $table->string('nama_admin', 45);
            $table->string('nik_admin')->unique();
            $table->string('alamat_admin', 199);
            $table->date('tgl_lahir_admin');
            $table->string('email_admin')->unique();
            $table->string('username_admin')->unique();
            $table->string('password_admin');
            $table->enum('status_admin',['aktif','nonaktif']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_admin');
    }
}
