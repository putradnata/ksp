@extends('layouts.template')

@section('title','KSP')
@section('pageName','Anggota')

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
        <h3 class="card-title">Data Anggota</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <a class="btn btn-primary" id="tambahButton" href="{{ route('anggota.create') }}"> <i class="fa fa-book"></i> Tambah Anggota </a>
        <table class="table table-stripped" id="tabelData">
            <thead>
                <th>No. </th>
                <th>Kode Anggota </th>
                <th>Nama Anggota </th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($anggota as $agt => $anggota)
                    <tr>
                        <td>{{ ++$agt }}.</td>
                        <td>{{ $anggota->id }}</td>
                        <td>{{ $anggota->nama }}</td>
                        <td>{{ $anggota->alamat }}</td>
                        @if($anggota->jenisKelamin == "L")
                            <td>Laki-laki</td>
                        @else
                            <td>Perempuan</td>
                        @endif
                        <td>
                            <a class="btn btn-sm btn-info light-s" data-toggle="modal" data-id="{{ $anggota->id }}" data-target="#detailModal"><span class="fa fa-eye"></span></a>
                            <a class="btn btn-sm btn-warning light-s" href="{{ route('anggota.edit', $anggota->id) }}"><span class="fas fa-pencil-alt"></span></a>
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
                <h4 class="modal-title" id="myLargeModalLabel">Detail Anggota</h4>
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

                $.get('/admin/anggota/'+id, function(data){
                    $(".modal-body").html(data);
                });
            });
        });
    </script>
    <!-- End -->
@endsection
