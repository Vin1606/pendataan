<?php

namespace App\Models;

use App\Enums\TypeInsurance;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected $fillable = [
        'nopol',
        'name',
        'no_polish',
        'rangka',
        'mesin',
        'tahun',
        'harga',
        'start',
        'end',
    ];

    protected $casts = [
        'name' => TypeInsurance::class,
    ];

    protected $primaryKey = 'id_insurances';
}
