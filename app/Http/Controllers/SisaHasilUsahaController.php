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

        $filter = DB::table('jurnal_umum')
                        ->join('akun','jurnal_umum.noAkun','=','akun.noAkun')
                        ->select(
                            'jurnal_umum.id as IDJurnal',
                            'jurnal_umum.noTransaksi',
                            'jurnal_umum.tanggal',
                            'jurnal_umum.jumlah',
                            'jurnal_umum.status',
                            'jurnal_umum.keterangan',
                            'jurnal_umum.noAkun',
                            'akun.nama as namaAkun',
                            'akun.tipe as tipeAkun',
                        )
                        ->where('akun.tipe','Pendapatan')
                        ->orWhere('akun.tipe','Beban')
                        ->whereBetween('jurnal_umum.tanggal',[$convertedDate,$convertedDate])
                        ->get();

        return view('admin/shu.index',[
            'filter' => $filter,
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
                            'jurnal_umum.jumlah',
                            'jurnal_umum.status',
                            'jurnal_umum.keterangan',
                            'jurnal_umum.noAkun',
                            'akun.nama as namaAkun',
                            'akun.tipe as tipeAkun',
                        )
                        ->whereBetween('jurnal_umum.tanggal',[$request->dariTanggal,$request->sampaiTanggal])
                        ->get();

            return view('admin/shu.index',[
                'filter' => $filterDate,
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
                            'jurnal_umum.jumlah',
                            'jurnal_umum.status',
                            'jurnal_umum.keterangan',
                            'jurnal_umum.noAkun',
                            'akun.nama as namaAkun',
                            'akun.tipe as tipeAkun',
                        )
                        ->whereBetween('jurnal_umum.tanggal',[$request->dariTanggal,$request->sampaiTanggal])
                        ->get();

            return view('admin/shu.cetak',[
                'filter' => $filterDate,
                'dariTanggal' => $request->dariTanggal,
                'sampaiTanggal' => $request->sampaiTanggal,
            ]);
        }

    }
}
