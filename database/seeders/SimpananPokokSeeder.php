<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JurnalUmum;
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
            'tanggal' => '2021-02-28', // 1
            'jumlah' => 10000,
            'created_at' => '2021-02-28',
            'updated_at' => '2021-02-28'
        ]);

        $data1 = [
            'noTransaksi' => 'JU-00001',
            'noAkun' => 111,
            'tanggal' => '2021-02-28',
            'jumlah' => 10000,
            'status' => 'DEBIT',
            'keterangan' => 'Setoran simpanan pokok Wayan Kusuma Putra',
            'idAdmin' => 2
        ];

        $insertJurnal1 = JurnalUmum::create($data1);

        $data2 = [
            'noTransaksi' => 'JU-00001',
            'noAkun' => 313,
            'tanggal' => '2021-02-28',
            'jumlah' => 10000,
            'status' => 'KREDIT',
            'keterangan' => 'Setoran simpanan pokok Wayan Kusuma Putra',
            'idAdmin' => 2
        ];

        $insertJurnal2 = JurnalUmum::create($data2);



        DB::table('simpanan_pokok')->insert([
            'kode'=> 'SPK002',
            'idAnggota' => 'A002',
            'syarat' => 'KTP/KK', // 2
            'tanggal' => '2021-02-28',
            'jumlah' => 10000,
            'created_at' => '2021-02-28',
            'updated_at' => '2021-02-28'
        ]);

        $data1 = [
            'noTransaksi' => 'JU-00002',
            'noAkun' => 111,
            'tanggal' => '2021-02-28',
            'jumlah' => 10000,
            'status' => 'DEBIT',
            'keterangan' => 'Setoran simpanan pokok Ni Putu Kania Riyanti',
            'idAdmin' => 2
        ];

        $insertJurnal1 = JurnalUmum::create($data1);

        $data2 = [
            'noTransaksi' => 'JU-00002',
            'noAkun' => 313,
            'tanggal' => '2021-02-28',
            'jumlah' => 10000,
            'status' => 'KREDIT',
            'keterangan' => 'Setoran simpanan pokok Ni Putu Kania Riyanti',
            'idAdmin' => 2
        ];

        $insertJurnal2 = JurnalUmum::create($data2);



        DB::table('simpanan_pokok')->insert([
            'kode'=> 'SPK003',
            'idAnggota' => 'A003',
            'syarat' => 'KTP/KK',
            'tanggal' => '2021-03-02', // 9
            'jumlah' => 10000,
            'created_at' => '2021-03-02',
            'updated_at' => '2021-03-02'
        ]);

        $data1 = [
            'noTransaksi' => 'JU-00009',
            'noAkun' => 111,
            'tanggal' => '2021-03-02',
            'jumlah' => 10000,
            'status' => 'DEBIT',
            'keterangan' => 'Setoran simpanan pokok I Made Subagia',
            'idAdmin' => 2
        ];

        $insertJurnal1 = JurnalUmum::create($data1);

        $data2 = [
            'noTransaksi' => 'JU-00009',
            'noAkun' => 313,
            'tanggal' => '2021-03-02',
            'jumlah' => 10000,
            'status' => 'KREDIT',
            'keterangan' => 'Setoran simpanan pokok I Made Subagia',
            'idAdmin' => 2
        ];

        $insertJurnal2 = JurnalUmum::create($data2);



        DB::table('simpanan_pokok')->insert([
            'kode'=> 'SPK004',
            'idAnggota' => 'A004',
            'syarat' => 'KTP/KK',
            'tanggal' => '2021-03-05', // 11
            'jumlah' => 10000,
            'created_at' => '2021-03-05',
            'updated_at' => '2021-03-05'
        ]);

        $data1 = [
            'noTransaksi' => 'JU-00011',
            'noAkun' => 111,
            'tanggal' => '2021-03-05',
            'jumlah' => 10000,
            'status' => 'DEBIT',
            'keterangan' => 'Setoran simpanan pokok Ni Nyoman Yessi Prastuti',
            'idAdmin' => 2
        ];

        $insertJurnal1 = JurnalUmum::create($data1);

        $data2 = [
            'noTransaksi' => 'JU-00011',
            'noAkun' => 313,
            'tanggal' => '2021-03-05',
            'jumlah' => 10000,
            'status' => 'KREDIT',
            'keterangan' => 'Setoran simpanan pokok Ni Nyoman Yessi Prastuti',
            'idAdmin' => 2
        ];

        $insertJurnal2 = JurnalUmum::create($data2);



        DB::table('simpanan_pokok')->insert([
            'kode'=> 'SPK005',
            'idAnggota' => 'A005',
            'syarat' => 'KTP/KK', // 15
            'tanggal' => '2021-03-08',
            'jumlah' => 10000,
            'created_at' => '2021-03-08',
            'updated_at' => '2021-03-08'
        ]);

        $data1 = [
            'noTransaksi' => 'JU-00015',
            'noAkun' => 111,
            'tanggal' => '2021-03-08',
            'jumlah' => 10000,
            'status' => 'DEBIT',
            'keterangan' => 'Setoran simpanan pokok Ni Nyoman Yessi Prastuti',
            'idAdmin' => 2
        ];

        $insertJurnal1 = JurnalUmum::create($data1);

        $data2 = [
            'noTransaksi' => 'JU-00015',
            'noAkun' => 313,
            'tanggal' => '2021-03-08',
            'jumlah' => 10000,
            'status' => 'KREDIT',
            'keterangan' => 'Setoran simpanan pokok Ni Nyoman Yessi Prastuti',
            'idAdmin' => 2
        ];

        $insertJurnal2 = JurnalUmum::create($data2);
    }
}
