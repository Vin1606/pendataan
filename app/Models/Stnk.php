<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stnk extends Model
{
    protected $table = 'stnk';
    protected $fillable = [
        'plat',
        'pajak',
        'pemilik',
    ];

    protected $primaryKey = 'id_stnk';

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan');
    }
}
