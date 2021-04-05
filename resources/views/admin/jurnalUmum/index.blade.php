@php
    use \Carbon\Carbon;
@endphp

@extends('layouts.template')

@section('title','KSP')
@section('pageName','Jurnal Umum')

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
        <h3 class="card-title">Jurnal Umum</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <a class="btn btn-primary" id="tambahButton" href="{{ route('jurnal-umum.create') }}"> <i class="fa fa-book"></i> Tambah Jurnal </a>
        <table class="table table-stripped" id="tabelData">
            <thead>
                <th>Tanggal</th>
                <th>Kode Jurnal</th>
                <th>Keterangan</th>
                <th>Akun</th>
                <th>Debet</th>
                <th>Kredit</th>
            </thead>
            <tbody>
                @php
                    $firstDebit = 0;
                    $firstKredit = 0;
                @endphp

                @foreach ($showJurnal as $jurnal)
                    @php
                        $parsedDate = Carbon::parse($jurnal->tanggal)->locale('id');
                    @endphp
                    <tr>
                        <td>{{ $parsedDate->isoFormat('DD-MM-YYYY') }}</td>
                        <td>{{ $jurnal->noTransaksi }}</td>
                        <td>{{ $jurnal->keterangan }}</td>
                        <td>{{ $jurnal->namaAkun }}</td>
                        @if ($jurnal->status == 'DEBIT')
                            <td>{{ "Rp".number_format($totalDebit = $firstDebit+=$jurnal->jumlah, 0,",",".") }}</td>
                            <td> - </td>
                        @else
                            <td> - </td>
                            <td>{{ "Rp".number_format($totalKredit = $firstKredit+=$jurnal->jumlah, 0,",",".") }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">Total</td>
                    <td>{{ "Rp".number_format($totalDebit, 0,",",".") }}</td>
                    <td>{{ "Rp".number_format($totalKredit, 0,",",".") }}</td>
                </tr>
            </tfoot>
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
