@extends('layouts.template')

@section('title','KSP')
@section('pageName','Akun')

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
        <h3 class="card-title">Data Akun</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <a class="btn btn-primary" id="tambahButton" href="{{ route('akun.create') }}"> <i class="fa fa-book"></i> Tambah Akun </a>
        <table class="table table-stripped" id="tabelData">
            <thead>
                <th>No. </th>
                <th>No Akun </th>
                <th>Nama Akun</th>
                <th>Tipe Akun</th>
                {{-- <th>Saldo</th> --}}
                {{-- <th>Aksi</th> --}}
            </thead>
            <tbody>
                @foreach ($akun as $akn => $akun)
                    <tr>
                        <td>{{ ++$akn }}.</td>
                        <td>{{ $akun->noAkun }}</td>
                        <td>{{ $akun->nama }}</td>
                        <td>{{ $akun->tipe }}</td>
                        {{-- <td>@currency($akun->saldo)</td> --}}
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

            $(".alert").fadeTo(3000, 500).slideUp(500, function(){
                $(".alert").slideUp(500);
            });
        });
    </script>
@endsection
