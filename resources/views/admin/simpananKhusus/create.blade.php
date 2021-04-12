@extends('layouts.template')

@section('title','KSP')
@section('pageName','Simpanan Khusus')

@section('contentHere')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Simpanan Khusus</h3>

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
        @if ($simpananKhusus != "")
            <form method="POST" action="{{ route('simpananKhusus.store') }}">
        @else
            <form method="POST" action="{{ route('simpananKhusus.update', $simpananK->kode) }}">
                @method('PUT')
        @endif
            @csrf
            @if ($simpananKhusus != "")
            <div class="form-group">
                <label for="kode">Kode Simpanan Khusus</label>
                <input type="text" class="form-control" id="kode" name="kode" value="{{$simpananKhusus}}" readonly style="border: 0; background-color: transparent;">
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
                <label for="tanggal">Tanggal Penyimpanan</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal">
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah simpanan">
            </div>
            @else
            <div class="form-group">
                <label for="kode">Kode Simpanan Khusus</label>
                <input type="text" class="form-control" id="kode" name="kode" value="{{$simpananK->kode}}" readonly style="border: 0; background-color: transparent;">
            </div>
            <div class="form-group">
                <label for="idAnggota">Nama Anggota</label>
                <select name="idAnggota" class="form-control" disabled>
                    <option value="">-- Pilih Satu --</option>
                    @foreach($anggota as $anggota)
                        <option value="{{$anggota->id}}" {{( old('simpananK', $simpananK->idAnggota) == $anggota->id) ? 'selected' : ''}}>{{$anggota->id}} / {{$anggota->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Penyimpanan</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('simpananK', $simpananK->tanggal) }}">
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah simpanan" value="{{ old('simpananK', $simpananK->jumlah) }}" readonly style="border: 0; background-color: transparent;">
            </div>
            @endif
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>
@endsection
