@foreach ($dataDetailAngsuran as $da => $dda)
    <tr>
        <td>{{ ++$da }}.</td>
        <td>{{ $dda->kode }}</td>
        <td>{{ \Carbon\Carbon::parse($dda->tanggalTempo)->format('d-m-Y') }}</td>
        <td>{{ \Carbon\Carbon::parse($dda->tanggalBayar)->format('d-m-Y') }}</td>
        <td>@currency($dda->pokok)</td>
        <td>@currency($dda->denda)</td>
        <td>@currency($dda->bunga)</td>
    </tr>
@endforeach
