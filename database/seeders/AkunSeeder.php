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
            'saldo' => '0',
            'created_at' => '2021-02-28',
        ]);

        DB::table('akun')->insert([
            'noAkun'=> '117',
            'nama' => 'Pinjaman anggota',
            'tipe' => 'Aktiva Tetap',
            'saldo' => '0',
            'created_at' => '2021-02-28',
        ]);

        DB::table('akun')->insert([
            'noAkun'=> '112',
            'nama' => 'Peralatan kantor',
            'tipe' => 'Aktiva Tetap',
            'saldo' => '0',
            'created_at' => '2021-02-28',
        ]);

        DB::table('akun')->insert([
            'noAkun'=> '223',
            'nama' => 'Simpanan harian',
            'tipe' => 'Kewajiban',
            'saldo' => '0',
            'created_at' => '2021-02-28',
        ]);

        DB::table('akun')->insert([
            'noAkun'=> '313',
            'nama' => 'Simpanan pokok',
            'tipe' => 'Ekuitas',
            'saldo' => '0',
            'created_at' => '2021-02-28',
        ]);

        DB::table('akun')->insert([
            'noAkun'=> '314',
            'nama' => 'Simpanan wajib',
            'tipe' => 'Ekuitas',
            'saldo' => '0',
            'created_at' => '2021-02-28',
        ]);

        DB::table('akun')->insert([
            'noAkun'=> '315',
            'nama' => 'Simpanan khusus',
            'tipe' => 'Ekuitas',
            'saldo' => '0',
            'created_at' => '2021-02-28',
        ]);

        DB::table('akun')->insert([
            'noAkun'=> '413',
            'nama' => 'Bunga pinjaman',
            'tipe' => 'Pendapatan',
            'saldo' => '0',
            'created_at' => '2021-02-28',
        ]);

        DB::table('akun')->insert([
            'noAkun'=> '414',
            'nama' => 'Biaya administrasi',
            'tipe' => 'Pendapatan',
            'saldo' => '0',
            'created_at' => '2021-02-28',
        ]);

        DB::table('akun')->insert([
            'noAkun'=> '415',
            'nama' => 'Materai',
            'tipe' => 'Pendapatan',
            'saldo' => '0',
            'created_at' => '2021-02-28',
        ]);

        DB::table('akun')->insert([
            'noAkun'=> '416',
            'nama' => 'Denda pinjaman',
            'tipe' => 'Pendapatan',
            'saldo' => '0',
            'created_at' => '2021-02-28',
        ]);

        DB::table('akun')->insert([
            'noAkun'=> '512',
            'nama' => 'Beban listrik, air & telp',
            'tipe' => 'Beban',
            'saldo' => '0',
            'created_at' => '2021-02-28',
        ]);

        DB::table('akun')->insert([
            'noAkun'=> '514',
            'nama' => 'Beban bunga simpanan',
            'tipe' => 'Beban',
            'saldo' => '0',
            'created_at' => '2021-02-28',
        ]);
    }
}
