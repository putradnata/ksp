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

        $filterDate = DB::table('jurnal_umum')
            ->join('akun','jurnal_umum.noAkun','=','akun.noAkun')
            ->select(
                'jurnal_umum.id as IDJurnal',
                'jurnal_umum.noTransaksi',
                'jurnal_umum.tanggal',
                'jurnal_umum.status',
                'jurnal_umum.keterangan',
                'jurnal_umum.noAkun',
                'jurnal_umum.jumlah',
                'akun.nama as namaAkun',
                'akun.tipe as tipeAkun',
            )
            ->selectRaw('cast(SUM(jurnal_umum.jumlah)as UNSIGNED) as jumlah')
            ->whereBetween('jurnal_umum.tanggal',[$request->dariTanggal,$request->sampaiTanggal])
            ->where('akun.tipe','Pendapatan')
            ->groupBy('jurnal_umum.noAkun')
            ->get();


        $filterDate2 = DB::table('jurnal_umum')
            ->join('akun','jurnal_umum.noAkun','=','akun.noAkun')
            ->select(
                'jurnal_umum.id as IDJurnal',
                'jurnal_umum.noTransaksi',
                'jurnal_umum.tanggal',
                'jurnal_umum.status',
                'jurnal_umum.keterangan',
                'jurnal_umum.noAkun',
                'jurnal_umum.jumlah',
                'akun.nama as namaAkun',
                'akun.tipe as tipeAkun',
            )
            ->selectRaw('cast(SUM(jurnal_umum.jumlah)as UNSIGNED) as jumlah')
            ->whereBetween('jurnal_umum.tanggal',[$request->dariTanggal,$request->sampaiTanggal])
            ->where('akun.tipe','Beban')
            ->groupBy('jurnal_umum.noAkun')
            ->get();

        if($request->cetak != null){
            return view('admin/shu.cetak',[
                'filter' => $filterDate,
                'filter2' => $filterDate2,
                'dariTanggal' => $request->dariTanggal,
                'sampaiTanggal' => $request->sampaiTanggal,
            ]);
        }else{
            return view('admin/shu.index',[
                'filter' => $filterDate,
                'filter2' => $filterDate2,
                'dariTanggal' => $request->dariTanggal,
                'sampaiTanggal' => $request->sampaiTanggal,
            ]);
        }
    }
}
