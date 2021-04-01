@extends('layouts.template')

@section('title','KSP')
@section('pageName','Angsuran')

@section('customStyle')
    <style>
        #tambahButton {
            margin: 0 0 2% 0;
        }
    </style>
@endsection

@section('contentHere')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Angsuran</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <a class="btn btn-primary" id="tambahButton" href="{{ route('angsuran.create') }}"> <i class="fa fa-book"></i> Tambah Angsuran </a>
        <table class="table table-stripped" id="tabelData">
            <thead>
                <th>No. </th>
                <th>Kode Angsuran </th>
                <th>Kode Pinjaman</th>
                <th>Tanggal Tempo</th>
                <th>Tanggal Pembayaran</th>
                <th>Pinjaman</th>
                <th>Pokok</th>
                <th>Denda</th>
                <th>Bunga</th>
                <th>Sisa</th>
                {{-- <th>Aksi</th> --}}
            </thead>
            <tbody>
                @foreach ( $selectPinjaman as $p)
                    @php
                        $sisaPinjaman = $p->jumlah
                    @endphp
                    @foreach ($dataAngsuran as $ans => $angsuran)
                        @if ($p->kodeP == $angsuran->kodePinjaman)
                            <tr>
                                <td>{{++$ans}}.</td>
                                <td>{{$angsuran->kode}}</td>
                                <td>{{$angsuran->kodePinjaman}}/({{$angsuran->idAnggota}}) {{$angsuran->namaAnggota}}</td>
                                <td>{{\Carbon\Carbon::parse($angsuran->tanggalTempo)->format('d-m-Y')}}</td>
                                <td>{{\Carbon\Carbon::parse($angsuran->tanggalBayar)->format('d-m-Y')}}</td>
                                <td>@currency($p->jumlah)</td>
                                <td>@currency($angsuran->pokok)</td>
                                <td>@currency($angsuran->denda)</td>
                                <td>@currency($angsuran->bunga)</td>
                                <td>@currency($sisaPinjaman -= $angsuran->pokok)</td>
                                {{-- <td>
                                    <a class="btn btn-sm btn-info light-s" data-toggle="modal" data-id="#" data-target="#"><span class="fa fa-eye"></span></a>
                                    <a class="btn btn-sm btn-warning light-s" href="#"><span class="fas fa-pencil-alt"></span></a>
                                </td> --}}
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scriptPlace')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tabelData').DataTable();
        });
    </script>
@endsection
