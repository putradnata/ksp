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
        $dataPenarikan = DB::table('penarikan')
                                ->join('simpanan', 'simpanan.kode', '=', 'penarikan.kodeSimpanan')
                                ->join('anggota', 'simpanan.idAnggota', '=', 'anggota.id')
                                ->select('penarikan.*','anggota.nama as namaAnggota','anggota.id as idAnggota')
                                ->get();

        return view('admin/penarikan.index',[
            'penarikan' => $dataPenarikan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataPenarikan = DB::select("
            SELECT MAX(simpanan.kode) as kode, MAX(simpanan.saldo) as saldo, anggota.id as idAnggota, anggota.nama as namaAnggota FROM `simpanan` INNER JOIN anggota ON simpanan.idAnggota = anggota.id GROUP BY anggota.id
        ");

        $dataSisaSaldo = DB::select("
            SELECT kode, kodeSimpanan, idAnggota, saldo, saldoAkhir, jumlah
            FROM penarikan
            WHERE penarikan.kode IN (
                SELECT MAX(penarikan.kode)
                FROM penarikan
                GROUP BY penarikan.idAnggota
            )
        ");

        $dataSisaSaldo2 = DB::select("
            SELECT kode, kodeSimpanan, idAnggota, saldo, saldoAkhir, SUM(jumlah) as jumlah
            FROM penarikan
            GROUP BY idAnggota
        ");

        $code = 'P';
        $last = DB::table('penarikan')
                ->where('kode', 'like', '%'.$code.'%')
                ->max('kode');

        if($last == null)
        {
            $kodePenarikan = $code.'001';
        } else {
            $new = substr($last,-3);
            $new +=1;
            $kodePenarikan = $code.sprintf("%03d", $new);
        }

        return view('admin/penarikan.create',[
            'anggota' => $dataPenarikan,
            'ap' => $dataPenarikan,
            'app' => $dataPenarikan,
            'penarikan' => $kodePenarikan,
            'sisaSaldo' => $dataSisaSaldo,
            'sisaSaldo2' => $dataSisaSaldo2
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
        $request->saldo = intval(preg_replace('/[^0-9]+/', '', $request->saldo), 10);
        $request->saldoAkhir = intval(preg_replace('/[^0-9]+/', '', $request->saldoAkhir), 10);

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

        $data = [
            'kode' => $request->kode,
            'kodeSimpanan' => $request->kodeSimpanan,
            'idAnggota' => $request->idAnggota,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'saldo' => $request->saldo,
            'saldoAkhir' => $request->saldoAkhir
        ];

        $insertData = Penarikan::create($data);

        if($insertData){
            return redirect('admin/penarikan')->with('success','Data Berhasil Disimpan');
        }else{
            return redirect('admin/penarikan.create')->with('error','Data Gagal Disimpan');
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
