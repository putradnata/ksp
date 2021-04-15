<?php

namespace App\Http\Controllers;

use App\Models\SukuBunga;
use Illuminate\Http\Request;
use DB;

class SukuBungaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $selectSukuBunga = DB::select('
        SELECT
            anggota.id AS idAnggota,
            anggota.nama AS namaAnggota,
            simpanan.kode,
            detail_simpanan.jumlah,
            detail_simpanan.tanggal
        FROM detail_simpanan
        JOIN simpanan ON simpanan.kode = detail_simpanan.kodeSimpanan
        JOIN anggota ON simpanan.idAnggota = anggota.id
        WHERE detail_simpanan.keterangan = "CRB"
    ');

        return view('admin/sukuBunga.index',[
            'sukuBunga' => $selectSukuBunga
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\SukuBunga  $sukuBunga
     * @return \Illuminate\Http\Response
     */
    public function show(SukuBunga $sukuBunga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SukuBunga  $sukuBunga
     * @return \Illuminate\Http\Response
     */
    public function edit(SukuBunga $sukuBunga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SukuBunga  $sukuBunga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SukuBunga $sukuBunga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SukuBunga  $sukuBunga
     * @return \Illuminate\Http\Response
     */
    public function destroy(SukuBunga $sukuBunga)
    {
        //
    }
}
