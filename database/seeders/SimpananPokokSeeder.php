<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SimpananPokokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('simpanan_pokok')->insert([
            'kode'=> 'SPK001',
            'idAnggota' => 'A001',
            'syarat' => 'KTP/KK',
            'tanggal' => '2021-02-28',
            'jumlah' => '10000',
            'created_at' => '2021-02-28',
            'updated_at' => '2021-02-28'
        ]);

        DB::table('simpanan_pokok')->insert([
            'kode'=> 'SPK002',
            'idAnggota' => 'A002',
            'syarat' => 'KTP/KK',
            'tanggal' => '2021-02-28',
            'jumlah' => '10000',
            'created_at' => '2021-02-28',
            'updated_at' => '2021-02-28'
        ]);

        DB::table('simpanan_pokok')->insert([
            'kode'=> 'SPK003',
            'idAnggota' => 'A003',
            'syarat' => 'KTP/KK',
            'tanggal' => '2021-03-02',
            'jumlah' => '10000',
            'created_at' => '2021-03-02',
            'updated_at' => '2021-03-02'
        ]);

        DB::table('simpanan_pokok')->insert([
            'kode'=> 'SPK004',
            'idAnggota' => 'A004',
            'syarat' => 'KTP/KK',
            'tanggal' => '2021-03-05',
            'jumlah' => '10000',
            'created_at' => '2021-03-05',
            'updated_at' => '2021-03-05'
        ]);

        DB::table('simpanan_pokok')->insert([
            'kode'=> 'SPK005',
            'idAnggota' => 'A005',
            'syarat' => 'KTP/KK',
            'tanggal' => '2021-03-08',
            'jumlah' => '10000',
            'created_at' => '2021-03-08',
            'updated_at' => '2021-03-08'
        ]);
    }
}
