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
    padding-bottom:0 !important;
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
            <table class="shu" align="center">
                <tbody>
                    <tr>
                        <td><strong>No Simpanan Wajib</strong></td>
                        <td><strong>:</strong></td>
                        <td><strong>{{$simpananWajib->kode}}</strong></td>
                    </tr>
                    <tr>
                        <td>Nama Anggota</td>
                        <td>:</td>
                        <td>({{$simpananWajib->idAnggota}}) {{$simpananWajib->namaAnggota}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Setoran</td>
                        <td>:</td>
                        <td>{{\Carbon\Carbon::parse($simpananWajib->tanggal)->format('d/m/Y')}}</td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td>:</td>
                        <td>@currency($simpananWajib->jumlah)</td>
                    </tr>
                    <tr style="height: 50px;">
                    </tr>
                    <tr>
                        <td align="center"><strong>Pegawai</strong></td>
                        <td></td>
                        <td align="center"><strong>Anggota</strong></td>
                    </tr>
                    <tr>
                        <td rowspan="3"></td>
                        <td></td>
                        <td rowspan="3"></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="center">........................</td>
                        <td></td>
                        <td align="center">........................</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
