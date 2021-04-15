<?php

namespace App\Http\Controllers;

use App\Models\Penarikan;
use Illuminate\Http\Request;
use DB;

class PenarikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $dataPenarikan = DB::table('penarikan')
        //                         ->join('simpanan', 'simpanan.kode', '=', 'penarikan.kodeSimpanan')
        //                         ->join('anggota', 'simpanan.idAnggota', '=', 'anggota.id')
        //                         ->select('penarikan.*','anggota.nama as namaAnggota','anggota.id as idAnggota')
        //                         ->get();

        // return view('admin/penarikan.index',[
        //     'penarikan' => $dataPenarikan
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataSimpanan = DB::select('
            SELECT
                anggota.id AS idAnggota,
                anggota.nama AS namaAnggota,
                simpanan.kode,
                simpanan.tanggal,
                detail_simpanan.kode as kodeDetail,
                detail_simpanan.saldo as saldo
            FROM detail_simpanan
            JOIN simpanan ON simpanan.kode = detail_simpanan.kodeSimpanan
            JOIN anggota ON simpanan.idAnggota = anggota.id
            WHERE detail_simpanan.kode IN
            (SELECT MAX(detail_simpanan.kode) FROM detail_simpanan GROUP BY detail_simpanan.kodeSimpanan)
        ');

        return view('admin/penarikan.create', compact('dataSimpanan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->saldoAkhir == "Saldo tidak mencukupi!"){
            return redirect('admin/penarikan/create')->withErrors('Saldo anggota tidak mencukupi !');
        }else{
            $request->saldo = intval(preg_replace('/[^0-9]+/', '', $request->saldo), 10);
            $request->saldoAkhir = intval(preg_replace('/[^0-9]+/', '', $request->saldoAkhir), 10);
        }

        $messages = array(
            'tanggal.required' => 'Tanggal penarikan tidak boleh kosong!',
            'idAnggota.required' => 'Nama anggota tidak boleh kosong!',
            'jumlah.required' => 'Jumlah penarikan tidak boleh kosong!'
        );

        $validate = $request->validate([
            'tanggal' => 'required',
            'idAnggota' => 'required',
            'jumlah'=> 'required'
        ],$messages);

        $code = 'TRS-'.$request->kodeSimpanan.'-';
        $new = substr($request->kodeTrx,-3);
        $new +=1;
        $kodeDetailSimpanan = $code.sprintf("%03d", $new);

        $data = [
            'kode'=> $kodeDetailSimpanan,
            'kodeSimpanan' => $request->kodeSimpanan,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'saldo' => $request->saldoAkhir,
            'keterangan' => 'DB'
        ];

        $insertData = Penarikan::create($data);

        if($insertData){
            return redirect('admin/simpanan')->with('success','Data Berhasil Disimpan');
        }else{
            return redirect('admin/penarikan/create')->with('error','Data Gagal Disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penarikan  $penarikan
     * @return \Illuminate\Http\Response
     */
    public function show(Penarikan $penarikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penarikan  $penarikan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penarikan $penarikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penarikan  $penarikan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penarikan $penarikan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penarikan  $penarikan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penarikan $penarikan)
    {
        //
    }
}
