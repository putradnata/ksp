<?php

namespace App\Http\Controllers;

use App\Models\SimpananWajib;
use Illuminate\Http\Request;
use DB;

class SimpananWajibController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataSimpananWajib = DB::table('simpanan_wajib')
                                ->join('anggota', 'simpanan_wajib.idAnggota', '=', 'anggota.id')
                                ->select('simpanan_wajib.*','anggota.nama as namaAnggota','anggota.id as idAnggota')
                                ->get();

        return view('admin/simpananWajib.index',[
            'simpananWajib' => $dataSimpananWajib
        ]);
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

        $code = 'SPW';
        $last = DB::table('simpanan_wajib')
                ->where('kode', 'like', '%'.$code.'%')
                ->max('kode');

        if($last == null)
        {
            $kodeSimpananWajib = $code.'001';
        } else {
            $new = substr($last,-3);
            $new +=1;
            $kodeSimpananWajib = $code.sprintf("%03d", $new);
        }

        return view('admin/simpananWajib.create',[
            'anggota' => $selectAnggota,
            'simpananWajib' => $kodeSimpananWajib
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
        $simpananWajib = new SimpananWajib();

        $messages = array(
            'tanggal.required' => 'Tanggal simpanan tidak boleh kosong!',
            'idAnggota.required' => 'Nama anggota tidak boleh kosong!',
            'syarat.required' => 'Syarat tidak boleh kosong!',
            'jumlah.required' => 'Jumlah simpanan tidak boleh kosong!'
        );

        $validate = $request->validate([
            'tanggal' => 'required',
            'idAnggota'=> 'required',
            'syarat' => 'required',
            'jumlah' => 'required'
        ],$messages);

        $data = [
            'kode'=> $request->kode,
            'idAnggota' => $request->idAnggota,
            'syarat' => $request->syarat,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah
        ];

        $insertData = $simpananWajib::create($data);

        if($insertData){
            return redirect('admin/simpananWajib')->with('success','Data Berhasil Disimpan');
        }else{
            return redirect('admin/simpananWajib.create')->with('error','Data Gagal Disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SimpananWajib  $simpananWajib
     * @return \Illuminate\Http\Response
     */
    public function show(SimpananWajib $simpananWajib)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SimpananWajib  $simpananWajib
     * @return \Illuminate\Http\Response
     */
    public function edit(SimpananWajib $simpananWajib)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SimpananWajib  $simpananWajib
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SimpananWajib $simpananWajib)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SimpananWajib  $simpananWajib
     * @return \Illuminate\Http\Response
     */
    public function destroy(SimpananWajib $simpananWajib)
    {
        //
    }
}
