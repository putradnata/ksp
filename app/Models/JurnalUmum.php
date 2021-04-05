<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalUmum extends Model
{
    use HasFactory;

    protected $table = 'jurnal_umum';

    protected $guarded = ['created_at', 'updated_at'];

    protected $fillable = [
        'noTransaksi',
        'noAkun',
        'tanggal',
        'jumlah',
        'status',
        'keterangan',
        'idAdmin'
    ];
}
