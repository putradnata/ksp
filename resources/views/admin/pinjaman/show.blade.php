
    <table class="table" name="detailData">
        <tr>
            <th>Kode Pinjaman</th>
            <th>:</th>
            <th>{{$pinjaman->kode}}</th>
        </tr>
        <tr>
            <th>Nama Anggota</th>
            <th>:</th>
            <th>({{$pinjaman->idAnggota}}) {{$pinjaman->namaAnggota}}</th>
        </tr>
        <tr>
            <td>Tanggal Pinjaman</td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($pinjaman->tanggal)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td>Jumlah Pinjaman</td>
            <td>:</td>
            <td>@currency($pinjaman->jumlah)</td>
        </tr>
        <tr>
            <td>Biaya Administrasi</td>
            <td>:</td>
            <td>@currency($pinjaman->jumlah * (3/100))</td>
        </tr>
        <tr>
            <td>Biaya Materai</td>
            <td>:</td>
            <td>@currency(10000)</td>
        </tr>
        <tr>
            <th>Total Akhir</th>
            <th>:</th>
            <th>@currency($pinjaman->jumlah - (($pinjaman->jumlah * (3/100) + 10000)))</th>
        </tr>
    </table>
