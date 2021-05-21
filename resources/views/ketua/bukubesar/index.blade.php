@php
    use \Carbon\Carbon;
@endphp

@extends('layouts.template')

@section('title','KSP')
@section('pageName','Buku Besar')

@section('customStyle')
    <style>
        #tambahButton {
            margin: 0 0 2% 0;
        }

        span.tsb > input {
            background: none;
            color: white;
            border: 0;
            padding: 0;
        }

        @media print{
            .hide{
                display:none;
            }

            .kop-koperasi{
                display: block !important;
                margin-bottom:40px;
                margin-top:-120px !important;
            }
        }

        .kop-koperasi{
            display: none;
        }

        @media screen and (min-width:768px){
            .col-12.text-center.result-shu {
                padding: 0 32em;
            }
        }

        @media screen and (max-width:767px){
            .kop-koperasi{
                width: 100%;
            }

            .col-12.text-center.result-shu {
                padding: 0 3em;
            }
        }
    </style>
@endsection

@section('contentHere')
<div class="card">
    <div class="card-header hide">
        <h3 class="card-title">Buku Besar</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-5 hide">
            <form class="form-horizontal" method="POST" action="{{ route('bukuBesar.show') }}" id="bookform">
                @csrf
                <div class="form-inline">
                    <div class="form-group mr-3">
                        <label class="mr-3">Akun</label>
                        <select class="form-control" name="akun" id="akun">
                            @foreach ($akun as $ak)
                                <option value="{{ $ak->noAkun }}">{{ $ak->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mr-3">
                        <label class="mr-3">Dari Tanggal</label>
                        <input type="date" class="form-control" name="dariTanggal" id="dariTanggal" required>
                    </div>
                    <div class="form-group mr-3">
                        <label class="mr-3">Sampai Tanggal</label>
                        <input type="date" class="form-control" name="sampaiTanggal" id="sampaiTanggal" required>
                    </div>
                </div>
                <div class="mt-4 mb-0 ml-5">
                    <button type="submit" class="btn btn-success mr-4 cari"><i class="fas fa-search"></i> Cari</button>

                    <button type="button" class="btn btn-primary mr-4" onclick="window.print()"><i class="fas fa-print"></i> Cetak</button>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <center>
                <img class="kop-koperasi" src="{{ asset('images/kop-ksp.png') }}" >
        </center>
        <table class="table table-stripped table-responsive-sm" id="tabelData">
            <thead>
                <th>Tanggal</th>
                <th>Kode Jurnal</th>
                <th>Akun</th>
                <th>Keterangan</th>
                <th>Debet</th>
                <th>Kredit</th>
                <th>Saldo</th>
            </thead>
            <tbody id="tbody">
                @if (@isset($accountActivities))
                    @if ($accountActivities->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">Tidak Ada Data Ditemukan</td>
                        </tr>
                    @endif
                    @php
                    $saldo = 0;
                    @endphp
                    {{-- @foreach ($showSaldoAwal as $showSaldoAwal)
                    <tr>
                        <td>&ensp;</td>
                        <td>&ensp;</td>
                        <td>{{ $showSaldoAwal->namaAkun }}</td>
                        <td>Saldo awal</td>
                        <td>&ensp;</td>
                        <td>&ensp;</td>
                        @php
                            $saldo += $showSaldoAwal->saldoAwal;
                        @endphp
                        <td>@currency($saldo)</td>
                    </tr>
                    @endforeach --}}
                    @foreach ($accountActivities as $accountActivity)
                    <tr>
                        <td>{{ $accountActivity->Tanggal }}</td>
                        <td>{{ $accountActivity->NoTransaksi }}</td>
                        <td>{{ $accountActivity->Akun }}</td>
                        <td>{{ $accountActivity->Keterangan }}</td>
                        @php
                            // Aktiva
                            if(
                                $accountActivity->Tipe == 'Aktiva Lancar' ||
                                $accountActivity->Tipe == 'Aktiva Tetap' ||
                                $accountActivity->Tipe == 'Harta Tak Berwujud' ||
                                $accountActivity->Tipe == 'Beban'
                            ) {
                                if($accountActivity->Posisi == 'DEBIT'){
                                    $saldo += $accountActivity->JumlahTransaksi;
                                    echo "<td>Rp.".number_format($accountActivity->JumlahTransaksi, 0,",",".")."</td>";
                                    echo "<td> - </td>";
                                }

                                if($accountActivity->Posisi == 'KREDIT'){
                                    $saldo -= $accountActivity->JumlahTransaksi;
                                    echo "<td> - </td>";
                                    echo "<td>Rp.".number_format($accountActivity->JumlahTransaksi, 0,",",".")."</td>";
                                }
                            }

                            // Pasiva
                            if(
                                $accountActivity->Tipe == 'Kewajiban' ||
                                $accountActivity->Tipe == 'Ekuitas' ||
                                $accountActivity->Tipe == 'Pendapatan'
                            ) {
                                if($accountActivity->Posisi == 'DEBIT'){
                                    $saldo -= $accountActivity->JumlahTransaksi;
                                    echo "<td>Rp.".number_format($accountActivity->JumlahTransaksi, 0,",",".")."</td>";
                                    echo "<td> - </td>";
                                }

                                if($accountActivity->Posisi == 'KREDIT'){
                                    $saldo += $accountActivity->JumlahTransaksi;
                                    echo "<td> - </td>";
                                    echo "<td>Rp.".number_format($accountActivity->JumlahTransaksi, 0,",",".")."</td>";
                                }
                            }
                        @endphp

                        <td>@currency($saldo)</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>
</div>
@endsection
