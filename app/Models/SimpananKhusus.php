<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimpananKhusus extends Model
{
    use HasFactory;

    protected $table = 'simpanan_khusus';

    protected $primaryKey = 'kode';

    public $incrementing = false;

    protected $fillable = [
        'kode',
        'idAnggota',
        'tanggal',
        'jumlah',
        'saldo'
    ];

    public function getDefaultValues()
    {
        return [
            'kode'  => '',
            'idAnggota'  => '',
            'tanggal'  => '',
            'jumlah' => '',
            'saldo'  => ''
        ];
    }
}
