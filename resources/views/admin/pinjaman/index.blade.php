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
                <th>Jumlah</th>
                <th>Status Pinjaman</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($pinjaman as $pj => $pinjaman)
                    <tr>
                        <td>{{ ++$pj }}.</td>
                        <td>{{ $pinjaman->kode }}</td>
                        <td>{{ \Carbon\Carbon::parse($pinjaman->tanggal)->format('d-m-Y') }}</td>
                        <td>({{ $pinjaman->idAnggota }}) {{ $pinjaman->namaAnggota }}</td>
                        <td>@currency($pinjaman->jumlah)</td>
                        <td>{{$pinjaman->statusPinjaman}}</td>
                        <td>
                            <a class="btn btn-sm btn-info light-s" data-toggle="modal" data-id="{{ $pinjaman->kode }}" data-target="#detailModal"><span class="fa fa-eye"></span></a>
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
                <h4 class="modal-title" id="myLargeModalLabel">Detail Pinjaman</h4>
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
        });
    </script>

    <!-- Init Modal -->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#detailModal").on('show.bs.modal', function(e){

                var id = $(e.relatedTarget).data('id');

                $.get('/admin/pinjaman/'+id, function(data){
                    $(".modal-body").html(data);
                });
            });
        });
    </script>
    <!-- End -->
@endsection
