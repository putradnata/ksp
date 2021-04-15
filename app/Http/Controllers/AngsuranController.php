<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AngsuranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $selectPinjaman = Pinjaman::select('kode as kodeP', 'jumlah')->get();

        $dataAngsuran = DB::table('angsuran')
                        ->join('pinjaman', 'angsuran.kodePinjaman','pinjaman.kode')
                        ->join('anggota', 'anggota.id','pinjaman.idAnggota')
                        ->select('angsuran.*','anggota.id as idAnggota','anggota.nama as namaAnggota')
                        ->get();

        return view('admin/angsuran.index', compact('selectPinjaman','dataAngsuran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selectPinjaman = DB::table('pinjaman')
            ->join('anggota', 'pinjaman.idAnggota', '=', 'anggota.id')
            ->select('pinjaman.*','anggota.nama as namaAnggota','anggota.id as idAnggota')
            ->where('pinjaman.statusPinjaman','Belum Lunas')
            ->get();

        $checkerTanggalTempo = DB::select("
            SELECT
                kodePinjaman,
                MAX(tanggalTempo) as tanggalTempo,
                MAX(tanggalBayar) as tanggalBayar,
                MAX(pembayaranKe) as pembayaranKe
            FROM `angsuran`
            GROUP BY kodePinjaman
        ");

        $checkerSisaHutang = DB::select("
            SELECT
                angsuran.kodePinjaman,
                (pinjaman.jumlah - SUM(angsuran.pokok)) as sisaHutang
            FROM `angsuran`
            INNER JOIN pinjaman ON angsuran.kodePinjaman = pinjaman.kode
            GROUP BY angsuran.kodePinjaman
        ");

        $code = 'ASN';
        $last = DB::table('angsuran')
                ->where('kode', 'like', '%'.$code.'%')
                ->max('kode');

        if($last == null)
        {
            $kodeAngsuran = $code.'001';
        } else {
            $new = substr($last,-3);
            $new +=1;
            $kodeAngsuran = $code.sprintf("%03d", $new);
        }

        return view('admin/angsuran.create',[
            'pinjaman' => $selectPinjaman,
            'angsuran' => $kodeAngsuran,
            'dataPinjaman' => $selectPinjaman,
            'dataTanggalTempo' => $checkerTanggalTempo,
            'dataSisaHutang' => $checkerSisaHutang
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
        $request->pokok = intval(preg_replace('/[^0-9]+/', '', $request->pokok), 10);
        $request->denda = intval(preg_replace('/[^0-9]+/', '', $request->denda), 10);
        $request->bunga = intval(preg_replace('/[^0-9]+/', '', $request->bunga), 10);
        $request->jumlah = intval(preg_replace('/[^0-9]+/', '', $request->jumlah), 10);

        $checkerHutang = DB::table('pinjaman')->where('kode', $request->kodePinjaman)->value('jumlah');

        $data = [
            'kode' => $request->kode,
            'kodePinjaman' => $request->kodePinjaman,
            'tanggalBayar' => $request->tanggal,
            'tanggalTempo' => $request->tanggalTempo,
            'pembayaranKe' => $request->pembayaranKe,
            'pokok' => $request->pokok,
            'denda' => $request->denda,
            'bunga' => $request->bunga,
            'jumlah' => $request->jumlah,
        ];

        $insertData = Angsuran::create($data);

        $dataAngsuran = DB::table('angsuran')
        ->where('kodePinjaman', $request->kodePinjaman)
        ->sum('pokok');

        if($checkerHutang == $dataAngsuran){
            $data = [
                'statusPinjaman' => 'Lunas'
            ];

            $updateData = Pinjaman::where('kode', $request->kodePinjaman)
                                ->update($data);
        }

        if($insertData){
            return redirect('admin/angsuran')->with('success','Data Berhasil Disimpan');
        }else{
            return redirect('admin/angsuran.create')->with('error','Data Gagal Disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Angsuran  $angsuran
     * @return \Illuminate\Http\Response
     */
    public function show(Angsuran $angsuran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Angsuran  $angsuran
     * @return \Illuminate\Http\Response
     */
    public function edit(Angsuran $angsuran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Angsuran  $angsuran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Angsuran $angsuran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Angsuran  $angsuran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Angsuran $angsuran)
    {
        //
    }
}
