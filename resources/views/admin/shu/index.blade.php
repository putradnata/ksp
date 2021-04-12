@php
    use \Carbon\Carbon;
@endphp

@extends('layouts.template')

@section('title','KSP')
@section('pageName','Sisa Hasil Usaha')

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
    <div class="card-header">
        <h3 class="card-title">Sisa Hasil Usaha</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-5">
            <form class="form-inline form-horizontal" method="POST" action="{{ route('sisaHasilUsaha.shu-dateBased') }}">
                @csrf
                <div class="form-group mr-3">
                    <label class="mr-3">Dari Tanggal</label>
                    <input type="date" name="dariTanggal" required>
                </div>
                <div class="form-group mr-3">
                    <label class="mr-3">Sampai Tanggal</label>
                    <input type="date" name="sampaiTanggal" required>
                </div>

                <span class="tsb btn btn-success mr-4">
                    <i class="fas fa-search"></i> <input type="submit" name="cari" value="Cari">
                </span>

                <span class="tsb btn btn-primary mr-4">
                    <i class="fas fa-print"></i> <input type="submit" name="cetak" value="Cetak">
                </span>

            </form>
        </div>
    </div>
</div>

<div class="card">
    <div class="row">
        <div class="col-12 text-center">
            <img class="kop-koperasi" src="{{ asset('images/kop-ksp.png') }}" >
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center result-shu">
            <table class="shu text-left table table-borderless">
                <thead>
                    <tr>
                        <td colspan="2" class="text-center"><strong>Periode : {{ $dariTanggal.' - '.$sampaiTanggal }}</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Pendapatan</strong></td>
                    </tr>
                    @php
                        $totalPendapatan = 0;
                        $totalBeban = 0;
                    @endphp

                    @foreach ($filter as $shu)
                        @if ($shu->tipeAkun == 'Pendapatan')
                            <tr>
                                <td>{{ $shu->namaAkun }}</td>
                                <td>@currency($shu->jumlah)</td>
                            </tr>
                            @php
                                $totalPendapatan+=$shu->jumlah;
                            @endphp
                        @endif
                    @endforeach
                    <tr>
                        <td><strong>Total Pendapatan</strong></td>
                        <td>@currency($totalPendapatan)</td>
                    </tr>

                    <tr>
                        <td><strong>Beban</strong></td>
                    </tr>
                    @foreach ($filter as $shu)
                        @if ($shu->tipeAkun == 'Beban')
                            <tr>
                                <td>{{ $shu->namaAkun }}</td>
                                <td>@currency($shu->jumlah)</td>
                            </tr>
                            @php
                                    $totalBeban+=$shu->jumlah;
                            @endphp
                        @endif
                    @endforeach
                    <tr>
                        <td><strong>Total Beban</strong></td>
                        <td>@currency($totalBeban)</td>
                    </tr>

                </tbody>
                <tfoot style="border-top:solid 4px">
                    <td><strong>Total SHU</strong></td>
                    <td>@currency($totalPendapatan - $totalBeban)</td>
                </tfoot>
            </table>
        </div>
    </div>

</div>
@endsection
