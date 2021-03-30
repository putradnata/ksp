@extends('layouts.template')

@section('title','KSP')
@section('pageName','Penarikan')

@section('contentHere')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Penarikan</h3>

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
        <form method="POST" action="{{ route('penarikan.store') }}">
            @csrf
            <div class="form-group">
                <label for="kode">Kode Penarikan</label>
                <label class="form-control" style="border: 0; font-weight: normal;">{{$penarikan}}</label>
                <input type="hidden" class="form-control" id="kode" name="kode" value="{{$penarikan}}">
            </div>
            <div class="form-group">
                <label for="kodeSimpanan">Nama Anggota</label>
                <select name="kodeSimpanan" class="form-control">
                    <option value="">-- Pilih Satu --</option>
                    @foreach($anggota as $anggota)
                        <option value="{{$anggota->kode}}">{{$anggota->kode}} / ({{$anggota->idAnggota}}){{$anggota->namaAnggota}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Penarikan</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal">
            </div>
            <div class="form-group">
                <label for="saldo">Saldo</label>
                <input type="text" class="form-control" id="saldo" name="saldo">
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah simpanan">
            </div>
            <div class="form-group">
                <label for="saldoAkhir">Saldo Akhir</label>
                <input type="text" class="form-control" id="saldoAkhir" name="saldoAkhir">
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>
@endsection
