<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    use HasFactory;

    protected $table = 'angsuran';

    protected $primaryKey = 'kode';

    public $incrementing = false;

    protected $fillable = [
        'kode',
        'kodePinjaman',
        'tanggalBayar',
        'tanggalTempo',
        'pembayaranKe',
        'pokok',
        'denda',
        'bunga',
        'jumlah'
    ];

    public function getDefaultValues()
    {
        return [
            'kode'  => '',
            'kodePinjaman'  => '',
            'tanggalBayar'  => '',
            'tanggalTempo'  => '',
            'pembayaranKe' => '',
            'pokok' => '',
            'denda' => '',
            'bunga' => '',
            'jumlah' => ''
        ];
    }
}
