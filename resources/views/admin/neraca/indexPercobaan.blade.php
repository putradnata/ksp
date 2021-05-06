@php
    use \Carbon\Carbon;
@endphp

@extends('layouts.template')

@section('title','KSP')
@section('pageName','Neraca Percobaan')

@section('customStyle')
    <style>
        #tambahButton {
            margin: 0 0 2% 0;
        }

        span.tsb > input {
            background: none;
            color: white;
            border: 0;
            padding: 0;
        }

        @media print{
            .frmz{
                visibility: hidden !important;
            }

            .main-footer{
                visibility: hidden !important;
            }

            .main-sidebar{
                visibility: hidden !important;
            }
        }


        @media screen and (min-width:768px){
            .col-12.text-center.result-shu {
                padding: 0 32em;
            }

            .neracaWrapper{
                padding:1rem 31rem 3rem 31rem;
            }

            .neracaWrapper.headz{
                padding:1rem 31rem 0rem 31rem;
            }
        }

        @media screen and (max-width:767px){
            .kop-koperasi{
                width: 100%;
            }

            .col-12.text-center.result-shu {
                padding: 0 3em;
            }
        }
    </style>
@endsection

@section('contentHere')
<div class="card">
    <div class="card-header frmz">
        <h3 class="card-title">Neraca Percobaan</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body frmz">
        <div class="row mb-5">
            <form class="form-inline form-horizontal" method="POST" id="neracaform">
                @csrf
                <div class="form-group mr-3">
                    <label class="mr-3">Periode</label>
                    <input type="month" name="dariTanggal" class="form-control" required>
                </div>
                <span class="tsb btn btn-success mr-4">
                    <i class="fas fa-search"></i> <input type="submit" class="cari" name="cari" value="Cari" id="cari">
                </span>
                <span class="tsb">
                    <button type="button" class="btn btn-primary mr-4" onclick="window.print()"><i class="fas fa-print"></i> Cetak</button>
                </span>

            </form>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12 text-center">
                <img class="kop-koperasi" src="{{ asset('images/kop-ksp.png') }}" >

                <div class="text-center"><strong>Periode : {{ \Carbon\Carbon::parse($dariTanggal)->format('M-Y') }}</strong></div><br>
            </div>
        </div>

        @if (@isset($akun) && @isset($akunNow))
            <table class="table table-bordered table-responsive-sm">
                <thead>
                    <tr>
                        <th rowspan="2" style="vertical-align: middle !important; text-align: center;">No. Akun</th>
                        <th rowspan="2" style="vertical-align: middle !important; text-align: center;">Nama Akun</th>
                        <th colspan="2" style="text-align: center;">Saldo Awal</th>
                        <th colspan="2" style="text-align: center;">Mutasi Bulan Ini</th>
                        <th colspan="2" style="text-align: center;">Saldo Akhir</th>
                    </tr>
                    <tr>
                        <th style="text-align: center;">Debet</th>
                        <th style="text-align: center;">Kredit</th>
                        <th style="text-align: center;">Debet</th>
                        <th style="text-align: center;">Kredit</th>
                        <th style="text-align: center;">Debet</th>
                        <th style="text-align: center;">Kredit</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $z = count($akun);
                        $y = count($akunNow);
                    @endphp
                    @for ($i = 0; $i < $z; $i++)
                        <tr>
                            <td style="width:10em">{{ $akun[$i]['noAkun'] }}</td>
                            <td style="width:10em">{{ $akun[$i]['namaAkun'] }}</td>
                            @if ($akun[$i]['status'] === 'DEBIT')
                                <td>@currency($akun[$i]['hasilAkhir'])</td>
                                <td>@currency(0)</td>
                            @endif
                            @if ($akun[$i]['status'] === 'KREDIT')
                                <td>@currency(0)</td>
                                <td>@currency($akun[$i]['hasilAkhir'])</td>
                            @endif
                            @if ($akunNow[$i]['status'] === 'DEBIT')
                                <td>@currency($akunNow[$i]['hasilAkhir'])</td>
                                <td>@currency(0)</td>
                            @endif
                            @if ($akunNow[$i]['status'] === 'KREDIT')
                                <td>@currency(0)</td>
                                <td>@currency($akunNow[$i]['hasilAkhir'])</td>
                            @endif
                            @if ($akun[$i]['status'] === 'DEBIT')
                                <td>@currency($akunNow[$i]['hasilAkhir'] + $akun[$i]['hasilAkhir'])</td>
                                <td>@currency(0)</td>
                            @endif
                            @if ($akun[$i]['status'] === 'KREDIT')
                                <td>@currency(0)</td>
                                <td>@currency($akunNow[$i]['hasilAkhir'] + $akun[$i]['hasilAkhir'])</td>
                            @endif
                        </tr>
                    @endfor

                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection

@section('scriptPlace')
    <!-- Onclick Action -->
    <script type="text/javascript">
        $("#neracaform").on('submit', function () {
            $("#tbody").html(
                "<tr><td colspan=7 class='text-center'><img src='/images/load.gif'></td></tr>"
                )
            $.ajax({
                url: "{{ url('/neraca') }}",
                type: "POST",
                dataType: 'json',
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: $("#neracaform").serialize(),

                success: function (msg) {
                }
            });
        });
    </script>
@endsection
