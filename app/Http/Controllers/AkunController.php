<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $akun = new Akun();

        $selectAkun = Akun::all();

        return view('admin/akun.index',[
            'akun' => $selectAkun
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/akun.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $akun = new Akun();

        $messages = array(
            'noAkun.required' => 'No Akun tidak boleh kosong!',
            'nama.required' => 'Nama Akun tidak boleh kosong!',
            'tipe.required' => 'Tipe Akun tidak boleh kosong!',
            'saldo.required' => 'Saldo tidak boleh kosong!'
        );

        $validate = $request->validate([
            'noAkun'=> 'required',
            'nama' => 'required',
            'tipe' => 'required',
            'saldo' => 'required'
        ],$messages);

        $data = [
            'noAkun' => $request->noAkun,
            'nama' => $request->nama,
            'tipe' => $request->tipe,
            'saldo' => $request->saldo
        ];

        $insertData = $akun::create($data);

        if($insertData){
            return redirect('admin/akun')->with('success','Data Berhasil Disimpan');
        }else{
            return redirect('admin/akun.create')->with('error','Data Gagal Disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function show(Akun $akun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function edit(Akun $akun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Akun $akun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Akun  $akun
     * @return \Illuminate\Http\Response
     */
    public function destroy(Akun $akun)
    {
        //
    }
}
