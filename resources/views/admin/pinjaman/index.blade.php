@extends('layouts.template')

@section('title','KSP')
@section('pageName','Pinjaman')

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
        <h3 class="card-title">Data Pinjaman</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <a class="btn btn-primary" id="tambahButton" href="{{ route('pinjaman.create') }}"> <i class="fa fa-book"></i> Tambah Pinjaman </a>
        <table class="table table-stripped" id="tabelData">
            <thead>
                <th>No. </th>
                <th>Kode Pinjaman </th>
                <th>Tanggal</th>
                <th>Nama Anggota</th>
                <th>Jaminan</th>
                <th>Jumlah</th>
                {{-- <th>Aksi</th> --}}
            </thead>
            <tbody>
                @foreach ($pinjaman as $pj => $pinjaman)
                    <tr>
                        <td>{{ ++$pj }}.</td>
                        <td>{{ $pinjaman->kode }}</td>
                        <td>{{ \Carbon\Carbon::parse($pinjaman->tanggal)->format('d-m-Y') }}</td>
                        <td>({{ $pinjaman->idAnggota }}) {{ $pinjaman->namaAnggota }}</td>
                        <td>{{ $pinjaman->jaminan }}</td>
                        <td>@currency($pinjaman->jumlah)</td>
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
