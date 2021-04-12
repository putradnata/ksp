<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin()
    {
        $cDataSimpanan = DB::table('simpanan')
                        ->count();
        $cDataPinjaman = DB::table('pinjaman')
                        ->count();
        $cDataAnggota = DB::table('anggota')
                        ->count();
        $cDataAdmin = DB::table('users')
                        ->where('jabatan','A')
                        ->count();

        $anggotaBaru = [];
        $bulan_a = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"];

        $anggotaBaru[0]['name'] = 'Anggota Baru';

        foreach ($bulan_a as $key => $bulan) {
            $anggota = DB::table('anggota')
                ->whereMonth('anggota.created_at', $bulan)
                ->whereYear('anggota.created_at', 2021)
                ->count();

                if (@$anggota != null) {
                    $anggotaBaru[0]['data'][$key] = $anggota;
                } else {
                    $anggotaBaru[0]['data'][$key]  = 0;
                }
        }

        return view('admin/index', compact('cDataSimpanan','cDataPinjaman','cDataAnggota','cDataAdmin','anggotaBaru'));
    }
}
