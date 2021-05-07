<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SimpananKhususSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('simpanan_khusus')->insert([
            'kode'=> 'SPS001',
            'idAnggota' => 'A001',
            'tanggal' => '2021-02-28',
            'jumlah' => '10000000',
            'saldo' => '10000000',
            'created_at' => '2021-02-28',
            'updated_at' => '2021-02-28'
        ]);

        DB::table('simpanan_khusus')->insert([
            'kode'=> 'SPS002',
            'idAnggota' => 'A002',
            'tanggal' => '2021-02-28',
            'jumlah' => '5000000',
            'saldo' => '5000000',
            'created_at' => '2021-02-28',
            'updated_at' => '2021-02-28'
        ]);
    }
}
