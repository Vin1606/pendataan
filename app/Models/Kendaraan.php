<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';
    protected $fillable = [
        'nopol',
        'merk',
        'type',
        'model',
        'silinder',
        'warna',
        'rangka',
        'mesin',
        'tahun',
        'pemilik',
        'jenis_kendaraan',
    ];

    protected $primaryKey = 'id_kendaraan';

    public function insurance()
    {
        return $this->hasOne(Insurance::class, 'id_kendaraan');
    }

    public function stnk()
    {
        return $this->hasOne(Stnk::class, 'id_kendaraan');
    }

    public function kir()
    {
        return $this->hasOne(Kir::class, 'id_kendaraan');
    }
}
