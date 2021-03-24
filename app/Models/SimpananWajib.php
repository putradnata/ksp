<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimpananWajib extends Model
{
    use HasFactory;

    protected $table = 'simpanan_wajib';

    protected $primaryKey = 'kode';

    public $incrementing = false;

    protected $fillable = [
        'kode',
        'idAnggota',
        'syarat',
        'tanggal',
        'jumlah'
    ];

    public function getDefaultValues()
    {
        return [
            'kode'  => '',
            'idAnggota'  => '',
            'syarat'  => '',
            'tanggal'  => '',
            'jumlah' => ''
        ];
    }
}
