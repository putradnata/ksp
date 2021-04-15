@foreach ($dataDetailSimpanan as $ds => $dds)
    <tr>
        <td>{{ ++$ds }}.</td>
        <td>{{ $dds->kode }}</td>
        <td>{{ \Carbon\Carbon::parse($dds->tanggal)->format('d-m-Y') }}</td>
        <td>@currency($dds->jumlah)</td>
        <td>@currency($dds->saldo)</td>
        @if ($dds->keterangan == 'CR')
            <td>Simpanan</td>
        @elseif ($dds->keterangan == 'DB')
            <td>Penarikan</td>
        @else
            <td>Suku Bunga</td>
        @endif
    </tr>
@endforeach
