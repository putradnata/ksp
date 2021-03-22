@extends('layouts.template')

@section('title','KSP')
@section('pageName','Akun')

@section('contentHere')
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
        @if ($errors->any())
            <div class="alert alert-danger errorAlert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('akun.store') }}">
            @csrf
            <div class="form-group">
                <label for="noAkun">No Akun</label>
                <input type="number" class="form-control" id="noAkun" name="noAkun" placeholder="Enter Akun Number">
            </div>
            <div class="form-group">
                <label for="nama">Nama Akun</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Akun Name">
            </div>
            <div class="form-group">
                <label for="tipe">Tipe Akun</label>
                <select name="tipe" class="form-control">
                    <option value="">-- Pilih Satu --</option>
                    <optgroup label="Aktiva">
                        <option value="Aktiva Lancar">Aktiva Lancar</option>
                        <option value="Aktiva Tetap">Aktiva Tetap</option>
                    </optgroup>
                    <optgroup label="Pasiva">
                        <option value="Kewajiban">Kewajiban</option>
                        <option value="Modal Sendiri">Modal Sendiri</option>
                    </optgroup>
                    <option value="Pendapatan">Pendapatan</option>
                    <option value="Beban">Beban</option>
                </select>
            </div>
            <div class="form-group">
                <label for="saldo">Saldo</label>
                <input type="number" class="form-control" id="saldo" name="saldo" placeholder="Enter Saldo Amount">
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>
@endsection
