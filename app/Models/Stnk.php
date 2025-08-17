<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stnk extends Model
{
    protected $table = 'stnk';
    protected $fillable = [
        'nopol',
        'type',
        'rangka',
        'mesin',
        'tahun',
        'harga',
        'plat',
        'pajak',
        'pemilik',
    ];

    protected $primaryKey = 'id_stnk';
}
