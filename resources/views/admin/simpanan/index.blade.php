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
        <a class="btn btn-primary" id="tambahButton" href="{{ route('simpanan.create') }}"> <i class="fa fa-book"></i> Tambah Simpanan Harian </a>
        <a class="btn btn-primary" id="tambahButton" href="{{ route('penarikan.create') }}"> <i class="fa fa-book"></i> Tambah Penarikan </a>
        @if ($checkerSukuBunga == 0)
            <a class="btn btn-primary" id="tambahButton" href="{{ route('simpanan.bankRates') }}"> <i class="fa fa-book"></i> Update Bunga </a>
        @endif
        <table class="table table-stripped" id="tabelData">
            <thead>
                <th>No. </th>
                <th>Kode Simpanan Harian</th>
                <th>Tanggal</th>
                <th>Nama Anggota</th>
                <th>Saldo</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($simpanan as $sp => $simpanan)
                    <tr>
                        <td>{{ ++$sp }}.</td>
                        <td>{{ $simpanan->kode }}</td>
                        <td>{{ \Carbon\Carbon::parse($simpanan->tanggal)->format('d-m-Y') }}</td>
                        <td>({{ $simpanan->idAnggota }}) {{ $simpanan->namaAnggota }}</td>
                        <td>@currency($simpanan->saldo)</td>
                        <td>
                            <a class="btn btn-sm btn-info light-s" data-toggle="modal" data-id="{{ $simpanan->kode }}" data-name="({{ $simpanan->idAnggota }}) {{ $simpanan->namaAnggota }}" data-target="#detailModal"><span class="fa fa-eye"></span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Detail Simpanan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
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

    <!-- Init Modal -->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#detailModal").on('show.bs.modal', function(e){

                var id = $(e.relatedTarget).data('id');
                var name = $(e.relatedTarget).data('name');

                $.get('/admin/simpanan/'+id, function(data){
                    $('.modal-body').append(
                    '<table class="table table-stripped">'+
                        '<tr>'+
                            '<th style="border:0; width:140px;">Nama Anggota</th>'+
                            '<th style="border:0; width:7px;">:</th>'+
                            '<th style="border:0;">'+name+'</th>'+
                        '</tr>'+
                        '<tr>'+
                            '<th style="border:0;">Kode Simpanan</th>'+
                            '<th style="border:0;">:</th>'+
                            '<th style="border:0;">'+id+'</th>'+
                        '</tr>'+
                    '<table class="table datatable" id="dataTables-example">'+
                    '<thead>'+
                        '<tr>'+
                            '<th>No. </th>'+
                            '<th>Kode Transaksi</th>'+
                            '<th>Tanggal</th>'+
                            '<th>Jumlah</th>'+
                            '<th>Saldo</th>'+
                            '<th>Keterangan</th>'+
                        '</tr>'+
                    '</thead>'+
                    '<tbody>'+
                        data+
                    '</tbody>'+
                    '</table>');
                    $('#dataTables-example').DataTable();
                });
            });

            $("#detailModal").on("hidden.bs.modal", function(){
                $(".modal-body").html("");
            });
        });
    </script>
    <!-- End -->
@endsection
