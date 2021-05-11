@extends('layouts.template')

@section('title','KSP')
@section('pageName','Simpanan Pokok')

@section('customStyle')
    <style>
        #tambahButton {
            margin: 0 0 2% 0;
        }
    </style>
@endsection

@section('contentHere')
@if (Session::has('success'))
    <div class="alert alert-success" style="margin-bottom: 20px;">
        {{ Session::get('success') }}
    </div>
@endif
@if (Session::has('error'))
    <div class="alert alert-danger" style="margin-bottom: 20px;">
        {{ Session::get('error') }}
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Simpanan Pokok</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <a class="btn btn-primary" id="tambahButton" href="{{ route('simpananPokok.create') }}"> <i class="fa fa-book"></i> Tambah Simpanan Pokok </a>
        <table class="table table-stripped" id="tabelData">
            <thead>
                <th>No. </th>
                <th>Kode Simpanan Pokok </th>
                <th>Tanggal</th>
                <th>Nama Anggota</th>
                <th>Syarat</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($simpananPokok as $spp => $simpananPokok)
                    <tr>
                        <td>{{ ++$spp }}.</td>
                        <td>{{ $simpananPokok->kode }}</td>
                        <td>{{ \Carbon\Carbon::parse($simpananPokok->tanggal)->format('d-m-Y') }}</td>
                        <td>({{ $simpananPokok->idAnggota }}) {{ $simpananPokok->namaAnggota }}</td>
                        <td>{{ $simpananPokok->syarat }}</td>
                        <td>@currency($simpananPokok->jumlah)</td>
                        <td>
                            {{-- <a class="btn btn-sm btn-warning light-s" href="{{ route('simpananPokok.edit', $simpananPokok->kode) }}"><span class="fas fa-pencil-alt"></span></a> --}}
                            <a class="btn btn-sm btn-primary light-s" href="{{ route('simpananPokok.report', $simpananPokok->kode) }}" target="blank"><span class="fas fa-print"></span></a>
                        </td>
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

            $(".alert").fadeTo(3000, 500).slideUp(500, function(){
                $(".alert").slideUp(500);
            });
        });
    </script>
@endsection
