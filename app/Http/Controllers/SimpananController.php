<?php

namespace App\Http\Controllers;

use App\Models\Simpanan;
use App\Models\DetailSimpanan;
use Illuminate\Http\Request;
use DB;

class SimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $firstDayThisMonth = \Carbon\Carbon::now()->startOfMonth()->toDateString();
        $thisDay = \Carbon\Carbon::now()->toDateString();

        $thisMonth = \Carbon\Carbon::now()->startOfMonth()->format('m');
        $thisYear = \Carbon\Carbon::now()->format('Y');

        $dataSimpanan = DB::select('
            SELECT
                anggota.id AS idAnggota,
                anggota.nama AS namaAnggota,
                simpanan.kode,
                simpanan.tanggal,
                detail_simpanan.saldo as saldo
            FROM detail_simpanan
            JOIN simpanan ON simpanan.kode = detail_simpanan.kodeSimpanan
            JOIN anggota ON simpanan.idAnggota = anggota.id
            WHERE detail_simpanan.kode IN
            (SELECT MAX(detail_simpanan.kode) FROM detail_simpanan GROUP BY detail_simpanan.kodeSimpanan)
        ');

        $checkerSukuBunga = DB::table('detail_simpanan')
                                ->where('keterangan','CRB')
                                ->whereMonth('tanggal', $thisMonth)
                                ->whereYear('tanggal', $thisYear)
                                ->count();

        return view('admin/simpanan.index',[
            'simpanan' => $dataSimpanan,
            'thisDay' => $thisDay,
            'firstDayThisMonth' => $firstDayThisMonth,
            'checkerSukuBunga' => $checkerSukuBunga
        ]);
    }

    /**
     * Updating balance with bank rates.
     *
     * @return \Illuminate\Http\Response
     */
    public function bankRates()
    {
        $firstDayThisMonth = \Carbon\Carbon::now()->startOfMonth()->toDateString();
        $thisDay = \Carbon\Carbon::now()->toDateString();

        $thisMonth = \Carbon\Carbon::now()->startOfMonth()->format('m');
        $thisYear = \Carbon\Carbon::now()->format('Y');

        $checkerSukuBunga = DB::table('detail_simpanan')
                                ->where('keterangan','CRB')
                                ->whereMonth('tanggal', $thisMonth)
                                ->whereYear('tanggal', $thisYear)
                                ->count();

        if($checkerSukuBunga == 0){
            $previousMonth = \Carbon\Carbon::now()->startOfMonth()->subMonth()->format('m');
            $thisYear = \Carbon\Carbon::now()->format('Y');

            $simpanan = [];
            $simpanan_search = DB::table('simpanan')->select('kode','bunga')->get();

            foreach ($simpanan_search as $key1 => $ss) {

                $checkerDetailSimpanan = DB::table('detail_simpanan')
                    ->selectRaw('cast(MIN(saldo)as UNSIGNED) as saldoTerRendah')
                    ->where('kodeSimpanan', $ss->kode)
                    ->whereMonth('tanggal', $previousMonth)
                    ->whereYear('tanggal', $thisYear)
                    ->groupBy('kodeSimpanan')
                    ->get();

                if ((@$checkerDetailSimpanan[0]->saldoTerRendah != null) || (@$checkerDetailSimpanan[0]->saldoTerRendah != 0)) {
                        $simpanan[$key1]['kodeSimpanan'] = $ss->kode;
                        $simpanan[$key1]['saldoTerendah'] = $checkerDetailSimpanan[0]->saldoTerRendah;
                        $simpanan[$key1]['sukuBunga'] = $checkerDetailSimpanan[0]->saldoTerRendah * ($ss->bunga / 100);
                }
            }

            $count=count($simpanan);

            for ($i=0; $i < $count; $i++) {
                if ($simpanan[$i]['saldoTerendah'] != 0) {
                    $code = 'TRS-'.$simpanan[$i]['kodeSimpanan'].'-';
                    $last = DB::table('detail_simpanan')
                            ->where('kode', 'like', '%'.$code.'%')
                            ->max('kode');

                    $new = substr($last,-3);
                    $new +=1;
                    $kodeDetailSimpanan = $code.sprintf("%03d", $new);

                    $lastSimpanan = DB::table('detail_simpanan')
                                ->select('kode','saldo')
                                ->where('kodeSimpanan', $simpanan[$i]['kodeSimpanan'])
                                ->orderBy('kode','desc')
                                ->first();

                    $Totalsaldo = $lastSimpanan->saldo + $simpanan[$i]['sukuBunga'];

                    DB::table('detail_simpanan')->insert([
                        'kode'=> $kodeDetailSimpanan,
                        'kodeSimpanan' => $simpanan[$i]['kodeSimpanan'],
                        'tanggal' => $thisDay,
                        'jumlah' => $simpanan[$i]['sukuBunga'],
                        'saldo' => $Totalsaldo,
                        'keterangan' => 'CRB',
                        'created_at' => $thisDay
                    ]);
                }
            }
        }

        return redirect('admin/simpanan')->with('success','Data Berhasil Disimpan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selectAnggota = DB::table('anggota')
                            ->select('id','nama')
                            ->get();

        $dataSimpanan = DB::table('simpanan')
                            ->join('anggota', 'simpanan.idAnggota', '=', 'anggota.id')
                            ->select('simpanan.*','anggota.nama as namaAnggota','anggota.id as idAnggota')
                            ->orderBy('kode','ASC')
                            ->get();

        $code = 'S';
        $last = DB::table('simpanan')
                ->where('kode', 'like', '%'.$code.'%')
                ->max('kode');

        if($last == null)
        {
            $kodeSimpanan = $code.'001';
        } else {
            $new = substr($last,-3);
            $new +=1;
            $kodeSimpanan = $code.sprintf("%03d", $new);
        }

        return view('admin/simpanan.create',[
            'anggota' => $selectAnggota,
            'simpanan' => $kodeSimpanan,
            'rekeningAnggota' => $dataSimpanan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = array(
            'tanggal.required' => 'Tanggal simpanan tidak boleh kosong!',
            'idAnggota.required' => 'Nama anggota tidak boleh kosong!',
            'jumlah.required' => 'Jumlah simpanan tidak boleh kosong!'
        );

        $validate = $request->validate([
            'tanggal' => 'required',
            'idAnggota'=> 'required',
            'jumlah' => 'required'
        ],$messages);

        $checkerSimpanan = DB::table('simpanan')
                            ->where('kode', $request->kode)
                            ->first();

        if($checkerSimpanan == null){
            $data = [
                'kode'=> $request->kode,
                'idAnggota' => $request->idAnggota,
                'tanggal' => $request->tanggal,
                'bunga' => $request->bunga,
            ];
            $insertData = Simpanan::create($data);

            $data = [
                'kode'=> 'TRS-'.$request->kode.'-001',
                'kodeSimpanan' => $request->kode,
                'tanggal' => $request->tanggal,
                'jumlah' => $request->jumlah,
                'saldo' => $request->jumlah,
                'keterangan' => 'CR'
            ];
            $insertDataDetail = DetailSimpanan::create($data);
        }else{
            $code = 'TRS-'.$request->kode.'-';
            $last = DB::table('detail_simpanan')
                    ->where('kode', 'like', '%'.$code.'%')
                    ->max('kode');

            if($last != null)
            {
                $new = substr($last,-3);
                $new +=1;
                $kodeDetailSimpanan = $code.sprintf("%03d", $new);
            }

            $lastSimpanan = DB::table('detail_simpanan')
                                ->select('kode','saldo')
                                ->where('kodeSimpanan', $request->kode)
                                ->orderBy('kode','desc')
                                ->first();

            if($lastSimpanan != null){
                $Totalsaldo = $lastSimpanan->saldo + $request->jumlah;
            }

            $data = [
                'kode'=> $kodeDetailSimpanan,
                'kodeSimpanan' => $request->kode,
                'tanggal' => $request->tanggal,
                'jumlah' => $request->jumlah,
                'saldo' => $Totalsaldo,
                'keterangan' => 'CR'
            ];
            $insertDataDetail = DetailSimpanan::create($data);
        }

        if($insertDataDetail){
            return redirect('admin/simpanan')->with('success','Data Berhasil Disimpan');
        }else{
            return redirect('admin/simpanan.create')->with('error','Data Gagal Disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Simpanan  $simpanan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataDetailSimpanan = DB::table('detail_simpanan')
                            ->where('kodeSimpanan', $id)
                            ->orderBy('kode','ASC')
                            ->get();

        return view('admin/simpanan.show',[
            'dataDetailSimpanan' => $dataDetailSimpanan
        ])->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Simpanan  $simpanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Simpanan $simpanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Simpanan  $simpanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Simpanan $simpanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Simpanan  $simpanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Simpanan $simpanan)
    {
        //
    }
}
