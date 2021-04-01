<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penarikan extends Model
{
    use HasFactory;

    protected $table = 'penarikan';

    protected $primaryKey = 'kode';

    public $incrementing = false;

    protected $fillable = [
        'kode',
        'kodeSimpanan',
        'idAnggota',
        'tanggal',
        'jumlah',
        'saldo',
        'saldoAkhir'
    ];

    public function getDefaultValues()
    {
        return [
            'kode'  => '',
            'kodeSimpanan'  => '',
            'idAnggota'  => '',
            'tanggal'  => '',
            'jumlah' => '',
            'saldo'  => '',
            'saldoAkhir' => ''
        ];
    }
}
