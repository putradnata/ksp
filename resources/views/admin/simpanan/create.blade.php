@extends('layouts.template')

@section('title','KSP')
@section('pageName','Simpanan Harian')

@section('contentHere')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Simpanan Harian</h3>

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
                <label for="idAnggota">Nama Anggota</label>
                <select name="idAnggota" class="form-control kr">
                    <option value="">-- Pilih Satu --</option>
                    @foreach($anggota as $anggota)
                        <option value="{{$anggota->id}}">{{$anggota->id}} / {{$anggota->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Penyimpanan</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{\Carbon\Carbon::now()->toDateString()}}" readonly style="border: 0; background-color: transparent;">
            </div>
            <div class="form-group hd">
                <label for="kode" id="labelKode"></label>
                <input type="text" class="form-control" id="kode" name="kode" readonly style="border: 0; background-color: transparent;">
            </div>
            <div class="form-group hd">
                <label for="bunga">Bunga</label>
                <label class="form-control" style="border: 0; font-weight: normal;">0.3%</label>
                <input type="hidden" class="form-control" id="bunga" name="bunga" value="0.3">
            </div>
            <div class="form-group hd">
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah simpanan" pattern="[0-9]>
            </div>
            <div class="card-footer hd">
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

        $(document).on('change select', '.kr', function() {
            var idAnggota = $('select[name="idAnggota"]').val();

            if(idAnggota != ""){
                $('.hd').show(450);

                var rekening = [
                    @foreach($rekeningAnggota as $ra)
                    [ "{{$ra->idAnggota}}", "{{$ra->kode}}"],
                    @endforeach
                ];

                var arr1 = rekening.filter( function( el ) {
                    return !!~el.indexOf( idAnggota );
                });

                if(arr1 == 0 ){
                    var newKode = ["{{$simpanan}}"];
                    $('input[name="kode"]').val(newKode[0]);
                    document.getElementById("labelKode").innerHTML = "Kode Simpanan Harian Baru";
                }else{
                    $('input[name="kode"]').val(arr1[0][1]);
                    document.getElementById("labelKode").innerHTML = "Kode Simpanan Harian Nasabah";
                }
            }else{
                $('.hd').hide(450);
            }
        });
    </script>
@endsection
