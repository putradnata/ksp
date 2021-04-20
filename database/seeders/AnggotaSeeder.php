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
            'created_at' => '2021-02-28'
        ]);

        DB::table('simpanan_pokok')->insert([
            'kode'=> 'SPK001',
            'idAnggota' => 'A001',
            'syarat' => 'KTP/KK',
            'tanggal' => '2021-02-28',
            'jumlah' => '10000',
            'created_at' => '2021-02-28'
        ]);

        DB::table('simpanan_khusus')->insert([
            'kode'=> 'SPS001',
            'idAnggota' => 'A001',
            'tanggal' => '2021-02-28',
            'jumlah' => '10000000',
            'saldo' => '10000000',
            'created_at' => '2021-02-28'
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
        ]);

        DB::table('simpanan_pokok')->insert([
            'kode'=> 'SPK002',
            'idAnggota' => 'A002',
            'syarat' => 'KTP/KK',
            'tanggal' => '2021-02-28',
            'jumlah' => '10000',
            'created_at' => '2021-02-28'
        ]);

        DB::table('simpanan_khusus')->insert([
            'kode'=> 'SPS002',
            'idAnggota' => 'A002',
            'tanggal' => '2021-02-28',
            'jumlah' => '5000000',
            'saldo' => '5000000',
            'created_at' => '2021-02-28'
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
            'created_at' => '2021-03-02',
        ]);

        DB::table('simpanan_pokok')->insert([
            'kode'=> 'SPK003',
            'idAnggota' => 'A003',
            'syarat' => 'KTP/KK',
            'tanggal' => '2021-03-02',
            'jumlah' => '10000',
            'created_at' => '2021-03-02'
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
            'created_at' => '2021-03-05',
        ]);

        DB::table('simpanan_pokok')->insert([
            'kode'=> 'SPK004',
            'idAnggota' => 'A004',
            'syarat' => 'KTP/KK',
            'tanggal' => '2021-03-05',
            'jumlah' => '10000',
            'created_at' => '2021-03-05'
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
            'created_at' => '2021-03-08',
        ]);

        DB::table('simpanan_pokok')->insert([
            'kode'=> 'SPK005',
            'idAnggota' => 'A005',
            'syarat' => 'KTP/KK',
            'tanggal' => '2021-03-08',
            'jumlah' => '10000',
            'created_at' => '2021-03-08'
        ]);
    }
}
