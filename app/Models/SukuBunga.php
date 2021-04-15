<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SukuBunga extends Model
{
    use HasFactory;

    protected $table = 'detail_simpanan';

    public $incrementing = false;

    protected $fillable = [
        'kode',
        'kodeSimpanan',
        'tanggal',
        'jumlah',
        'saldo',
        'keterangan'
    ];

    public function getDefaultValues()
    {
        return [
            'kode'  => '',
            'kodeSimpanan'  => '',
            'tanggal'  => '',
            'jumlah' => '',
            'saldo'  => '',
            'keterangan' => ''
        ];
    }
}
