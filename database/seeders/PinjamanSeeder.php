<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PinjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pinjaman')->insert([
            'kode'=> 'P001',
            'idAnggota' => 'A005',
            'tanggal' => '2021-03-20',
            'jaminan' => 'KTP/KK',
            'jumlah' => '1000000',
            'statusPinjaman' => 'Belum Lunas',
            'created_at' => '2021-03-20'
        ]);

        DB::table('simpanan_wajib')->insert([
            'kode'=> 'SPW001',
            'idAnggota' => 'A005',
            'syarat' => 'KTP/KK',
            'tanggal' => '2021-03-20',
            'jumlah' => '10000',
            'created_at' => '2021-03-20'
        ]);


        DB::table('jurnal_umum')->insert([
            'id' => '1',
            'noTransaksi' => 'JU-00001',
            'noAkun' => '111',
            'tanggal' => '2021-03-20',
            'jumlah' => '40000',
            'status' => 'DEBIT',
            'keterangan' => 'Administrasi pinjaman',
            'idAdmin' => '2'
        ]);

        DB::table('jurnal_umum')->insert([
            'id' => '2',
            'noTransaksi' => 'JU-00001',
            'noAkun' => '400',
            'tanggal' => '2021-03-20',
            'jumlah' => '40000',
            'status' => 'KREDIT',
            'keterangan' => 'Administrasi pinjaman',
            'idAdmin' => '2'
        ]);
    }
}
