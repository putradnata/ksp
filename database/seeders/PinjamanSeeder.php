<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JurnalUmum;
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
            'tanggal' => '2021-03-20', // 20 21 22
            'jaminan' => 'KTP/KK',
            'jumlah' => 1000000,
            'statusPinjaman' => 'Belum Lunas',
            'created_at' => '2021-03-20',
            'updated_at' => '2021-03-20'
        ]);



        $data1 = [
            'noTransaksi' => 'JU-00020',
            'noAkun' => 117,
            'tanggal' => '2021-03-20',
            'jumlah' => 1000000,
            'status' => 'DEBIT',
            'keterangan' => 'Pinjaman anggota I Gede Gandi Saputra',
            'idAdmin' => 2
        ];

        $insertJurnal1 = JurnalUmum::create($data1);

        $data2 = [
            'noTransaksi' => 'JU-00020',
            'noAkun' => 111,
            'tanggal' => '2021-03-20',
            'jumlah' => 1000000,
            'status' => 'KREDIT',
            'keterangan' => 'Pinjaman anggota I Gede Gandi Saputra',
            'idAdmin' => 2
        ];

        $insertJurnal2 = JurnalUmum::create($data2);

        $data1 = [
            'noTransaksi' => 'JU-00021',
            'noAkun' => 111,
            'tanggal' => '2021-03-20',
            'jumlah' => 30000,
            'status' => 'DEBIT',
            'keterangan' => 'Pendapatan administrasi pinjaman (P001) I Gede Gandi Saputra',
            'idAdmin' => 2
        ];

        $insertJurnal1 = JurnalUmum::create($data1);

        $data2 = [
            'noTransaksi' => 'JU-00021',
            'noAkun' => 414,
            'tanggal' => '2021-03-20',
            'jumlah' => 30000,
            'status' => 'KREDIT',
            'keterangan' => 'Pendapatan administrasi pinjaman (P001) I Gede Gandi Saputra',
            'idAdmin' => 2
        ];

        $insertJurnal2 = JurnalUmum::create($data2);

        $data1 = [
            'noTransaksi' => 'JU-00022',
            'noAkun' => 111,
            'tanggal' => '2021-03-20',
            'jumlah' => 10000,
            'status' => 'DEBIT',
            'keterangan' => 'Pendapatan materai pinjaman (P001) I Gede Gandi Saputra',
            'idAdmin' => 2
        ];

        $insertJurnal1 = JurnalUmum::create($data1);

        $data2 = [
            'noTransaksi' => 'JU-00022',
            'noAkun' => 415,
            'tanggal' => '2021-03-20',
            'jumlah' => 10000,
            'status' => 'KREDIT',
            'keterangan' => 'Pendapatan materai pinjaman (P001) I Gede Gandi Saputra',
            'idAdmin' => 2
        ];

        $insertJurnal2 = JurnalUmum::create($data2);



        DB::table('simpanan_wajib')->insert([
            'kode'=> 'SPW001',
            'idAnggota' => 'A005',
            'syarat' => 'KTP/KK',
            'tanggal' => '2021-03-20', // 23
            'jumlah' => 10000,
            'created_at' => '2021-03-20',
            'updated_at' => '2021-03-20'
        ]);

        $data1 = [
            'noTransaksi' =>'JU-00023',
            'noAkun' => 111,
            'tanggal' => '2021-03-20',
            'jumlah' => 10000,
            'status' => 'DEBIT',
            'keterangan' => 'Setoran simpanan wajib I Gede Gandi Saputra',
            'idAdmin' => 2
        ];

        $insertJurnal1 = JurnalUmum::create($data1);

        $data2 = [
            'noTransaksi' =>'JU-00023',
            'noAkun' => 314,
            'tanggal' => '2021-03-20',
            'jumlah' => 10000,
            'status' => 'KREDIT',
            'keterangan' => 'Setoran simpanan wajib I Gede Gandi Saputra',
            'idAdmin' => 2
        ];

        $insertJurnal2 = JurnalUmum::create($data2);



        DB::table('pinjaman')->insert([
            'kode'=> 'P002',
            'idAnggota' => 'A004',
            'tanggal' => '2021-04-10', // 31 32 33
            'jaminan' => 'KTP/KK',
            'jumlah' => 2000000,
            'statusPinjaman' => 'Belum Lunas',
            'created_at' => '2021-04-10',
            'updated_at' => '2021-04-10'
        ]);


        $data1 = [
            'noTransaksi' => 'JU-00031',
            'noAkun' => 117,
            'tanggal' => '2021-04-10',
            'jumlah' => 2000000,
            'status' => 'DEBIT',
            'keterangan' => 'Pinjaman anggota Ni Nyoman Yessi Prastuti',
            'idAdmin' => 2
        ];

        $insertJurnal1 = JurnalUmum::create($data1);

        $data2 = [
            'noTransaksi' => 'JU-00031',
            'noAkun' => 111,
            'tanggal' => '2021-04-10',
            'jumlah' => 2000000,
            'status' => 'KREDIT',
            'keterangan' => 'Pinjaman anggota Ni Nyoman Yessi Prastuti',
            'idAdmin' => 2
        ];

        $insertJurnal2 = JurnalUmum::create($data2);

        $data1 = [
            'noTransaksi' => 'JU-00032',
            'noAkun' => 111,
            'tanggal' => '2021-04-10',
            'jumlah' => 60000,
            'status' => 'DEBIT',
            'keterangan' => 'Pendapatan administrasi pinjaman (P002) Ni Nyoman Yessi Prastuti',
            'idAdmin' => 2
        ];

        $insertJurnal1 = JurnalUmum::create($data1);

        $data2 = [
            'noTransaksi' => 'JU-00032',
            'noAkun' => 414,
            'tanggal' => '2021-04-10',
            'jumlah' => 60000,
            'status' => 'KREDIT',
            'keterangan' => 'Pendapatan administrasi pinjaman (P002) Ni Nyoman Yessi Prastuti',
            'idAdmin' => 2
        ];

        $insertJurnal2 = JurnalUmum::create($data2);

        $data1 = [
            'noTransaksi' => 'JU-00033',
            'noAkun' => 111,
            'tanggal' => '2021-04-10',
            'jumlah' => 10000,
            'status' => 'DEBIT',
            'keterangan' => 'Pendapatan materai pinjaman (P002) Ni Nyoman Yessi Prastuti',
            'idAdmin' => 2
        ];

        $insertJurnal1 = JurnalUmum::create($data1);

        $data2 = [
            'noTransaksi' => 'JU-00033',
            'noAkun' => 415,
            'tanggal' => '2021-04-10',
            'jumlah' => 10000,
            'status' => 'KREDIT',
            'keterangan' => 'Pendapatan materai pinjaman (P002) Ni Nyoman Yessi Prastuti',
            'idAdmin' => 2
        ];

        $insertJurnal2 = JurnalUmum::create($data2);



        DB::table('simpanan_wajib')->insert([
            'kode'=> 'SPW002',
            'idAnggota' => 'A004',
            'syarat' => 'KTP/KK',
            'tanggal' => '2021-04-10', // 34
            'jumlah' => 20000,
            'created_at' => '2021-04-10',
            'updated_at' => '2021-04-10'
        ]);

        $data1 = [
            'noTransaksi' =>'JU-00034',
            'noAkun' => 111,
            'tanggal' => '2021-04-10',
            'jumlah' => 20000,
            'status' => 'DEBIT',
            'keterangan' => 'Setoran simpanan wajib Ni Nyoman Yessi Prastuti',
            'idAdmin' => 2
        ];

        $insertJurnal1 = JurnalUmum::create($data1);

        $data2 = [
            'noTransaksi' =>'JU-00034',
            'noAkun' => 314,
            'tanggal' => '2021-04-10',
            'jumlah' => 20000,
            'status' => 'KREDIT',
            'keterangan' => 'Setoran simpanan wajib Ni Nyoman Yessi Prastuti',
            'idAdmin' => 2
        ];

        $insertJurnal2 = JurnalUmum::create($data2);

    }
}
