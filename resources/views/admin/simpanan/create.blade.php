@extends('layouts.template')

@section('title','KSP')
@section('pageName','Simpanan')

@section('contentHere')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Simpanan</h3>

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
        <form method="POST" action="{{ route('simpanan.store') }}">
            @csrf
            <div class="form-group">
                <label for="kode">Kode Simpanan</label>
                <label class="form-control" style="border: 0; font-weight: normal;">{{$simpanan}}</label>
                <input type="hidden" class="form-control" id="kode" name="kode" value="{{$simpanan}}">
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Penyimpanan</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal">
            </div>
            <div class="form-group">
                <label for="idAnggota">Nama Anggota</label>
                <select name="idAnggota" class="form-control">
                    <option value="">-- Pilih Satu --</option>
                    @foreach($anggota as $anggota)
                        <option value="{{$anggota->id}}">{{$anggota->id}} / {{$anggota->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="text" class="form-control uang" id="jumlah" name="jumlah" placeholder="Masukkan jumlah simpanan">
            </div>
            <div class="form-group">
                <label for="bunga">Bunga</label>
                <label class="form-control" style="border: 0; font-weight: normal;">0.3%</label>
                <input type="hidden" class="form-control uang" id="bunga" name="bunga" value="0.3">
            </div>
            <div class="form-group">
                <label for="saldo">Saldo</label>
                <input type="text" class="form-control" id="saldo" name="saldo" placeholder="Masukkan saldo simpanan">
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>
@endsection
