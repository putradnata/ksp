<?php

namespace App\Http\Controllers;

use App\Models\SimpananPokok;
use Illuminate\Http\Request;
use DB;

class SimpananPokokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataSimpananPokok = DB::table('simpanan_pokok')
                                ->join('anggota', 'simpanan_pokok.idAnggota', '=', 'anggota.id')
                                ->select('simpanan_pokok.*','anggota.nama as namaAnggota','anggota.id as idAnggota')
                                ->get();

        return view('admin/simpananPokok.index',[
            'simpananPokok' => $dataSimpananPokok
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $simpananPokok = new SimpananPokok();

        $simpananPokok =  (object) $simpananPokok->getDefaultValues();

        $selectAnggota = DB::table('anggota')
                            ->select('id','nama')
                            ->get();

        $code = 'SP';
        $last = DB::table('simpanan_pokok')
                ->where('kode', 'like', '%'.$code.'%')
                ->max('kode');

        if($last == null)
        {
            $kodeSimpananPokok = $code.'001';
        } else {
            $new = substr($last,-3);
            $new +=1;
            $kodeSimpananPokok = $code.sprintf("%03d", $new);
        }

        return view('admin/simpananPokok.create',[
            'anggota' => $selectAnggota,
            'simpananPokok' => $kodeSimpananPokok,
            'simpananP' => $simpananPokok
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

        $insertData = SimpananPokok::create($data);

        if($insertData){
            return redirect('admin/simpananPokok')->with('success','Data Berhasil Disimpan');
        }else{
            return redirect('admin/simpananPokok.create')->with('error','Data Gagal Disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SimpananPokok  $simpananPokok
     * @return \Illuminate\Http\Response
     */
    public function show(SimpananPokok $simpananPokok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SimpananPokok  $simpananPokok
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $simpananPokok = "";

        $findSimpananPokok = SimpananPokok::where('kode',$id)->first();

        $selectAnggota = DB::table('anggota')
                            ->select('id','nama')
                            ->get();

        return view('admin/simpananPokok.create',[
            'anggota' => $selectAnggota,
            'simpananPokok' => $simpananPokok,
            'simpananP' => $findSimpananPokok
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SimpananPokok  $simpananPokok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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
            'idAnggota' => $request->idAnggota,
            'syarat' => $request->syarat,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah
        ];

        $updateData = SimpananPokok::where('kode', $id)
                            ->update($data);

        if($updateData){
            return redirect('admin/simpananPokok')->with('success','Data Berhasil Disimpan');
        }else{
            return redirect('admin/simpananPokok.edit')->with('error','Data Gagal Disimpan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SimpananPokok  $simpananPokok
     * @return \Illuminate\Http\Response
     */
    public function destroy(SimpananPokok $simpananPokok)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SimpananPokok  $simpananPokok
     * @return \Illuminate\Http\Response
     */
    public function PrintReport($id)
    {
        $dataSimpananPokok = DB::table('simpanan_pokok')
                                ->join('anggota', 'simpanan_pokok.idAnggota', '=', 'anggota.id')
                                ->select('simpanan_pokok.*','anggota.nama as namaAnggota','anggota.id as idAnggota')
                                ->where('simpanan_pokok.kode',$id)
                                ->first();
        return view('admin/simpananPokok.cetak',[
            'simpananPokok' => $dataSimpananPokok
        ]);
    }
}
