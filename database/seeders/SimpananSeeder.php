<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SimpananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('simpanan')->insert([
            'kode'=> 'S001',
            'idAnggota' => 'A001',
            'tanggal' => '2021-03-01',
            'jumlah' => '1000000',
            'bunga' => '0.3',
            'saldo' => '1000000',
            'created_at' => '2021-03-01',
            'updated_at' => '2021-03-01'
        ]);

        DB::table('simpanan')->insert([
            'kode'=> 'S002',
            'idAnggota' => 'A002',
            'tanggal' => '2021-03-01',
            'jumlah' => '500000',
            'bunga' => '0.3',
            'saldo' => '500000',
            'created_at' => '2021-03-01',
            'updated_at' => '2021-03-01'
        ]);

        DB::table('simpanan')->insert([
            'kode'=> 'S003',
            'idAnggota' => 'A001',
            'tanggal' => '2021-03-02',
            'jumlah' => '150000',
            'bunga' => '0.3',
            'saldo' => '1150000',
            'created_at' => '2021-03-02',
            'updated_at' => '2021-03-02'
        ]);


        DB::table('simpanan')->insert([
            'kode'=> 'S004',
            'idAnggota' => 'A002',
            'tanggal' => '2021-03-04',
            'jumlah' => '50000',
            'bunga' => '0.3',
            'saldo' => '550000',
            'created_at' => '2021-03-04',
            'updated_at' => '2021-03-04'
        ]);

        DB::table('simpanan')->insert([
            'kode'=> 'S005',
            'idAnggota' => 'A003',
            'tanggal' => '2021-03-04',
            'jumlah' => '500000',
            'bunga' => '0.3',
            'saldo' => '500000',
            'created_at' => '2021-03-04',
            'updated_at' => '2021-03-04'
        ]);

        DB::table('simpanan')->insert([
            'kode'=> 'S006',
            'idAnggota' => 'A003',
            'tanggal' => '2021-03-05',
            'jumlah' => '50000',
            'bunga' => '0.3',
            'saldo' => '550000',
            'created_at' => '2021-03-05',
            'updated_at' => '2021-03-05'
        ]);

        DB::table('simpanan')->insert([
            'kode'=> 'S007',
            'idAnggota' => 'A004',
            'tanggal' => '2021-03-08',
            'jumlah' => '50000',
            'bunga' => '0.3',
            'saldo' => '50000',
            'created_at' => '2021-03-08',
            'updated_at' => '2021-03-08'
        ]);

        DB::table('simpanan')->insert([
            'kode'=> 'S008',
            'idAnggota' => 'A005',
            'tanggal' => '2021-03-13',
            'jumlah' => '250000',
            'bunga' => '0.3',
            'saldo' => '250000',
            'created_at' => '2021-03-13',
            'updated_at' => '2021-03-13'
        ]);
    }
}
