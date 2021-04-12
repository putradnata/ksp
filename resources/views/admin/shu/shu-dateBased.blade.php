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
            <form class="form-inline form-horizontal">
                <div class="form-group mr-3">
                    <label class="mr-3">Dari Tanggal</label>
                    <input type="date" name="dariTanggal">
                </div>
                <div class="form-group mr-3">
                    <label class="mr-3">Sampai Tanggal</label>
                    <input type="date" name="sampaiTanggal">
                </div>
                <button class="btn btn-success" type="submit">
                    <i class="fas fa-search"></i> Cari
                </button>
            </form>
        </div>
    </div>
</div>

<div class="card">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8 text-center">
            <img src="{{ asset('images/kop-ksp.png') }}" >
        </div>
        <div class="col-2"></div>
    </div>
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4 text-center">
            <table class="shu text-left table table-borderless">
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
        <div class="col-4"></div>
    </div>

</div>
@endsection
