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
    <div class="card-header">
        <h3 class="card-title">Neraca</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-5">
            <form class="form-inline form-horizontal" method="POST" id="neracaform">
                @csrf
                <div class="form-group mr-3">
                    <label class="mr-3">Dari Tanggal</label>
                    <input type="date" name="dariTanggal" class="form-control" required>
                </div>
                <div class="form-group mr-3">
                    <label class="mr-3">Sampai Tanggal</label>
                    <input type="date" name="sampaiTanggal" class="form-control" required>
                </div>

                <span class="tsb btn btn-success mr-4">
                    <i class="fas fa-search"></i> <input type="submit" name="cari" value="Cari">
                </span>

                <span class="tsb btn btn-primary mr-4">
                    <i class="fas fa-print"></i> <input type="submit" name="cetak" value="Cetak">
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
                <div class="col-6" style="border-right: solid 2px;padding-left: 4em;">
                    <table>
                        <tr>
                            <th>Aktiva Lancar</th>
                        </tr>
                        @php
                        $z = count($akun);
                        $totalAktivaLancar = 0;
                        $totalAktivaTetap = 0;
                        $totalPendapatan = 0;
                        $totalBeban = 0;
                        $totalModalSendiri = 0;
                        @endphp
                        @for ($i = 0; $i < $z; $i++)
                            @if ($akun[$i]['tipeAkun'] === 'Aktiva Lancar')
                            <tr>
                                <td style="width:10em">{{ $akun[$i]['namaAkun'] }}</td>
                                <td>@currency($akun[$i]['hasilAkhir'])</td>
                            </tr>
                            @php
                                $akn[$i] = $totalAktivaLancar+=$akun[$i]['hasilAkhir'];

                                $data = [
                                    'al' => $akn[$i],
                                ];

                                $totalAktivaTetap2 = $data['al'];
                            @endphp
                            @endif
                        @endfor
                        <tr>
                            <td>
                                <strong>Total Aktiva Lancar :</strong>
                            </td>
                            <td>@currency($data['al'])</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Aktiva Tetap</th>
                        </tr>
                        @for ($i = 0; $i < $z; $i++)
                            @if ($akun[$i]['tipeAkun'] === 'Aktiva Tetap')
                            <tr>
                                <td style="width:10em">{{ $akun[$i]['namaAkun'] }}</td>
                                <td>@currency($akun[$i]['hasilAkhir'])</td>
                            </tr>

                            @php
                                $akt[$i] = $totalAktivaTetap+=$akun[$i]['hasilAkhir'];

                                $data = [
                                    'at' => $akt[$i],
                                ];
                            @endphp
                            @endif
                        @endfor
                        <tr>
                            <td>
                                <strong>Total Aktiva Tetap :</strong>
                            </td>
                            <td>@currency($data['at'])</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <th>Total Keseluruhan :</th>
                            <td>
                                @php
                                    $rs = $data['at']+$totalAktivaLancar;
                                @endphp

                                @currency($rs)
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-6" style="padding-left: 4em;">
                    <table>
                        <tr>
                            <th>Kewajiban</th>
                        </tr>
                        @for ($i = 0; $i < $z; $i++)
                                @if ($akun[$i]['tipeAkun'] == 'Kewajiban')
                                <tr>
                                    <td style="width:10em">{{ $akun[$i]['namaAkun'] }}</td>
                                    <td>{{ $akun[$i]['hasilAkhir'] }}</td>
                                </tr>
                                @php
                                    $pd[$i] = $totalPendapatan+=$akun[$i]['hasilAkhir'];


                                    $data = [
                                    'pd' => $pd[$i],
                                    ];


                                @endphp
                                @else
                                    @php
                                        $data = [
                                        'pd' => 0,
                                        ];
                                    @endphp
                                @endif
                        @endfor

                        <tr>
                            <td>
                                <strong>Total Kewajiban :</strong>
                            </td>
                            <td>@currency($data['pd'])</td>
                        </tr>

                        @php
                            $bg = count($modalSendiri);
                        @endphp
                        <tr>
                            <th>Modal Sendiri</th>
                        </tr>
                        @for ($st = 0; $st < $bg; $st++)
                            <tr>
                                <td>{{$modalSendiri[$st]['namaAkun']}}</td>
                                <td>@currency($modalSendiri[$st]['jumlah'])</td>
                            </tr>
                            @php
                                $tms = $totalModalSendiri+=$modalSendiri[$st]['jumlah'];

                                $data = [
                                    'ts' => $tms,
                                ];
                            @endphp
                        @endfor
                        <tr>
                            <td>
                                <strong>Jumlah Modal Sendiri :</strong>
                            </td>
                            <td>@currency($data['ts'])</td>
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
        $(document).ready(function () {
            $("#cari").click(function () {

                $("#tbody").html(
                    "<tr><td colspan=7 class='text-center'><img src='/images/load.gif'></td></tr>"
                    )
                $.ajax({
                    url: "{{ url('/buku-besar') }}",
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
        });
    </script>
@endsection
