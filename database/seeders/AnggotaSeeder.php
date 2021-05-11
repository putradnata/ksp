<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('anggota')->insert([
            'id'=> 'A001',
            'nama' => 'Wayan Kusuma Putra',
            'alamat' => 'Jl. Raya Guwang No. 55, Sukawati',
            'tempatLahir' => 'Gianyar',
            'tanggalLahir' => '1964-01-01',
            'jenisKelamin' => 'P',
            'pekerjaan' => 'Admin',
            'umur' => '57',
            'idAdmin' => '1',
            'created_at' => '2021-02-28',
            'updated_at' => '2021-02-28'
        ]);

        DB::table('anggota')->insert([
            'id'=> 'A002',
            'nama' => 'Ni Putu Kania Riyanti',
            'alamat' => 'Jl. Pantai Purnama, Banjar Palak, Sukawati',
            'tempatLahir' => 'Gianyar',
            'tanggalLahir' => '1980-11-23',
            'jenisKelamin' => 'P',
            'pekerjaan' => 'Kasir',
            'umur' => '40',
            'idAdmin' => '1',
            'created_at' => '2021-02-28',
            'updated_at' => '2021-02-28'
        ]);

        DB::table('anggota')->insert([
            'id'=> 'A003',
            'nama' => 'I Made Subagia',
            'alamat' => 'Jl. Margapati No.15, Sukawati',
            'tempatLahir' => 'Gianyar',
            'tanggalLahir' => '1970-03-19',
            'jenisKelamin' => 'L',
            'pekerjaan' => 'HRD',
            'umur' => '51',
            'idAdmin' => '1',
            'created_at' => '2021-03-02',
            'updated_at' => '2021-03-02'
        ]);

        DB::table('anggota')->insert([
            'id'=> 'A004',
            'nama' => 'Ni Nyoman Yessi Prastuti',
            'alamat' => 'Jl. Padma No.3, Sukawati',
            'tempatLahir' => 'Tangerang',
            'tanggalLahir' => '1987-04-05',
            'jenisKelamin' => 'P',
            'pekerjaan' => 'Pramuniaga',
            'umur' => '34',
            'idAdmin' => '1',
            'created_at' => '2021-03-05',
            'updated_at' => '2021-03-05'
        ]);

        DB::table('anggota')->insert([
            'id'=> 'A005',
            'nama' => 'I Gede Gandi Saputra',
            'alamat' => 'Jl. Sersan Wayan Pugig No.10, Sukawati',
            'tempatLahir' => 'Padang',
            'tanggalLahir' => '1990-07-12',
            'jenisKelamin' => 'L',
            'pekerjaan' => 'IT Support',
            'umur' => '31',
            'idAdmin' => '1',
            'created_at' => '2021-03-08',
            'updated_at' => '2021-03-08'
        ]);
    }
}
