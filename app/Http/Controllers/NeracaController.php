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

        return view('ketua/neraca.index',[
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

            // echo 'asd '.$key1;

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
                'jurnal_umum.jumlah as testJumlah'
            )
            ->where('jurnal_umum.noAkun',$ns->noAkun)
            ->whereBetween('jurnal_umum.tanggal',[$request->dariTanggal,$request->sampaiTanggal])
            ->get();

            // $ddz = $filterParent->toSql();
            // $binding = $filterParent->getBindings();

            // echo "<pre>";
            // var_dump($filterParent);
            // print_r($ns);
            // echo " =========================================================== </pre>";

            $noAkun[$key1]['noAkun'] = $ns->noAkun;
            $noAkun[$key1]['namaAkun'] = $ns->nama;
            $noAkun[$key1]['tipeAkun'] = $ns->tipe;
            $noAkun[$key1]['hasilAkhir'] = 0;

            foreach ($filterParent as $value) {
                if ($value->testJumlah != null ) {
                    // print_r('<= '.$value->testJumlah.' => ');
                    if(
                        $value->tipeAkun == 'Aktiva Lancar' ||
                        $value->tipeAkun == 'Aktiva Tetap' ||
                        $value->tipeAkun == 'Harta Tak Berwujud' ||
                        $value->tipeAkun == 'Beban'
                    ) {
                        if($value->status == 'DEBIT') {
                            $noAkun[$key1]['hasilAkhir'] += $value->testJumlah;
                        }
                        if($value->status == 'KREDIT') {
                            $noAkun[$key1]['hasilAkhir'] -= $value->testJumlah;
                        }
                    }

                    if(
                        $value->tipeAkun == 'Kewajiban' ||
                        $value->tipeAkun == 'Ekuitas' ||
                        $value->tipeAkun == 'Pendapatan'
                    ) {
                        // echo $value->testJumlah.' <=> '.$noAkun[$key1]['hasilAkhir'];

                        if($value->status == 'DEBIT') {
                            $noAkun[$key1]['hasilAkhir'] -= $value->testJumlah;
                        }
                        if($value->status == 'KREDIT') {
                            $noAkun[$key1]['hasilAkhir'] += $value->testJumlah;
                        }
                    }
                }
            }

            if(
                $ns->tipe == 'Aktiva Lancar' ||
                $ns->tipe == 'Aktiva Tetap' ||
                $ns->tipe == 'Harta Tak Berwujud' ||
                $ns->tipe == 'Beban'
            ) {
                $noAkun[$key1]['statusAkun'] = 'DEBIT';
            }

            if(
                $ns->tipe == 'Kewajiban' ||
                $ns->tipe == 'Ekuitas' ||
                $ns->tipe == 'Pendapatan'
            ) {
                $noAkun[$key1]['statusAkun'] = 'KREDIT';
            }
        }

        $noAkun = array_values($noAkun);

        return view('ketua/neraca.index',[
            'akun' => $noAkun,
            'dariTanggal' => $dariTanggal,
            'sampaiTanggal' => $sampaiTanggal,
        ]);
    }

    public function indexPercobaan(){
        $mytime = Carbon::now();

        $convertedDate = $mytime->toDateString();

        return view('ketua/neraca.indexPercobaan',[
            'dariTanggal' => $convertedDate
        ]);
    }

    public function getNeracaPercobaan(Request $request){

        $bulan = Carbon::parse($request->dariTanggal)->format('m');
        $tahun = Carbon::parse($request->dariTanggal)->format('Y');
        $dariTanggal = $request->dariTanggal;

        $noAkun = [];
        $noAkun_search = DB::table('akun')->orderBy('noAkun', 'asc')->get();

        foreach ($noAkun_search as $key1 => $ns) {

            // echo 'asd '.$key1;

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
                'jurnal_umum.jumlah as testJumlah'
            )
            ->where('jurnal_umum.noAkun',$ns->noAkun)
            ->whereMonth('jurnal_umum.tanggal', '<', $bulan)
            ->whereYear('jurnal_umum.tanggal', '<=', $tahun)
            ->get();

            // $ddz = $filterParent->toSql();
            // $binding = $filterParent->getBindings();

            // echo "<pre>";
            // var_dump($filterParent);
            // print_r($ns);
            // echo " =========================================================== </pre>";

            $noAkun[$key1]['noAkun'] = $ns->noAkun;
            $noAkun[$key1]['namaAkun'] = $ns->nama;
            $noAkun[$key1]['tipeAkun'] = $ns->tipe;
            $noAkun[$key1]['hasilAkhir'] = 0;

            foreach ($filterParent as $value) {
                if ($value->testJumlah != null ) {
                    // print_r('<= '.$value->testJumlah.' => ');
                    if(
                        $value->tipeAkun == 'Aktiva Lancar' ||
                        $value->tipeAkun == 'Aktiva Tetap' ||
                        $value->tipeAkun == 'Harta Tak Berwujud' ||
                        $value->tipeAkun == 'Beban'
                    ) {
                        if($value->status == 'DEBIT') {
                            $noAkun[$key1]['hasilAkhir'] += $value->testJumlah;
                        }
                        if($value->status == 'KREDIT') {
                            $noAkun[$key1]['hasilAkhir'] -= $value->testJumlah;
                        }
                    }

                    if(
                        $value->tipeAkun == 'Kewajiban' ||
                        $value->tipeAkun == 'Ekuitas' ||
                        $value->tipeAkun == 'Pendapatan'
                    ) {
                        // echo $value->testJumlah.' <=> '.$noAkun[$key1]['hasilAkhir'];

                        if($value->status == 'DEBIT') {
                            $noAkun[$key1]['hasilAkhir'] -= $value->testJumlah;
                        }
                        if($value->status == 'KREDIT') {
                            $noAkun[$key1]['hasilAkhir'] += $value->testJumlah;
                        }
                    }
                }
            }

            if(
                $ns->tipe == 'Aktiva Lancar' ||
                $ns->tipe == 'Aktiva Tetap' ||
                $ns->tipe == 'Harta Tak Berwujud' ||
                $ns->tipe == 'Beban'
            ) {
                $noAkun[$key1]['status'] = 'DEBIT';
            }

            if(
                $ns->tipe == 'Kewajiban' ||
                $ns->tipe == 'Ekuitas' ||
                $ns->tipe == 'Pendapatan'
            ) {
                $noAkun[$key1]['status'] = 'KREDIT';
            }
        }

        $noAkun = array_values($noAkun);


        $noAkunNow = [];

        foreach ($noAkun_search as $key1 => $ns) {

            // echo 'asd '.$key1;

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
                'jurnal_umum.jumlah as testJumlah'
            )
            ->where('jurnal_umum.noAkun',$ns->noAkun)
            ->whereMonth('jurnal_umum.tanggal', $bulan)
            ->whereYear('jurnal_umum.tanggal', '<=', $tahun)
            ->get();

            // $ddz = $filterParent->toSql();
            // $binding = $filterParent->getBindings();

            // echo "<pre>";
            // var_dump($filterParent);
            // print_r($ns);
            // echo " =========================================================== </pre>";

            $noAkunNow[$key1]['noAkun'] = $ns->noAkun;
            $noAkunNow[$key1]['namaAkun'] = $ns->nama;
            $noAkunNow[$key1]['tipeAkun'] = $ns->tipe;
            $noAkunNow[$key1]['hasilAkhir'] = 0;

            foreach ($filterParent as $value) {
                if ($value->testJumlah != null ) {
                    // print_r('<= '.$value->testJumlah.' => ');
                    if(
                        $value->tipeAkun == 'Aktiva Lancar' ||
                        $value->tipeAkun == 'Aktiva Tetap' ||
                        $value->tipeAkun == 'Harta Tak Berwujud' ||
                        $value->tipeAkun == 'Beban'
                    ) {
                        if($value->status == 'DEBIT') {
                            $noAkunNow[$key1]['hasilAkhir'] += $value->testJumlah;
                        }
                        if($value->status == 'KREDIT') {
                            $noAkunNow[$key1]['hasilAkhir'] -= $value->testJumlah;
                        }
                    }

                    if(
                        $value->tipeAkun == 'Kewajiban' ||
                        $value->tipeAkun == 'Ekuitas' ||
                        $value->tipeAkun == 'Pendapatan'
                    ) {
                        // echo $value->testJumlah.' <=> '.$noAkunNow[$key1]['hasilAkhir'];

                        if($value->status == 'DEBIT') {
                            $noAkunNow[$key1]['hasilAkhir'] -= $value->testJumlah;
                        }
                        if($value->status == 'KREDIT') {
                            $noAkunNow[$key1]['hasilAkhir'] += $value->testJumlah;
                        }
                    }
                }
            }

            if(
                $ns->tipe == 'Aktiva Lancar' ||
                $ns->tipe == 'Aktiva Tetap' ||
                $ns->tipe == 'Harta Tak Berwujud' ||
                $ns->tipe == 'Beban'
            ) {
                $noAkunNow[$key1]['status'] = 'DEBIT';
            }

            if(
                $ns->tipe == 'Kewajiban' ||
                $ns->tipe == 'Ekuitas' ||
                $ns->tipe == 'Pendapatan'
            ) {
                $noAkunNow[$key1]['status'] = 'KREDIT';
            }
        }

        $noAkunNow = array_values($noAkunNow);

        return view('ketua/neraca.indexPercobaan',[
            'akun' => $noAkun,
            'akunNow' => $noAkunNow,
            'dariTanggal' => $dariTanggal,
        ]);
    }
}

