<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_admin')->insert([
    		'nama_admin' =>'admin',
            'nik_admin' => '1234567890',
            'alamat_admin' => 'jl. admin testing nomor 69',
            'tgl_lahir_admin' => '1999-01-01',
            'email_admin' => 'admin@gmail.com',
            'username_admin' => 'admin',
            'password_admin' => bcrypt('admin')
        ]);
    }
}
