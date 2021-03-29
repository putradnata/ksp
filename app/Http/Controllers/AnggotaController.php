<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Auth;
use DB;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $selectAnggota = Anggota::all();

        return view('admin/anggota.index',[
            'anggota' => $selectAnggota
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anggota = new Anggota();

        $anggota =  (object) $anggota->getDefaultValues();

        $code = 'A';
        $last = DB::table('anggota')
                ->where('id', 'like', '%'.$code.'%')
                ->max('id');

        if($last == null)
        {
            $idAnggota = $code.'001';
        } else {
            $new = substr($last,-3);
            $new +=1;
            $idAnggota = $code.sprintf("%03d", $new);
        }

        return view('admin/anggota.create',[
            "idAnggota" => $idAnggota,
            "anggota" => $anggota
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
            'id.required' => 'Kode anggota tidak boleh kosong!',
            'nama.required' => 'Nama anggota tidak boleh kosong!',
            'alamat.required' => 'Alamat anggota tidak boleh kosong!',
            'tempatLahir.required' => 'Tempat Lahir anggota tidak boleh kosong!',
            'tanggalLahir.required' => 'Tanggal Lahir anggota tidak boleh kosong!',
            'jenisKelamin.required' => 'Jenis Kelamin anggota pilih satu!',
            'pekerjaan.required' => 'Pekerjaaan anggota tidak boleh kosong!'
        );

        $validate = $request->validate([
            'id'=> 'required',
            'nama'=> 'required',
            'alamat' => 'required',
            'tempatLahir' => 'required',
            'tanggalLahir' => 'required',
            'jenisKelamin' => 'required',
            'pekerjaan' => 'required'
        ],$messages);

        $age = \Carbon\Carbon::parse($request->tanggalLahir)->diff(\Carbon\Carbon::now())->format("%y");

        $data = [
            'id'=> $request->id,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tempatLahir' => $request->tempatLahir,
            'tanggalLahir' => $request->tanggalLahir,
            'jenisKelamin' => $request->jenisKelamin,
            'pekerjaan' => $request->pekerjaan,
            'umur' => $age,
            'idAdmin' => Auth::user()->id
        ];

        $insertData = Anggota::create($data);

        if($insertData){
            return redirect('admin/anggota')->with('success','Data Berhasil Disimpan');
        }else{
            return redirect('admin/anggota.create')->with('error','Data Gagal Disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $selectAnggota = Anggota::where('id',$id)->get();

        return view('admin/anggota.show',['anggota'=>$selectAnggota])->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $idAnggota = "";

        $findAnggota = Anggota::where('id',$id)->first();

        return view('admin/anggota.create',[
            'anggota' => $findAnggota,
            'idAnggota' => $idAnggota
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = array(
            'id.required' => 'Kode anggota tidak boleh kosong!',
            'nama.required' => 'Nama anggota tidak boleh kosong!',
            'alamat.required' => 'Alamat anggota tidak boleh kosong!',
            'tempatLahir.required' => 'Tempat lahir anggota tidak boleh kosong!',
            'tanggalLahir.required' => 'Tanggal lahir anggota tidak boleh kosong!',
            'jenisKelamin.required' => 'Jenis kelamin anggota pilih satu!',
            'pekerjaan.required' => 'Pekerjaaan anggota tidak boleh kosong!',
            'umur.required' => 'Umur anggota tidak boleh kosong!'
        );

        $validate = $request->validate([
            'id'=> 'required',
            'nama'=> 'required',
            'alamat' => 'required',
            'tempatLahir' => 'required',
            'tanggalLahir' => 'required',
            'jenisKelamin' => 'required',
            'pekerjaan' => 'required',
            'umur' => 'required'
        ],$messages);

        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tempatLahir' => $request->tempatLahir,
            'tanggalLahir' => $request->tanggalLahir,
            'jenisKelamin' => $request->jenisKelamin,
            'pekerjaan' => $request->pekerjaan,
            'umur' => $request->umur
        ];

        $insertData = Anggota::where('id', $id)
                            ->update($data);

        if($insertData){
            return redirect('admin/anggota')->with('success','Data Berhasil Disimpan');
        }else{
            return redirect('admin/anggota.edit')->with('error','Data Gagal Disimpan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anggota $anggota)
    {
        //
    }
}
