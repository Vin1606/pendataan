<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawan';
    protected $fillable = [
        'nama',
        'no_ktp',
        'alamat',
        'pekerjaan',
    ];
    protected $primaryKey = 'id_karyawan';

    public function kir()
    {
        return $this->hasOne(Kir::class, 'id_kendaraan');
    }
}
