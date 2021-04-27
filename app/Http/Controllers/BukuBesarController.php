<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuBesarController extends Controller
{
    public function index(){
        $showAkun = DB::table('akun')->select('noAkun','nama')->get();

        return view('admin/bukubesar.index',[
            'akun' => $showAkun
        ]);
    }

    public function getAccountActivity(Request $request){

        $showAkun = DB::table('akun')->select('noAkun','nama')->get();

        $selectData = DB::table('jurnal_umum')
                        ->join('akun','akun.noAkun','=','jurnal_umum.noAkun')
                        ->select(
                            'jurnal_umum.tanggal as Tanggal',
                            'jurnal_umum.noTransaksi as NoTransaksi',
                            'akun.nama as Akun',
                            'jurnal_umum.keterangan as Keterangan',
                            'jurnal_umum.jumlah as JumlahTransaksi',
                            'jurnal_umum.status as Posisi'
                            )
                        ->where('akun.noAkun',$request->akun)
                        ->whereBetween('jurnal_umum.tanggal',[$request->dariTanggal,$request->sampaiTanggal])
                        ->get();

        // $data = $request->all();

        return view('admin/bukubesar.index')
            ->with('accountActivities', $selectData,true)
            ->with('akun',$showAkun);
    }
}
