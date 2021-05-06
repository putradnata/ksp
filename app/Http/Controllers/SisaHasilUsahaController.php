<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SisaHasilUsahaController extends Controller
{
    public function index(){

        $mytime = Carbon::now();

        $convertedDate = $mytime->toDateString();

        return view('admin/shu.index',[
            'dariTanggal' => $convertedDate,
            'sampaiTanggal' => $convertedDate,
        ]);
    }

    public function SHUDateBased(Request $request){

        if($request->cari){
            $filterDate = DB::table('jurnal_umum')
                            ->join('akun','jurnal_umum.noAkun','=','akun.noAkun')
                            ->select(
                                'jurnal_umum.id as IDJurnal',
                                'jurnal_umum.noTransaksi',
                                'jurnal_umum.tanggal',
                                'jurnal_umum.status',
                                'jurnal_umum.keterangan',
                                'jurnal_umum.noAkun',
                                'akun.nama as namaAkun',
                                'akun.tipe as tipeAkun',
                            )
                            ->selectRaw('cast(SUM(jurnal_umum.jumlah)as UNSIGNED) as jumlah')
                            ->whereBetween('jurnal_umum.tanggal',[$request->dariTanggal,$request->sampaiTanggal])
                            ->where('akun.tipe','Pendapatan')
                            ->orWhere('akun.tipe','Beban')
                            ->groupBy('jurnal_umum.noAkun')
                            ->get();

            $denda = DB::table('angsuran')
                            ->whereBetween('tanggalBayar',[$request->dariBayar,$request->sampaiTanggal])
                            ->sum('denda');

            $bunga = DB::table('angsuran')
                            ->whereBetween('tanggalBayar',[$request->dariTanggal,$request->sampaiTanggal])
                            ->sum('bunga');

            $bungaSimpanan = DB::table('detail_simpanan')
                            ->where('keterangan','CRB')
                            ->whereBetween('tanggal',[$request->dariTanggal,$request->sampaiTanggal])
                            ->sum('jumlah');

            return view('admin/shu.index',[
                'filter' => $filterDate,
                'bunga' => $bunga,
                'denda' => $denda,
                'bungaSimpanan' => $bungaSimpanan,
                'dariTanggal' => $request->dariTanggal,
                'sampaiTanggal' => $request->sampaiTanggal,
            ]);
        }

        if($request->cetak){
            $filterDate = DB::table('jurnal_umum')
                            ->join('akun','jurnal_umum.noAkun','=','akun.noAkun')
                            ->select(
                                'jurnal_umum.id as IDJurnal',
                                'jurnal_umum.noTransaksi',
                                'jurnal_umum.tanggal',
                                'jurnal_umum.status',
                                'jurnal_umum.keterangan',
                                'jurnal_umum.noAkun',
                                'akun.nama as namaAkun',
                                'akun.tipe as tipeAkun',
                            )
                            ->selectRaw('cast(SUM(jurnal_umum.jumlah)as UNSIGNED) as jumlah')
                            ->whereBetween('jurnal_umum.tanggal',[$request->dariTanggal,$request->sampaiTanggal])
                            ->where('akun.tipe','Pendapatan')
                            ->orWhere('akun.tipe','Beban')
                            ->groupBy('jurnal_umum.noAkun')
                            ->get();

            $denda = DB::table('angsuran')
                            ->whereBetween('tanggalBayar',[$request->dariBayar,$request->sampaiTanggal])
                            ->sum('denda');

            $bunga = DB::table('angsuran')
                            ->whereBetween('tanggalBayar',[$request->dariTanggal,$request->sampaiTanggal])
                            ->sum('bunga');

            $bungaSimpanan = DB::table('detail_simpanan')
                            ->where('keterangan','CRB')
                            ->whereBetween('tanggal',[$request->dariTanggal,$request->sampaiTanggal])
                            ->sum('jumlah');

            return view('admin/shu.cetak',[
                'filter' => $filterDate,
                'bunga' => $bunga,
                'denda' => $denda,
                'bungaSimpanan' => $bungaSimpanan,
                'dariTanggal' => $request->dariTanggal,
                'sampaiTanggal' => $request->sampaiTanggal,
            ]);
        }

    }
}
