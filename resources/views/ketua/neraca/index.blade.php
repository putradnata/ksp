@php
    use \Carbon\Carbon;
@endphp

@extends('layouts.template')

@section('title','KSP')
@section('pageName','Neraca')

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
        .testprint{
            display: none;
        }
        .printBorder{
                display: none;
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

            .testprint{
                display: block;
                width:6.5em;
            }

            .col61{
                margin-right: -150px;
                border:solid 0px !important;
            }

            .printBorder{
                display: block;
                height: auto;
                border-right:2px solid black;
                margin-left:1.5em;
            }

            .p{
                margin-top: -250px;
            }
        }


        @media screen and (min-width:1440px){
            .neracaWrapper{
                padding:1rem 31rem 3rem 31rem;
            }

            .neracaWrapper.headz{
                padding:1rem 31rem 0rem 31rem;
            }
        }

        @media screen and (min-width:1360px){
            .neracaWrapper{
                padding:1rem 10rem 3rem 10rem;
            }

            .neracaWrapper.headz{
                padding:1rem 10rem 0rem 10rem;
            }
        }

        @media screen and (min-width:768px){
            /* .col-12.text-center.result-shu {
                padding: 0 32em;
            } */
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
        <h3 class="card-title">Neraca</h3>

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
            @if(Auth::user()->jabatan == 'K')
                <form class="form-inline form-horizontal" method="POST" id="neracaform" action="{{ route('neraca.show') }}">
            @elseif(Auth::user()->jabatan == 'A')
                <form class="form-inline form-horizontal" method="POST" id="neracaform" action="{{ route('neracaAdmin.show') }}">
            @endif
                @csrf
                <div class="form-group mr-3">
                    <label class="mr-3">Dari Tanggal</label>
                    <input type="date" name="dariTanggal" class="form-control" required>
                </div>
                <div class="form-group mr-3">
                    <label class="mr-3">Sampai Tanggal</label>
                    <input type="date" name="sampaiTanggal" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success mr-4 cari"><i class="fas fa-search"></i> Cari</button>
                {{-- <span class="tsb"> --}}
                    {{-- <input type="submit" class="btn btn-success mr-4 cari" name="cari" value="Cari"> --}}
                {{-- </span> --}}

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
            <div class="col-12 text-center p">
                <img class="kop-koperasi" src="{{ asset('images/kop-ksp.png') }}" >

                <div class="text-center"><strong>Periode : {{ \Carbon\Carbon::parse($dariTanggal)->format('d-m-Y').' - '.\Carbon\Carbon::parse($sampaiTanggal)->format('d-m-Y') }}</strong></div>
            </div>

        </div>

        <div class="row neracaWrapper headz text-center">
            <div class="col-6">
                <strong>Aktiva</strong>
            </div>
            <div class="col-6">
                <strong>Pasiva</strong>
            </div>
        </div>
        @if (@isset($akun))
            <div class="row neracaWrapper">
                <div class="testprint">
                    &nbsp;
                </div>
                <div class="col-6 col61" style="border-right: solid 2px;padding-left: 4em;">
                    <table>
                        <tr>
                            <th>Aktiva Lancar</th>
                        </tr>
                        @php
                            $countAkun = count($akun);
                            $totalAktivaLancar = 0;
                            $totalAktivaTetap = 0;
                            $totalPendapatan = 0;
                            $totalBeban = 0;
                            $totalModalSendiri = 0;
                            $totalKewajiban = 0;
                            $pasivaKeseluruhan = 0;
                        @endphp

                        @for ($i = 0; $i < $countAkun; $i++)
                            @if ($akun[$i]['tipeAkun'] === 'Aktiva Lancar' && $akun[$i]['hasilAkhir'] != 0)
                            <tr>
                                <td style="width:10em">{{ $akun[$i]['namaAkun'] }}</td>
                                <td>@currency($akun[$i]['hasilAkhir'])</td>
                            </tr>
                            @php
                                $totalAktivaLancar += $akun[$i]['hasilAkhir'];
                            @endphp
                            @endif
                        @endfor

                        <tr>
                            <td>
                                <strong>Total Aktiva Lancar :</strong>
                            </td>
                            <td>@currency($totalAktivaLancar)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Aktiva Tetap</th>
                        </tr>

                        @for ($i = 0; $i < $countAkun; $i++)
                            @if ($akun[$i]['tipeAkun'] === 'Aktiva Tetap' && $akun[$i]['hasilAkhir'] != 0)
                            <tr>
                                <td style="width:10em">{{ $akun[$i]['namaAkun'] }}</td>
                                <td>@currency($akun[$i]['hasilAkhir'])</td>
                            </tr>

                            @php
                                $totalAktivaTetap += $akun[$i]['hasilAkhir'];
                            @endphp
                            @endif
                        @endfor

                        <tr>
                            <td>
                                <strong>Total Aktiva Tetap :</strong>
                            </td>
                            <td>@currency($totalAktivaTetap)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Total Keseluruhan :</th>
                            <td>
                                @php
                                    $rs = $totalAktivaTetap + $totalAktivaLancar;
                                @endphp

                                @currency($rs)
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="printBorder">
                    &nbsp;
                </div>
                <div class="col-6" style="padding-left: 4em;">
                    <table>
                        <tr>
                            <th>Kewajiban</th>
                        </tr>

                        @for ($i = 0; $i < $countAkun; $i++)
                                @if ($akun[$i]['tipeAkun'] == 'Kewajiban' && $akun[$i]['hasilAkhir'] != 0)
                                <tr>
                                    <td style="width:10em">{{ $akun[$i]['namaAkun'] }}</td>
                                    <td>@currency($akun[$i]['hasilAkhir'])</td>
                                </tr>
                                @php
                                    $totalKewajiban += $akun[$i]['hasilAkhir'];
                                @endphp
                                @endif
                        @endfor

                        <tr>
                            <td>
                                <strong>Total Kewajiban :</strong>
                            </td>
                            <td>@currency($totalKewajiban)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Modal Sendiri</th>
                        </tr>

                        @for ($i = 0; $i < $countAkun; $i++)
                            @if ($akun[$i]['tipeAkun'] == 'Ekuitas')
                                <tr>
                                    <td style="width:10em">{{ $akun[$i]['namaAkun'] }}</td>
                                    <td>@currency($akun[$i]['hasilAkhir'])</td>
                                </tr>
                                @php
                                    $totalModalSendiri += $akun[$i]['hasilAkhir'];
                                @endphp
                            @endif
                        @endfor

                        <tr>
                            <td>
                                <strong>Jumlah Modal Sendiri :</strong>
                            </td>
                            <td>@currency($totalModalSendiri)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>

                        <tr>
                            <th>SHU Berjalan</th>
                        </tr>
                        @for ($i = 0; $i < $countAkun; $i++)
                            @if (($akun[$i]['tipeAkun'] == 'Pendapatan' || $akun[$i]['tipeAkun'] == 'Beban') && $akun[$i]['hasilAkhir'] != 0)
                                <tr>
                                    <td style="width:10em">{{ $akun[$i]['namaAkun'] }}</td>
                                    <td>@currency($akun[$i]['hasilAkhir'])</td>
                                </tr>
                            @php
                                if($akun[$i]['tipeAkun'] == 'Pendapatan'){
                                    $totalPendapatan += $akun[$i]['hasilAkhir'];
                                }else {
                                    $totalPendapatan -= $akun[$i]['hasilAkhir'];
                                }
                            @endphp
                            @endif
                        @endfor

                        <tr>
                            <td>
                                <strong>Jumlah SHU :</strong>
                            </td>
                            <td>@currency($totalPendapatan)</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>

                        <tr>
                            <th>Total Keseluruhan :</th>
                            <td>
                                @php
                                    $pasivaKeseluruhan = $totalModalSendiri + $totalKewajiban + $totalPendapatan;
                                @endphp
                                @currency($pasivaKeseluruhan)
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scriptPlace')
    <!-- Onclick Action -->
    <script type="text/javascript">
        $("#neracaform").submit(function () {
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
