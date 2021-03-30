<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $selectStaff = User::all();

        return view('admin/staff.index', [
            'staff' => $selectStaff
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();

        $user =  (object) $user->getDefaultValues();

        return view('admin/staff.create',[
            "staff" => $user
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
            'nama.required' => 'Nama admin tidak boleh kosong!',
            'username.required' => 'Username tidak boleh kosong!',
            'email.required' => 'Email tidak boleh kosong!',
            'password.required' => 'Password tidak boleh kosong!',
            'jabatan.required' => 'Jabatan tidak boleh kosong!'
        );

        $validate = $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'jabatan' => 'required'
        ], $messages);

        $data = [
            'name' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jabatan' => $request->jabatan
        ];

        $insertData = User::create($data);

        if ($insertData) {
            return redirect('admin/staff')->with('success', 'Data Berhasil Disimpan');
        } else {
            return redirect('admin/staff.create')->with('error', 'Data Gagal Disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $selectStaff = User::where('id',$id)->get();

        return view('admin/staff.show',['staff'=>$selectStaff])->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $findStaff = User::where('id',$id)->first();

        return view('admin/staff.create',[
            'staff' => $findStaff
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = array(
            'nama.required' => 'Nama admin tidak boleh kosong!',
            'username.required' => 'Username tidak boleh kosong!',
            'email.required' => 'Email tidak boleh kosong!',
            'jabatan.required' => 'Jabatan tidak boleh kosong!'
        );

        $validate = $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'email' => 'required',
            'jabatan' => 'required'
        ], $messages);

        if($request->password != null){
            $data = [
                'name' => $request->nama,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'jabatan' => $request->jabatan
            ];
        }else{
            $data = [
                'name' => $request->nama,
                'username' => $request->username,
                'email' => $request->email,
                'jabatan' => $request->jabatan
            ];
        }

        $insertData = User::where('id', $id)
                            ->update($data);

        if($insertData){
            return redirect('admin/staff')->with('success','Data Berhasil Disimpan');
        }else{
            return redirect('admin/staff.edit')->with('error','Data Gagal Disimpan');
        }
    }
}
