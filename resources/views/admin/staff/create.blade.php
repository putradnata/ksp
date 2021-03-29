@extends('layouts.template')

@section('title','KSP')
@section('pageName','Admin')

@section('contentHere')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Admin</h3>

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
            @if ($staff->id != "")
                <form method="POST" action="{{ route('staff.store') }}">
            @else
                <form method="POST" action="{{ route('staff.update', $staff->id) }}">
                    @method('PUT')
            @endif
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Admin</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama admin" value="{{ old('staff', $staff->name) }}">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" value="{{ old('staff', $staff->username) }}">
                </div>
                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" value="{{ old('staff', $staff->email) }}">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <select name="jabatan" class="form-control kp">
                        <option value="" {{( old('staff', $staff->jabatan) == '') ? 'selected' : ''}}>-- Pilih Satu --</option>
                        <option value="K" {{( old('staff', $staff->jabatan) == 'K') ? 'selected' : ''}}>Ketua</option>
                        <option value="A" {{( old('staff', $staff->jabatan) == 'A') ? 'selected' : ''}}>Admin</option>
                    </select>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
    </div>
    <!-- /.card-body -->
</div>
@endsection
