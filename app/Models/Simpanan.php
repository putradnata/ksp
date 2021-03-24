<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    use HasFactory;

    protected $table = 'simpanan';

    protected $primaryKey = 'kode';

    public $incrementing = false;

    protected $fillable = [
        'kode',
        'idAnggota',
        'tanggal',
        'jumlah',
        'saldo',
        'bunga'
    ];

    public function getDefaultValues()
    {
        return [
            'kode'  => '',
            'idAnggota'  => '',
            'tanggal'  => '',
            'jumlah' => '',
            'saldo'  => '',
            'bunga' => ''
        ];
    }
}
