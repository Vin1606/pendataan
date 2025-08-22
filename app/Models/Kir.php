<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kir extends Model
{
    protected $table = 'kir';
    protected $primaryKey = 'id_kir';

    protected $fillable = [
        'no_kir',
        'end_kir',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan');
    }
}
