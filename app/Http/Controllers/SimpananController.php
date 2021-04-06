<?php

namespace App\Http\Controllers;

use App\Models\Simpanan;
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
        $dataSimpanan = DB::table('simpanan')
                                ->join('anggota', 'simpanan.idAnggota', '=', 'anggota.id')
                                ->select('simpanan.*','anggota.nama as namaAnggota','anggota.id as idAnggota')
                                ->orderBy('kode','ASC')
                                ->get();

        return view('admin/simpanan.index',[
            'simpanan' => $dataSimpanan
        ]);
    }

    /**
     * Updating balance with bank rates.
     *
     * @return \Illuminate\Http\Response
     */
    public function bankRates()
    {
        $previousMonth = \Carbon\Carbon::now()->startOfMonth()->subMonth()->format('m');
        $thisYear = \Carbon\Carbon::now()->format('Y');

        $idAnggota = [];
        $anggota_search = DB::table('simpanan')->select('idAnggota')->groupBy('idAnggota')->get();

        foreach ($anggota_search as $key1 => $as) {

            $idAnggota[$key1]['idAnggota'] = $as->idAnggota;

            $checkerPenarikan = DB::table('penarikan')
                ->join('simpanan', 'simpanan.idAnggota', '=', 'penarikan.idAnggota')
                ->selectRaw('cast(MIN(penarikan.saldoAkhir)as UNSIGNED) as penarikanSaldoRendah')
                ->where('simpanan.idAnggota', $as->idAnggota)
                ->whereMonth('penarikan.tanggal', $previousMonth)
                ->whereYear('penarikan.tanggal', $thisYear)
                ->groupBy('simpanan.idAnggota')
                ->get();

                if (@$checkerPenarikan[0]->penarikanSaldoRendah != null) {
                    $checkerSimpanan = DB::table('simpanan')
                        ->selectRaw('cast(MIN(saldo)as UNSIGNED) as simpananSaldoRendah')
                        ->where('idAnggota', $as->idAnggota)
                        ->whereMonth('simpanan.tanggal', $previousMonth)
                        ->whereYear('simpanan.tanggal', $thisYear)
                        ->get();
                    if ($checkerPenarikan[0]->penarikanSaldoRendah < $checkerSimpanan[0]->simpananSaldoRendah) {
                        $idAnggota[$key1]['saldoTerendah'] = $checkerPenarikan[0]->penarikanSaldoRendah;
                        $idAnggota[$key1]['bunga'] = $checkerPenarikan[0]->penarikanSaldoRendah * (0.3/100);
                    }else{
                        $idAnggota[$key1]['saldoTerendah']  = $checkerSimpanan[0]->simpananSaldoRendah;
                        $idAnggota[$key1]['bunga'] = $checkerSimpanan[0]->simpananSaldoRendah * (0.3/100);
                    }
                } else {
                    $checkerSimpanan = DB::table('simpanan')
                        ->selectRaw('cast(MIN(saldo)as UNSIGNED) as simpananSaldoRendah')
                        ->where('idAnggota', $as->idAnggota)
                        ->whereMonth('simpanan.tanggal', $previousMonth)
                        ->whereYear('simpanan.tanggal', $thisYear)
                        ->get();

                    if($checkerSimpanan[0]->simpananSaldoRendah != null){
                        $idAnggota[$key1]['saldoTerendah']  = $checkerSimpanan[0]->simpananSaldoRendah;
                        $idAnggota[$key1]['bunga'] = $checkerSimpanan[0]->simpananSaldoRendah * (0.3/100);
                    }else{
                        $idAnggota[$key1]['saldoTerendah']  = 0;
                        $idAnggota[$key1]['bunga'] = 0;
                    }
                }
        }

        $count=count($idAnggota);

        $endDayofPreviousMonth = \Carbon\Carbon::now()->endOfMonth()->subMonth()->toDateString();

        for ($i=0; $i < $count; $i++) {
            if ($idAnggota[$i]['saldoTerendah'] != 0) {
                $code = 'S';
                $last = DB::table('simpanan')
                        ->where('kode', 'like', '%'.$code.'%')
                        ->max('kode');

                $new = substr($last,-3);
                $new +=1;
                $kodeSimpanan = $code.sprintf("%03d", $new);

                $lastSimpanan = DB::table('simpanan')
                            ->select('saldo')
                            ->where('idAnggota', $idAnggota[$i]['idAnggota'])
                            ->orderBy('kode','desc')
                            ->first();

                $Totalsaldo = $lastSimpanan->saldo + $idAnggota[$i]['bunga'];

                DB::table('simpanan')->insert([
                    'kode'=> $kodeSimpanan,
                    'idAnggota' => $idAnggota[$i]['idAnggota'],
                    'tanggal' => $endDayofPreviousMonth,
                    'jumlah' => $idAnggota[$i]['bunga'],
                    'bunga' => '0.3',
                    'saldo' => $Totalsaldo,
                    'created_at' => $endDayofPreviousMonth,
                    'updated_at' => $endDayofPreviousMonth
                ]);
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
            'simpanan' => $kodeSimpanan
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
        $lastSimpanan = DB::table('simpanan')
                        ->select('kode','idAnggota','saldo')
                        ->where('idAnggota', $request->idAnggota)
                        ->orderBy('kode','desc')
                        ->first();

        if($lastSimpanan != null){
            $Totalsaldo = $lastSimpanan->saldo + $request->jumlah;
        }else{
            $Totalsaldo = $request->jumlah;
        }

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

        $data = [
            'kode'=> $request->kode,
            'idAnggota' => $request->idAnggota,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'bunga' => $request->bunga,
            'saldo' => $Totalsaldo
        ];

        $insertData = Simpanan::create($data);

        if($insertData){
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
    public function show(Simpanan $simpanan)
    {
        //
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
