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
        $Staff = new User();

        $selectStaff = User::all();

        return view('admin/staff.index', [
            'staff' => $selectStaff
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
        // dd($request->all());
        $staff = new User();

        $messages = array(
            'nama.required' => 'Nama admin tidak boleh kosong!',
            'username.required' => 'Username tidak boleh kosong!',
            'password.required' => 'Password tidak boleh kosong!'
        );

        $validate = $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required'
        ], $messages);

        $data = [
            'name' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'jabatan' => 'A'
        ];

        $insertData = $staff::create($data);

        if ($insertData) {
            return redirect('admin/akun')->with('success', 'Data Berhasil Disimpan');
        } else {
            return redirect('admin/akun.create')->with('error', 'Data Gagal Disimpan');
        }
    }
}
