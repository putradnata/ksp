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
            'nama' => 'Laswi Raden Saragih',
            'alamat' => 'Psr. Bagas Pati No. 578',
            'tempatLahir' => 'Banda Aceh',
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
            'nama' => 'Kania Riyanti',
            'alamat' => 'Jln. Bagonwoto No. 686',
            'tempatLahir' => 'Sulawesi Selatan',
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
            'nama' => 'Harto Gadang Prasasta',
            'alamat' => 'Psr. Basket No. 233',
            'tempatLahir' => 'Sulawesi Utara',
            'tanggalLahir' => '1970-03-19',
            'jenisKelamin' => 'L',
            'pekerjaan' => 'HRD',
            'umur' => '51',
            'idAdmin' => '1',
            'created_at' => '2021-02-28',
            'updated_at' => '2021-02-28'
        ]);

        DB::table('anggota')->insert([
            'id'=> 'A004',
            'nama' => 'Yessi Prastuti',
            'alamat' => 'Ki. Haji No. 976',
            'tempatLahir' => 'Tangerang',
            'tanggalLahir' => '1987-04-05',
            'jenisKelamin' => 'P',
            'pekerjaan' => 'Pramuniaga',
            'umur' => '34',
            'idAdmin' => '1',
            'created_at' => '2021-02-28',
            'updated_at' => '2021-02-28'
        ]);

        DB::table('anggota')->insert([
            'id'=> 'A005',
            'nama' => 'Gandi Saputra',
            'alamat' => 'Dk. Suharso No. 432',
            'tempatLahir' => 'Padang',
            'tanggalLahir' => '1990-07-12',
            'jenisKelamin' => 'L',
            'pekerjaan' => 'IT Support',
            'umur' => '31',
            'idAdmin' => '1',
            'created_at' => '2021-02-28',
            'updated_at' => '2021-02-28'
        ]);
    }
}
