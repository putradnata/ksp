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
                <input type="text" class="form-control" id="kode" name="kode" value="{{$penarikan}}" readonly style="border: 0; background-color: transparent;">
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Penarikan</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal">
            </div>
            <div class="form-group">
                <label for="idAnggota">Nama Anggota</label>
                <select name="idAnggota" class="form-control ks">
                    <option value="">-- Pilih Satu --</option>
                    @foreach($anggota as $anggota)
                        <option value="{{$anggota->idAnggota}}">({{$anggota->idAnggota}}){{$anggota->namaAnggota}}</option>
                    @endforeach
                </select>
                <input type="hidden" class="form-control" id="kodeSimpanan" name="kodeSimpanan">
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control jml" id="jumlah" name="jumlah" placeholder="Masukkan jumlah penarikan">
            </div>
            <div class="form-group">
                <label for="saldo">Saldo</label>
                <input type="text" class="form-control" id="saldo" name="saldo" readonly style="border: 0; background-color: transparent;">
            </div>
            <div class="form-group">
                <label for="saldoAkhir">Saldo Akhir</label>
                <input type="text" class="form-control" id="saldoAkhir" name="saldoAkhir" readonly style="border: 0; background-color: transparent;">
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
            var idAnggota = $('select[name="idAnggota"]').val();

            if(idAnggota != ""){
                var saldoPenarikan = [
                    @foreach($sisaSaldo as $ss)
                    [ "{{$ss->idAnggota}}", "{{$ss->kodeSimpanan}}", "{{$ss->saldo}}"],
                    @endforeach
                ];

                var arr1 = saldoPenarikan.filter( function( el ) {
                    return !!~el.indexOf( idAnggota );
                });

                var saldoSimpanan = [
                    @foreach($ap as $ap)
                        [ "{{$ap->idAnggota}}", "{{$ap->kode}}", "{{$ap->saldo}}" ],
                    @endforeach
                ];

                var arr2 = saldoSimpanan.filter( function( el ) {
                    return !!~el.indexOf( idAnggota );
                });

                if(arr1 == 0 || arr1[0][1]==arr2[0][1]){
                    var saldoAwal = [
                        @foreach($sisaSaldo as $ss)
                        [ "{{$ss->idAnggota}}", "{{$ss->kodeSimpanan}}", "{{$ss->saldoAkhir}}"],
                        @endforeach
                    ];

                    var arr3 = saldoAwal.filter( function( el ) {
                        return !!~el.indexOf( idAnggota );
                    });

                    if(arr3 == 0 ){
                        var saldoAwal = [
                            @foreach($app as $app)
                                [ "{{$app->idAnggota}}", "{{$app->kode}}", "{{$app->saldo}}" ],
                            @endforeach
                        ];

                        var arr3 = saldoAwal.filter( function( el ) {
                            return !!~el.indexOf( idAnggota );
                        });
                    }
                    console.log("benar");
                    $saldo = convert(arr3[0][2]);
                    $('input[name="saldo"]').val($saldo);
                }else{
                    var saldoPenarikan1 = [
                        @foreach($sisaSaldo2 as $sss)
                        [ "{{$sss->idAnggota}}", "{{$sss->kodeSimpanan}}", "{{$sss->saldoAkhir}}", "{{$sss->jumlah}}"],
                        @endforeach
                    ];

                    var arr4 = saldoPenarikan1.filter( function( el ) {
                        return !!~el.indexOf( idAnggota );
                    });

                    console.log("salah");
                    $saldoBaru = (parseInt(arr2[0][2]) - parseInt(arr4[0][3]))
                    $saldoBaru = convert($saldoBaru);
                    $('input[name="saldo"]').val($saldoBaru);
                }
                $('input[name="kodeSimpanan"]').val(arr2[0][1]);
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
