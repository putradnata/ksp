<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'nama',
        'alamat',
        'tempatLahir',
        'tanggalLahir',
        'jenisKelamin',
        'pekerjaan',
        'umur',
        'idAdmin'
    ];

    public function getDefaultValues()
    {
        return [
            'id' => '',
            'nama' => '',
            'alamat' => '',
            'tempatLahir' => '',
            'tanggalLahir' => '',
            'jenisKelamin' => '',
            'pekerjaan' => '',
            'umur' => '',
            'idAdmin' => ''
        ];
    }
}
