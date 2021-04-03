@extends('layouts.template')

@section('title','KSP')
@section('pageName','Anggota')

@section('contentHere')
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
        @if ($errors->any())
            <div class="alert alert-danger errorAlert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
        @if ($idAnggota != "")
            <form method="POST" action="{{ route('anggota.store') }}">
        @else
            <form method="POST" action="{{ route('anggota.update', $anggota->id) }}">
                @method('PUT')
        @endif
            @csrf
            @if ($idAnggota != "")
                <div class="form-group">
                    <label for="id">Kode Anggota</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{$idAnggota}}" readonly style="border: 0; background-color: transparent;">
                </div>
            @else
                <div class="form-group">
                    <label for="id">Kode Anggota</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{$anggota->id}}" readonly style="border: 0; background-color: transparent;">
                </div>
            @endif

            <div class="form-group">
                <label for="nama">Nama Anggota</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama anggota" value="{{ old('anggota', $anggota->nama) }}">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat Anggota</label>
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat anggota" value="{{ old('anggota', $anggota->alamat) }}">
            </div>
            <div class="form-group">
                <label>Jenis Kelamin Anggota</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio2" name="jenisKelamin" value="L" checked {{( old('anggota', $anggota->jenisKelamin) == 'L') ? 'checked' : ''}}>
                    <label for="customRadio2" class="custom-control-label" style="font-weight:normal;">Laki-laki</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio3" name="jenisKelamin" value="P" {{( old('anggota', $anggota->jenisKelamin) == 'P') ? 'checked' : ''}}>
                    <label for="customRadio3" class="custom-control-label" style="font-weight:normal;">Perempuan</label>
                </div>
            </div>
            <div class="form-group">
                <label for="tempatLahir">Tempat Lahir Anggota</label>
                <input type="text" class="form-control" id="tempatLahir" name="tempatLahir" placeholder="Masukkan tempat lahir anggota" value="{{ old('anggota', $anggota->tempatLahir) }}">
            </div>
            <div class="form-group">
                <label for="tanggalLahir">Tanggal Lahir Anggota</label>
                <input type="date" class="form-control" id="tanggalLahir" name="tanggalLahir" value="{{ old('anggota', $anggota->tanggalLahir) }}">
            </div>
            <div class="form-group">
                <label for="pekerjaan">Pekerjaan Anggota</label>
                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Masukkan pekerjaan anggota" value="{{ old('anggota', $anggota->pekerjaan) }}">
            </div>
            @if ($idAnggota == "")
                <div class="form-group">
                    <label for="umur">Umur</label>
                    <input type="text" class="form-control" id="umur" name="umur" placeholder="Masukkan umur anggota" value="{{ old('anggota', $anggota->umur) }}">
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
