<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JurnalUmum;
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
            'tanggal' => '2021-02-28', // 3
            'jumlah' => 10000000,
            'saldo' => 10000000,
            'created_at' => '2021-02-28',
            'updated_at' => '2021-02-28'
        ]);

        $data1 = [
            'noTransaksi' => 'JU-00003',
            'noAkun' => 111,
            'tanggal' => '2021-02-28',
            'jumlah' => 10000000,
            'status' => 'DEBIT',
            'keterangan' => 'Setoran simpanan khusus Wayan Kusuma Putra',
            'idAdmin' => 2
        ];

        $insertJurnal1 = JurnalUmum::create($data1);

        $data2 = [
            'noTransaksi' => 'JU-00003',
            'noAkun' => 315,
            'tanggal' => '2021-02-28',
            'jumlah' => 10000000,
            'status' => 'KREDIT',
            'keterangan' => 'Setoran simpanan khusus Wayan Kusuma Putra',
            'idAdmin' => 2
        ];

        $insertJurnal2 = JurnalUmum::create($data2);



        DB::table('simpanan_khusus')->insert([
            'kode'=> 'SPS002',
            'idAnggota' => 'A002',
            'tanggal' => '2021-02-28', // 4
            'jumlah' => 5000000,
            'saldo' => 5000000,
            'created_at' => '2021-02-28',
            'updated_at' => '2021-02-28'
        ]);

        $data1 = [
            'noTransaksi' => 'JU-00004',
            'noAkun' => 111,
            'tanggal' => '2021-02-28',
            'jumlah' => 5000000,
            'status' => 'DEBIT',
            'keterangan' => 'Setoran simpanan khusus Ni Putu Kania Riyanti',
            'idAdmin' => 2
        ];

        $insertJurnal1 = JurnalUmum::create($data1);

        $data2 = [
            'noTransaksi' => 'JU-00004',
            'noAkun' => 315,
            'tanggal' => '2021-02-28',
            'jumlah' => 5000000,
            'status' => 'KREDIT',
            'keterangan' => 'Setoran simpanan khusus Ni Putu Kania Riyanti',
            'idAdmin' => 2
        ];

        $insertJurnal2 = JurnalUmum::create($data2);
    }
}
