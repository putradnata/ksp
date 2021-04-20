<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('akun')->insert([
            'noAkun'=> '111',
            'nama' => 'Kas',
            'tipe' => 'Aktiva Lancar',
            'saldo' => '1000000',
            'created_at' => '2021-02-28',
        ]);

        DB::table('akun')->insert([
            'noAkun'=> '400',
            'nama' => 'Pendapatan',
            'tipe' => 'Pendapatan',
            'saldo' => '1000000',
            'created_at' => '2021-02-28',
        ]);
    }
}
