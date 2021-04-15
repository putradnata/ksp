@extends('layouts.template')

@section('title','KSP')
@section('pageName','Suku Bunga')

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
        <h3 class="card-title">Data Nasabah Penerima Suku Bunga</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-stripped" id="tabelData">
            <thead>
                <th>No. </th>
                <th>Kode Simpanan</th>
                <th>Nama Anggota</th>
                <th>Tanggal Penerimaan</th>
                <th>Besaran Suku Bunga</th>
                {{-- <th>Aksi</th> --}}
            </thead>
            <tbody>
                @foreach ($sukuBunga as $pk => $sukuBunga)
                    <tr>
                        <td>{{ ++$pk }}.</td>
                        <td>{{ $sukuBunga->kode }}</td>
                        <td>({{ $sukuBunga->idAnggota }}) {{ $sukuBunga->namaAnggota }}</td>
                        <td>{{ \Carbon\Carbon::parse($sukuBunga->tanggal)->format('d-m-Y') }}</td>
                        <td>@currency($sukuBunga->jumlah)</td>
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
