<html>
<head><meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<style type="text/css">
span.cls_002 {
    font-family: Times, serif;
    font-size: 18.1px;
    color: rgb(0, 0, 0);
    font-weight: bold;
    font-style: normal;
    text-decoration: none
}
div.cls_002 {
    font-family: Times, serif;
    font-size: 18.1px;
    color: rgb(0, 0, 0);
    font-weight: bold;
    font-style: normal;
    text-decoration: none
}
span.cls_003 {
    font-family: Times, serif;
    font-size: 16.0px;
    color: rgb(0, 0, 0);
    font-weight: bold;
    font-style: normal;
    text-decoration: none
}
div.cls_003 {
    font-family: Times, serif;
    font-size: 16.0px;
    color: rgb(0, 0, 0);
    font-weight: bold;
    font-style: normal;
    text-decoration: none
}
span.cls_004 {
    font-family: Times, serif;
    font-size: 14.1px;
    color: rgb(0, 0, 0);
    font-weight: bold;
    font-style: normal;
    text-decoration: none
}
div.cls_004 {
    font-family: Times, serif;
    font-size: 14.1px;
    color: rgb(0, 0, 0);
    font-weight: bold;
    font-style: normal;
    text-decoration: none
}
span.cls_005 {
    font-family: Times, serif;
    font-size: 12.1px;
    color: rgb(0, 0, 0);
    font-weight: normal;
    font-style: normal;
    text-decoration: none
}
div.cls_005 {
    font-family: Times, serif;
    font-size: 12.1px;
    color: rgb(0, 0, 0);
    font-weight: normal;
    font-style: normal;
    text-decoration: none
}
span.cls_008 {
    font-family: Times, serif;
    font-size: 14.1px;
    color: rgb(0, 0, 0);
    font-weight: bold;
    font-style: normal;
    text-decoration: underline
}
div.cls_008 {
    font-family: Times, serif;
    font-size: 14.1px;
    color: rgb(0, 0, 0);
    font-weight: bold;
    font-style: normal;
    text-decoration: none
}
span.cls_009 {
    font-family: Times, serif;
    font-size: 12.1px;
    color: rgb(0, 0, 0);
    font-weight: bold;
    font-style: normal;
    text-decoration: underline
}
div.cls_009 {
    font-family: Times, serif;
    font-size: 12.1px;
    color: rgb(0, 0, 0);
    font-weight: bold;
    font-style: normal;
    text-decoration: none
}

.shu tbody td{
    padding:15px !important;
}
.shu tfoot td{
    padding:15px !important;
}
</style>

</head>
<body>
    <div style="position:absolute;left:50%;margin-left:-306px;top:0px;width:612px;height:936px;overflow:hidden">
        <div id="kop">
            <img src="{{ asset('images/kop-ksp.png') }}" width="612" height="128">
        </div>
        <div id="bodySurat" style="padding: 0 4em">
            <br>
            <br>
            <center><strong>Periode : {{ $dariTanggal.' - '.$sampaiTanggal }}</strong></center>
            <table class="shu" style="width: 100%">
                <tbody>
                    <tr>
                        <td><strong>Pendapatan</strong></td>
                    </tr>
                    @php
                        $totalPendapatan = 0;
                        $totalBeban = 0;
                    @endphp

                    @foreach ($filter as $shu)
                        @if ($shu->tipeAkun == 'Pendapatan')
                            <tr>
                                <td>{{ $shu->namaAkun }}</td>
                                <td>@currency($shu->jumlah)</td>
                            </tr>
                            @php
                                $totalPendapatan+=$shu->jumlah;
                            @endphp
                        @endif
                    @endforeach
                    <tr>
                        <td><strong>Total Pendapatan</strong></td>
                        <td>@currency($totalPendapatan)</td>
                    </tr>

                    <tr>
                        <td><strong>Beban</strong></td>
                    </tr>
                    @foreach ($filter2 as $shu2)
                        @if ($shu2->tipeAkun == 'Beban')
                            <tr>
                                <td>{{ $shu2->namaAkun }}</td>
                                <td>@currency($shu2->jumlah)</td>
                            </tr>
                            @php
                                    $totalBeban+=$shu2->jumlah;
                            @endphp
                        @endif
                    @endforeach
                    <tr>
                        <td><strong>Total Beban</strong></td>
                        <td>@currency($totalBeban)</td>
                    </tr>

                </tbody>

                <tfoot style="border-top:solid 4px !important;">
                    <td><strong>Total SHU</strong></td>
                    <td>@currency($totalPendapatan - $totalBeban)</td>
                </tfoot>
            </table>
        </div>
    </div>

</body>
