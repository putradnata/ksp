@extends('layouts.template')

@section('title','KSP')
@section('pageName','Pinjaman')

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
        @if ($errors->any())
            <div class="alert alert-danger errorAlert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('pinjaman.store') }}">
            @csrf
            <div class="form-group">
                <label for="kode">Kode Pinjaman</label>
                <input type="text" class="form-control" id="kode" name="kode" value="{{$pinjaman}}" readonly style="border: 0; background-color: transparent;">
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
                <label for="tanggal">Tanggal Pinjaman</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{\Carbon\Carbon::now()->toDateString()}}" readonly style="border: 0; background-color: transparent;">
            </div>
            <div class="form-group">
                <label for="jaminan">Jaminan</label>
                <input type="text" class="form-control" id="jaminan" name="jaminan" placeholder="Masukkan jaminan">
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control jml" id="jumlah" name="jumlah" placeholder="Masukkan jumlah pinjaman">
            </div>
            <div class="form-group hd">
                <label for="administrasi">Biaya Administrasi</label>
                <input type="text" class="form-control" id="administrasi" name="administrasi" readonly style="border: 0; background-color: transparent;">
            </div>
            <div class="form-group hd">
                <label for="materai">Biaya Materai</label>
                <input type="text" class="form-control" id="materai" name="materai" readonly style="border: 0; background-color: transparent;">
            </div>
            <div class="form-group hd">
                <label for="total">Total Akhir</label>
                <input type="text" class="form-control" id="total" name="total" readonly style="border: 0; background-color: transparent;">
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>
@endsection
@section('scriptPlace')
    <script type="text/javascript">
        $('.hd').hide();

        function convert(bilangan){
            var	reverse = bilangan.toString().split('').reverse().join(''),
            ribuan 	= reverse.match(/\d{1,3}/g);
            ribuan	= ribuan.join('.').split('').reverse().join('');

            return ribuan;
        }

        function convertBack(bilangan)
        {
            return parseInt(bilangan.replace(/,.*|[^0-9]/g, ''), 10);
        }

        $biayaMaterai = convert(10000);
        $('input[name="materai"]').val($biayaMaterai);

        $(document).on('change input', '.jml', function() {
            if($('input[name="jumlah"]').val() != null || $('input[name="jumlah"]').val() != 0)
            {
                $('.hd').show(450);

                $jumlah = $('input[name="jumlah"]').val();
                $materai = $('input[name="materai"]').val();
                $materai = convertBack($materai);

                $biayaAdministrasi = $jumlah * (3/100);
                $total = $jumlah - $biayaAdministrasi - $materai;

                $biayaAdministrasi = convert($biayaAdministrasi);
                $total = convert($total);
                $('input[name="administrasi"]').val($biayaAdministrasi);
                $('input[name="total"]').val($total);

            }else{
                $('.hd').hide(450);
            }

        });

    </script>
@endsection
