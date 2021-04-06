@extends('layouts.template')

@section('title','KSP')
@section('pageName','Simpanan Harian')

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
        <h3 class="card-title">Data Simpanan Harian</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <a class="btn btn-primary" id="tambahButton" href="{{ route('simpanan.create') }}"> <i class="fa fa-book"></i> Tambah Simpanan Harian</a>
        <a class="btn btn-primary" id="tambahButton" href="{{ route('simpanan.bankRates') }}"> <i class="fa fa-book"></i> Update Bunga</a>
        <table class="table table-stripped" id="tabelData">
            <thead>
                <th>No. </th>
                <th>Kode Simpanan Harian</th>
                <th>Tanggal</th>
                <th>Nama Anggota</th>
                <th>Jumlah</th>
                <th>Bunga (%)</th>
                <th>Saldo</th>
                {{-- <th>Aksi</th> --}}
            </thead>
            <tbody>
                @foreach ($simpanan as $sp => $simpanan)
                    <tr>
                        <td>{{ ++$sp }}.</td>
                        <td>{{ $simpanan->kode }}</td>
                        <td>{{ \Carbon\Carbon::parse($simpanan->tanggal)->format('d-m-Y') }}</td>
                        <td>({{ $simpanan->idAnggota }}) {{ $simpanan->namaAnggota }}</td>
                        <td>@currency($simpanan->jumlah)</td>
                        <td>{{ $simpanan->bunga }}</td>
                        <td>@currency($simpanan->saldo)</td>
                        {{-- <td>
                            <a class="btn btn-sm btn-info light-s" data-toggle="modal" data-id="#" data-target="#"><span class="fa fa-eye"></span></a>
                            <a class="btn btn-sm btn-warning light-s" href="#"><span class="fas fa-pencil-alt"></span></a>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scriptPlace')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tabelData').DataTable();
        });
    </script>
@endsection
