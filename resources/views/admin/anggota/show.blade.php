@foreach ($anggota as $anggota)
    <table class="table" name="detailData">
        <tr>
            <th>Kode Anggota</th>
            <td>:</td>
            <td>{{ $anggota->id}}</td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>:</td>
            <td>{{ $anggota->nama}}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>:</td>
            <td>{{ $anggota->alamat}}</td>
        </tr>
        <tr>
            <th>Tempat/Tanggal Lahir</th>
            <td>:</td>
            <td>{{ $anggota->tempatLahir }}, {{ \Carbon\Carbon::parse($anggota->tanggalLahir)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>:</td>
            @if ($anggota->jenisKelamin == "L")
                <td>Laki-laki</td>
            @else
                <td>Perempuan</td>
            @endif
        </tr>
        <tr>
            <th>Pekerjaan</th>
            <td>:</td>
            <td>{{ $anggota->pekerjaan }}</td>
        </tr>
        <tr>
            <th>Umur</th>
            <td>:</td>
            <td>{{ $anggota->umur }}</td>
        </tr>
    </table>
@endforeach
