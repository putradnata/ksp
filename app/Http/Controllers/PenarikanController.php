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
        $dataPenarikan = DB::table('simpanan')
                                ->join('anggota', 'simpanan.idAnggota', '=', 'anggota.id')
                                ->select('simpanan.kode','anggota.nama as namaAnggota','anggota.id as idAnggota')
                                ->get();

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
            'penarikan' => $kodePenarikan
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
        //
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
