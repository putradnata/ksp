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
            'tanggal' => '2021-02-28',
            'bunga' => '0.30',
            'created_at' => '2021-02-28'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S001-001',
            'kodeSimpanan' => 'S001',
            'tanggal' => '2021-02-28',
            'jumlah' => '2000000',
            'saldo' => '2000000',
            'keterangan' => 'CR',
            'created_at' => '2021-02-28'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S001-002',
            'kodeSimpanan' => 'S001',
            'tanggal' => '2021-03-01',
            'jumlah' => '6000',
            'saldo' => '2006000',
            'keterangan' => 'CRB',
            'created_at' => '2021-03-01'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S001-003',
            'kodeSimpanan' => 'S001',
            'tanggal' => '2021-03-15',
            'jumlah' => '500000',
            'saldo' => '2506000',
            'keterangan' => 'CR',
            'created_at' => '2021-03-15'
        ]);



        DB::table('simpanan')->insert([
            'kode'=> 'S002',
            'idAnggota' => 'A002',
            'tanggal' => '2021-02-28',
            'bunga' => '0.30',
            'created_at' => '2021-02-28'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S002-001',
            'kodeSimpanan' => 'S002',
            'tanggal' => '2021-02-28',
            'jumlah' => '500000',
            'saldo' => '500000',
            'keterangan' => 'CR',
            'created_at' => '2021-02-28'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S002-002',
            'kodeSimpanan' => 'S002',
            'tanggal' => '2021-03-01',
            'jumlah' => '1500',
            'saldo' => '501500',
            'keterangan' => 'CRB',
            'created_at' => '2021-03-01'
        ]);



        DB::table('simpanan')->insert([
            'kode'=> 'S003',
            'idAnggota' => 'A003',
            'tanggal' => '2021-03-02',
            'bunga' => '0.30',
            'created_at' => '2021-03-02'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S003-001',
            'kodeSimpanan' => 'S003',
            'tanggal' => '2021-03-02',
            'jumlah' => '2000000',
            'saldo' => '2000000',
            'keterangan' => 'CR',
            'created_at' => '2021-03-02'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S003-002',
            'kodeSimpanan' => 'S003',
            'tanggal' => '2021-03-07',
            'jumlah' => '500000',
            'saldo' => '2500000',
            'keterangan' => 'CR',
            'created_at' => '2021-03-07'
        ]);



        DB::table('simpanan')->insert([
            'kode'=> 'S004',
            'idAnggota' => 'A004',
            'tanggal' => '2021-03-05',
            'bunga' => '0.30',
            'created_at' => '2021-03-05'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S004-001',
            'kodeSimpanan' => 'S004',
            'tanggal' => '2021-03-05',
            'jumlah' => '650000',
            'saldo' => '650000',
            'keterangan' => 'CR',
            'created_at' => '2021-03-05'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S004-002',
            'kodeSimpanan' => 'S004',
            'tanggal' => '2021-03-07',
            'jumlah' => '150000',
            'saldo' => '500000',
            'keterangan' => 'DB',
            'created_at' => '2021-03-07'
        ]);



        DB::table('simpanan')->insert([
            'kode'=> 'S005',
            'idAnggota' => 'A005',
            'tanggal' => '2021-03-08',
            'bunga' => '0.30',
            'created_at' => '2021-03-08'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S005-001',
            'kodeSimpanan' => 'S005',
            'tanggal' => '2021-03-08',
            'jumlah' => '400000',
            'saldo' => '400000',
            'keterangan' => 'CR',
            'created_at' => '2021-03-08'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S005-002',
            'kodeSimpanan' => 'S005',
            'tanggal' => '2021-03-15',
            'jumlah' => '400000',
            'saldo' => '0',
            'keterangan' => 'DB',
            'created_at' => '2021-03-15'
        ]);
    }
}
