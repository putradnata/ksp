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
            'created_at' => '2021-02-28',
            'updated_at' => '2021-02-28'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S001-001',
            'kodeSimpanan' => 'S001',
            'tanggal' => '2021-02-28',
            'jumlah' => '2000000',
            'saldo' => '2000000',
            'keterangan' => 'CR',
            'created_at' => '2021-02-28',
            'updated_at' => '2021-02-28'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S001-002',
            'kodeSimpanan' => 'S001',
            'tanggal' => '2021-03-01',
            'jumlah' => '6000',
            'saldo' => '2006000',
            'keterangan' => 'CRB',
            'created_at' => '2021-03-01',
            'updated_at' => '2021-03-01'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S001-003',
            'kodeSimpanan' => 'S001',
            'tanggal' => '2021-03-15',
            'jumlah' => '500000',
            'saldo' => '2506000',
            'keterangan' => 'CR',
            'created_at' => '2021-03-15',
            'updated_at' => '2021-03-15'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S001-004',
            'kodeSimpanan' => 'S001',
            'tanggal' => '2021-03-25',
            'jumlah' => '44000',
            'saldo' => '2550000',
            'keterangan' => 'CR',
            'created_at' => '2021-03-25',
            'updated_at' => '2021-03-25'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S001-005',
            'kodeSimpanan' => 'S001',
            'tanggal' => '2021-04-01',
            'jumlah' => '7650',
            'saldo' => '2557650',
            'keterangan' => 'CRB',
            'created_at' => '2021-04-01',
            'updated_at' => '2021-04-01'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S001-006',
            'kodeSimpanan' => 'S001',
            'tanggal' => '2021-04-10',
            'jumlah' => '100000',
            'saldo' => '2657650',
            'keterangan' => 'CR',
            'created_at' => '2021-04-10',
            'updated_at' => '2021-04-10'
        ]);



        DB::table('simpanan')->insert([
            'kode'=> 'S002',
            'idAnggota' => 'A002',
            'tanggal' => '2021-02-28',
            'bunga' => '0.30',
            'created_at' => '2021-02-28',
            'updated_at' => '2021-02-28'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S002-001',
            'kodeSimpanan' => 'S002',
            'tanggal' => '2021-02-28',
            'jumlah' => '500000',
            'saldo' => '500000',
            'keterangan' => 'CR',
            'created_at' => '2021-02-28',
            'updated_at' => '2021-02-28'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S002-002',
            'kodeSimpanan' => 'S002',
            'tanggal' => '2021-03-01',
            'jumlah' => '1500',
            'saldo' => '501500',
            'keterangan' => 'CRB',
            'created_at' => '2021-03-01',
            'updated_at' => '2021-03-01'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S002-003',
            'kodeSimpanan' => 'S002',
            'tanggal' => '2021-03-20',
            'jumlah' => '1148500',
            'saldo' => '1650000',
            'keterangan' => 'CR',
            'created_at' => '2021-03-20',
            'updated_at' => '2021-03-20'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S002-004',
            'kodeSimpanan' => 'S002',
            'tanggal' => '2021-04-01',
            'jumlah' => '4950',
            'saldo' => '165490',
            'keterangan' => 'CRB',
            'created_at' => '2021-04-01',
            'updated_at' => '2021-04-01'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S002-005',
            'kodeSimpanan' => 'S002',
            'tanggal' => '2021-04-23',
            'jumlah' => '50000',
            'saldo' => '215490',
            'keterangan' => 'CR',
            'created_at' => '2021-04-23',
            'updated_at' => '2021-04-23'
        ]);



        DB::table('simpanan')->insert([
            'kode'=> 'S003',
            'idAnggota' => 'A003',
            'tanggal' => '2021-03-02',
            'bunga' => '0.30',
            'created_at' => '2021-03-02',
            'updated_at' => '2021-03-02'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S003-001',
            'kodeSimpanan' => 'S003',
            'tanggal' => '2021-03-02',
            'jumlah' => '2000000',
            'saldo' => '2000000',
            'keterangan' => 'CR',
            'created_at' => '2021-03-02',
            'updated_at' => '2021-03-02'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S003-002',
            'kodeSimpanan' => 'S003',
            'tanggal' => '2021-03-07',
            'jumlah' => '500000',
            'saldo' => '2500000',
            'keterangan' => 'CR',
            'created_at' => '2021-03-07',
            'updated_at' => '2021-03-07'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S003-003',
            'kodeSimpanan' => 'S003',
            'tanggal' => '2021-04-01',
            'jumlah' => '7500',
            'saldo' => '2507500',
            'keterangan' => 'CRB',
            'created_at' => '2021-04-01',
            'updated_at' => '2021-04-01'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S003-004',
            'kodeSimpanan' => 'S003',
            'tanggal' => '2021-04-17',
            'jumlah' => '150000',
            'saldo' => '2657500',
            'keterangan' => 'CR',
            'created_at' => '2021-04-17',
            'updated_at' => '2021-04-17'
        ]);



        DB::table('simpanan')->insert([
            'kode'=> 'S004',
            'idAnggota' => 'A004',
            'tanggal' => '2021-03-05',
            'bunga' => '0.30',
            'created_at' => '2021-03-05',
            'updated_at' => '2021-03-05'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S004-001',
            'kodeSimpanan' => 'S004',
            'tanggal' => '2021-03-05',
            'jumlah' => '650000',
            'saldo' => '650000',
            'keterangan' => 'CR',
            'created_at' => '2021-03-05',
            'updated_at' => '2021-03-05'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S004-002',
            'kodeSimpanan' => 'S004',
            'tanggal' => '2021-03-07',
            'jumlah' => '150000',
            'saldo' => '500000',
            'keterangan' => 'DB',
            'created_at' => '2021-03-07',
            'updated_at' => '2021-03-07'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S004-003',
            'kodeSimpanan' => 'S004',
            'tanggal' => '2021-03-22',
            'jumlah' => '125000',
            'saldo' => '625000',
            'keterangan' => 'CR',
            'created_at' => '2021-03-22',
            'updated_at' => '2021-03-22'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S004-004',
            'kodeSimpanan' => 'S004',
            'tanggal' => '2021-04-01',
            'jumlah' => '1875',
            'saldo' => '626875',
            'keterangan' => 'CRB',
            'created_at' => '2021-04-01',
            'updated_at' => '2021-04-01'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S004-005',
            'kodeSimpanan' => 'S004',
            'tanggal' => '2021-04-27',
            'jumlah' => '26875',
            'saldo' => '600000',
            'keterangan' => 'DB',
            'created_at' => '2021-04-27',
            'updated_at' => '2021-04-27'
        ]);



        DB::table('simpanan')->insert([
            'kode'=> 'S005',
            'idAnggota' => 'A005',
            'tanggal' => '2021-03-08',
            'bunga' => '0.30',
            'created_at' => '2021-03-08',
            'updated_at' => '2021-03-08'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S005-001',
            'kodeSimpanan' => 'S005',
            'tanggal' => '2021-03-08',
            'jumlah' => '400000',
            'saldo' => '400000',
            'keterangan' => 'CR',
            'created_at' => '2021-03-08',
            'updated_at' => '2021-03-08'
        ]);

        DB::table('detail_simpanan')->insert([
            'kode'=> 'TRS-S005-002',
            'kodeSimpanan' => 'S005',
            'tanggal' => '2021-03-15',
            'jumlah' => '400000',
            'saldo' => '0',
            'keterangan' => 'DB',
            'created_at' => '2021-03-15',
            'updated_at' => '2021-03-15'
        ]);
    }
}
