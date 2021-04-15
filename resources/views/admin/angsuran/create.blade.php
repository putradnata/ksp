@extends('layouts.template')

@section('title','KSP')
@section('pageName','Angsuran')

@section('contentHere')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Angsuran</h3>

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
        <form method="POST" action="{{ route('angsuran.store') }}">
            @csrf
            <div class="form-group">
                <label for="kode">Kode Angsuran</label>
                <input type="text" class="form-control" id="kode" name="kode" value="{{$angsuran}}" readonly style="border: 0; background-color: transparent;">
            </div>
            <div class="form-group">
                <label for="kodePinjaman">Kode Pinjaman</label>
                <select name="kodePinjaman" class="form-control kp">
                    <option value="">-- Pilih Satu --</option>
                    @foreach($pinjaman as $pinjaman)
                        <option value="{{$pinjaman->kode}}">{{$pinjaman->kode}} / {{$pinjaman->idAnggota}} / {{$pinjaman->namaAnggota}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Pembayaran</label>
                <input type="date" class="form-control tp" id="tanggal" name="tanggal" onkeydown="return false">
            </div>
            <div class="form-group hde">
                <label for="tanggalTempo">Tanggal Jatuh Tempo</label>
                <input type="date" class="form-control" id="tanggalTempo" name="tanggalTempo" readonly style="border: 0; background-color: transparent;">
            </div>
            <div class="form-group hde">
                <label for="pembayaranKe">Pembayaran-Ke</label>
                <input type="text" class="form-control" id="pembayaranKe" name="pembayaranKe" readonly style="border: 0; background-color: transparent;">
            </div>
            <div class="form-group hde">
                <label for="pokok">Pokok</label>
                <input type="text" class="form-control" id="pokok" name="pokok" readonly style="border: 0; background-color: transparent;">
            </div>
            <div class="form-group hde">
                <label for="bunga">Bunga</label>
                <input type="text" class="form-control" id="bunga" name="bunga" readonly style="border: 0; background-color: transparent;">
            </div>
            <div class="form-group hde">
                <label for="denda">Denda</label>
                <input type="text" class="form-control" id="denda" name="denda" readonly style="border: 0; background-color: transparent;">
            </div>
            <div class="form-group hde">
                <label for="jumlah">Jumlah Tagihan</label>
                <input type="text" class="form-control" id="jumlah" name="jumlah" readonly style="border: 0; background-color: transparent;">
            </div>
            <div class="card-footer hde">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>
@endsection

@section('scriptPlace')
    <script type="text/javascript">
        $('.hde').hide();

        function convert(bilangan){
            var	reverse = bilangan.toString().split('').reverse().join(''),
            ribuan 	= reverse.match(/\d{1,3}/g);
            ribuan	= ribuan.join('.').split('').reverse().join('');

            return ribuan;
        }

        function angsuran(){
            var kodePinjaman = $('select[name="kodePinjaman"]').val();

            if((kodePinjaman != "") && ($('input[name="tanggal"]').val() != "")){
                $('.hde').show(450);
                var totalPinjaman = [
                    @foreach($dataPinjaman as $dp)
                    [ "{{$dp->kode}}", "{{$dp->jumlah}}" ],
                    @endforeach
                ];

                var arr = totalPinjaman.filter( function( el ) {
                    return !!~el.indexOf( kodePinjaman );
                });

                var angsuranKe = [
                    @foreach($dataTanggalTempo as $dpk)
                    [ "{{$dpk->kodePinjaman}}", "{{$dpk->pembayaranKe}}"],
                    @endforeach
                ];

                var arr2 = angsuranKe.filter( function( el ) {
                    return !!~el.indexOf( kodePinjaman );
                });

                var tanggalPinjaman = [
                    @foreach($dataTanggalTempo as $ct)
                    [ "{{$ct->kodePinjaman}}", "{{$ct->tanggalBayar}}"],
                    @endforeach
                ];

                var arr3 = tanggalPinjaman.filter( function( el ) {
                    return !!~el.indexOf( kodePinjaman );
                });

                if(arr3 == 0){
                    var tanggalPinjaman = [
                        @foreach($dataPinjaman as $dp)
                            [ "{{$dp->kode}}", "{{$dp->tanggal}}" ],
                        @endforeach
                    ];

                    var arr3 = tanggalPinjaman.filter( function( el ) {
                        return !!~el.indexOf( kodePinjaman );
                    });

                    var pembayaranKe = parseInt(1);
                }else{
                    convertPembayaranKe = arr2[0][1];
                    pembayaranKe = parseInt(convertPembayaranKe) + 1;
                }

                var sisaHutang = [
                    @foreach($dataSisaHutang as $sh)
                    [ "{{$sh->kodePinjaman}}", "{{$sh->sisaHutang}}"],
                    @endforeach
                ];

                var arr4 = sisaHutang.filter( function( el ) {
                    return !!~el.indexOf( kodePinjaman );
                });

                if(arr4 == 0){
                    var sisaHutang = [
                        @foreach($dataPinjaman as $dp)
                            [ "{{$dp->kode}}", "{{$dp->jumlah}}" ],
                        @endforeach
                    ];

                    var arr4 = sisaHutang.filter( function( el ) {
                        return !!~el.indexOf( kodePinjaman );
                    });
                }

                convertTanggal = new Date(arr3[0][1]);
                tambahBulan = convertTanggal.setMonth(convertTanggal.getMonth()+1);
                tanggalTempo = new Date (tambahBulan).toISOString().split('T')[0];

                $('input[name="tanggalTempo"]').val(tanggalTempo);

                var tanggalBayar = new Date($('input[name="tanggal"]').val()).toISOString().split('T')[0];
                tanggalTempo = new Date (tambahBulan);
                batasDenda = new Date (tanggalTempo).toISOString().split('T')[0];

                d1 = new Date (tanggalTempo);
                d2 = new Date($('input[name="tanggal"]').val());

                pokok = arr[0][1] / 10;
                bunga = arr[0][1] * 3/100;
                sisaHutang = arr4[0][1];

                if(tanggalBayar > batasDenda){
                    var months;
                    months = (d2.getFullYear() - d1.getFullYear()) * 12;
                    months -= d1.getMonth();
                    months += d2.getMonth();
                    months <= 0 ? 0 : months;
                    months +=1;

                    if(months > 10){
                        pokok = pokok * 10;
                        if(pokok>sisaHutang){
                            pokok = parseInt(sisaHutang);
                        }
                        bunga = bunga * 10;
                        denda = (((pokok / months) + (bunga / months)) * 5/100) * months;
                        jumlah = pokok + bunga + denda;
                    }else {
                        pokok = pokok * months;
                        if(pokok>sisaHutang){
                            pokok = parseInt(sisaHutang);
                        }
                        bunga = bunga * months;
                        denda = (((pokok / months) + (bunga / months)) * 5/100) * (months-1);
                        jumlah = pokok + bunga + denda;
                    }
                } else {
                    if(pokok>sisaHutang){
                        pokok = parseInt(sisaHutang);
                    }
                    denda = 0;
                    jumlah = pokok + bunga + denda;
                }

                $('input[name="pembayaranKe"]').val(pembayaranKe);
                pokok = convert(pokok);
                $('input[name="pokok"]').val(pokok);
                bunga = convert(bunga);
                $('input[name="bunga"]').val(bunga);
                denda = convert(denda);
                $('input[name="denda"]').val(denda);
                jumlah = convert(jumlah);
                $('input[name="jumlah"]').val(jumlah);
            }else{
                $('.hde').hide(450);
                $('input[name="tanggalTempo"]').val("");
                $('input[name="pembayaranKe"]').val("");
                $('input[name="pokok"]').val("");
                $('input[name="bunga"]').val("");
                $('input[name="denda"]').val("");
                $('input[name="jumlah"]').val("");
            }
        }

        $(document).on('change select', '.kp', function() {
            $('input[name="tanggal"]').val("")

            var kodePinjaman = $('select[name="kodePinjaman"]').val();

            if(kodePinjaman != ""){
                var tanggalAwal = [
                    @foreach($dataTanggalTempo as $ct)
                    [ "{{$ct->kodePinjaman}}", "{{$ct->tanggalBayar}}"],
                    @endforeach
                ];

                var arr5 = tanggalAwal.filter( function( el ) {
                    return !!~el.indexOf( kodePinjaman );
                });

                if(arr5 == 0){
                    var tanggalAwal = [
                        @foreach($dataPinjaman as $dp)
                            [ "{{$dp->kode}}", "{{$dp->tanggal}}" ],
                        @endforeach
                    ];

                    var arr5 = tanggalAwal.filter( function( el ) {
                        return !!~el.indexOf( kodePinjaman );
                    });
                }

                convertTanggalAwal = new Date(arr5[0][1]);
                tanggalTempoAwal = new Date (convertTanggalAwal).toISOString().split('T')[0];

                $('#tanggal').attr('min', tanggalTempoAwal);
            }
            angsuran();
        });

        $(document).on('change input', '.tp', function() {
            angsuran();
        });

    </script>
@endsection
