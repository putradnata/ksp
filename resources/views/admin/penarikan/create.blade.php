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
                <label for="idAnggota">Nama Anggota</label>
                <select name="idAnggota" class="form-control ks">
                    <option value="">-- Pilih Satu --</option>
                    @foreach($dataSimpanan as $anggota)
                        <option value="{{$anggota->idAnggota}}">({{$anggota->idAnggota}}){{$anggota->namaAnggota}}</option>
                    @endforeach
                </select>
                <input type="hidden" class="form-control" id="kodeSimpanan" name="kodeSimpanan">
                <input type="hidden" class="form-control" id="kodeTrx" name="kodeTrx">
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Penarikan</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal">
            </div>

            <div class="form-group hd">
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control jml clr" id="jumlah" name="jumlah" placeholder="Masukkan jumlah penarikan">
            </div>
            <div class="form-group hd">
                <label for="saldo">Saldo</label>
                <input type="text" class="form-control" id="saldo" name="saldo" readonly style="border: 0; background-color: transparent;">
            </div>
            <div class="form-group hd">
                <label for="saldoAkhir">Saldo Akhir</label>
                <input type="text" class="form-control clr" id="saldoAkhir" name="saldoAkhir" readonly style="border: 0; background-color: transparent;">
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

        $(document).on('change select', '.ks', function() {
            $('.hd').show(450);
            $('.clr').val("");

            var idAnggota = $('select[name="idAnggota"]').val();

            if(idAnggota != ""){
                var saldoPenarikan = [
                    @foreach($dataSimpanan as $ds)
                    [ "{{$ds->idAnggota}}", "{{$ds->kode}}", "{{$ds->saldo}}", "{{$ds->kodeDetail}}"],
                    @endforeach
                ];

                var arr = saldoPenarikan.filter( function( el ) {
                    return !!~el.indexOf( idAnggota );
                });

                $saldoBaru = convert(arr[0][2]);

                $('input[name="saldo"]').val($saldoBaru);
                $('input[name="kodeSimpanan"]').val(arr[0][1]);
                $('input[name="kodeTrx"]').val(arr[0][3]);
            }else{
                $('.hd').hide(450);
                $('.clr').val("");
            }
        });

        $(document).on('change input', '.jml', function() {
            $saldoAwal = $('input[name="saldo"]').val();
            $jumlah = $('input[name="jumlah"]').val();

            $saldoAwal = convertBack($saldoAwal);
            $saldoAwal = parseInt($saldoAwal);

            if($jumlah > $saldoAwal){
                $('input[name="saldoAkhir"]').val("Saldo tidak mencukupi!");
            }else{
                $jumlah = parseInt($jumlah);
                $totalSaldo = $saldoAwal - $jumlah;
                $totalSaldo = convert($totalSaldo);
                $('input[name="saldoAkhir"]').val($totalSaldo);
            }
        });

    </script>
@endsection
