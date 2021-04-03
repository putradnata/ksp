<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use Illuminate\Http\Request;
use DB;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataPinjaman = DB::table('pinjaman')
                                ->join('anggota', 'pinjaman.idAnggota', '=', 'anggota.id')
                                ->select('pinjaman.*','anggota.nama as namaAnggota','anggota.id as idAnggota')
                                ->get();

        return view('admin/pinjaman.index',[
            'pinjaman' => $dataPinjaman
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pinjaman = DB::table('pinjaman')->count();

        if($pinjaman == 0){
            $selectAnggota = DB::table('anggota')
                            ->select('id','nama')
                            ->get();
        }else{
            $selectAnggota = DB::select("
                SELECT anggota.id , anggota.nama
                FROM anggota
                LEFT OUTER JOIN pinjaman
                ON (anggota.id = pinjaman.idAnggota)
                WHERE pinjaman.idAnggota IS NULL OR pinjaman.statusPinjaman = 'Lunas'
            ");
        }

        $code = 'P';
        $last = DB::table('pinjaman')
                ->where('kode', 'like', '%'.$code.'%')
                ->max('kode');

        if($last == null)
        {
            $kodePinjaman = $code.'001';
        } else {
            $new = substr($last,-3);
            $new +=1;
            $kodePinjaman = $code.sprintf("%03d", $new);
        }

        return view('admin/pinjaman.create',[
            'anggota' => $selectAnggota,
            'pinjaman' => $kodePinjaman,
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
            'idAnggota.required' => 'Nama anggota tidak boleh kosong!',
            'tanggal.required' => 'Tanggal pinjaman tidak boleh kosong!',
            'jaminan.required' => 'Syarat tidak boleh kosong!',
            'jumlah.required' => 'Jumlah pinjaman tidak boleh kosong!'
        );

        $validate = $request->validate([
            'idAnggota'=> 'required',
            'tanggal' => 'required',
            'jaminan' => 'required',
            'jumlah' => 'required'
        ],$messages);

        $data = [
            'kode'=> $request->kode,
            'idAnggota' => $request->idAnggota,
            'tanggal' => $request->tanggal,
            'jaminan' => $request->jaminan,
            'jumlah' => $request->jumlah,
            'statusPinjaman' => "Belum Lunas"
        ];

        $insertData = Pinjaman::create($data);

        if($insertData){
            return redirect('admin/pinjaman')->with('success','Data Berhasil Disimpan');
        }else{
            return redirect('admin/pinjaman.create')->with('error','Data Gagal Disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pinjaman $pinjaman)
    {
        //
    }
}
