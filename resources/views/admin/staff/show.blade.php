@foreach ($staff as $staff)
    <table class="table" name="detailData">
        <tr>
            <th>Nama</th>
            <td>:</td>
            <td>{{ $staff->name}}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>:</td>
            <td>{{ $staff->email}}</td>
        </tr>
        <tr>
            <th>Jabatan</th>
            <td>:</td>
            @if ( $staff->jabatan == "K")
                <td>Ketua</td>
            @else
                <td>Admin</td>
            @endif
        </tr>
    </table>
@endforeach
