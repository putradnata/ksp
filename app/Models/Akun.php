<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;

    protected $table = 'akun';

    protected $primaryKey = 'noAkun';

    public $incrementing = false;

    protected $fillable = [
        'noAkun',
        'nama',
        'tipe',
        'saldo'
    ];

    public function getDefaultValues()
    {
        return [
            'noAkun'  => '',
            'nama'  => '',
            'tipe'  => '',
            'saldo'  => ''
        ];
    }
}
