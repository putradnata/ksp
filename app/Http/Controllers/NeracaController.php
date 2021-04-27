<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class NeracaController extends Controller
{
    public function index(){
        $mytime = Carbon::now();

        $convertedDate = $mytime->toDateString();

        return view('admin/neraca.index',[
            'dariTanggal' => $convertedDate,
            'sampaiTanggal' => $convertedDate,
        ]);
    }

    public function getNeraca(Request $request){

        $dariTanggal = $request->dariTanggal;
        $sampaiTanggal = $request->sampaiTanggal;

        $noAkun = [];
        $noAkun_search = DB::table('akun')->orderBy('noAkun', 'asc')->get();

        foreach ($noAkun_search as $key1 => $ns) {

            $noAkun[$key1]['noAkun'] = $ns->noAkun;

            $filterParent = DB::table('jurnal_umum')
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
            ->selectRaw('cast(sum(jurnal_umum.jumlah)as UNSIGNED) as testJumlah')
            ->where('jurnal_umum.status', 'DEBIT')
            ->where('jurnal_umum.noAkun', $ns->noAkun)
            ->whereBetween('jurnal_umum.tanggal',[$request->dariTanggal,$request->sampaiTanggal])
            ->get();

            $filterParent2 = DB::table('jurnal_umum')
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
            ->selectRaw('cast(sum(jurnal_umum.jumlah)as UNSIGNED) as testJumlah')
            ->where('jurnal_umum.status', 'KREDIT')
            ->where('jurnal_umum.noAkun', $ns->noAkun)
            ->whereBetween('jurnal_umum.tanggal',[$request->dariTanggal,$request->sampaiTanggal])
            ->get();

            if (@$filterParent[0]->testJumlah != null) {
                $noAkun[$key1]['hasilAkhir'] = $filterParent[0]->testJumlah - $filterParent2[0]->testJumlah;
                $noAkun[$key1]['tipeAkun'] = $filterParent[0]->tipeAkun;
                $noAkun[$key1]['namaAkun'] = $filterParent[0]->namaAkun;
            } else {
                $noAkun[$key1]['hasilAkhir'] = $filterParent2[0]->testJumlah;
                $noAkun[$key1]['tipeAkun'] = $filterParent[0]->tipeAkun;
                $noAkun[$key1]['namaAkun'] = $filterParent[0]->namaAkun;

                if(@$filterParent2[0]->testJumlah == null){
                    $noAkun[$key1]['hasilAkhir'] = 0;
                }

            }
        }

        $modalSendiri = [];

        $simpananPokok = DB::table('simpanan_pokok')
        ->sum('jumlah');

        $simpananWajib = DB::table('simpanan_wajib')
        ->sum('jumlah');

        $simpananKhusus = DB::table('simpanan_khusus')
        ->sum('saldo');


        for($x=0;$x<3;$x++){
                if($x==0 && $simpananPokok != null){
                    $modalSendiri[$x]['namaAkun'] = 'Simpanan Pokok';
                    $modalSendiri[$x]['jumlah'] = $simpananPokok;
                }else if($x==1 && $simpananWajib != null){
                    $modalSendiri[$x]['namaAkun'] = 'Simpanan Wajib';
                    $modalSendiri[$x]['jumlah'] = $simpananWajib;
                }else{
                    if($simpananKhusus != null){
                        $modalSendiri[$x]['namaAkun'] = 'Simpanan Khusus';
                        $modalSendiri[$x]['jumlah'] = $simpananKhusus;
                    }
                }
        }


        return view('admin/neraca.index',[
            'akun' => $noAkun,
            'modalSendiri' => $modalSendiri,
            'dariTanggal' => $dariTanggal,
            'sampaiTanggal' => $sampaiTanggal,
        ]);
    }
}
