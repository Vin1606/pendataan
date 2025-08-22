<?php

namespace App\Exports;

use App\Models\Stnk;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class StnkExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }


    public function collection()
    {
        return $this->data->map(function ($item, $index) {
            return [
                'No'        => $index + 1, // Mulai dari 1
                'Nopol'     => $item->nopol,
                'Type'      => $item->type, // atau ->label() jika pakai custom label
                'Rangka'    => $item->rangka,
                'Mesin'     => $item->mesin,
                'Tahun'     => $item->tahun,
                'Plat'      => $item->stnk->plat,
                'Pajak'     => $item->stnk->pajak,
                'Pemilik'   => $item->pemilik,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nopol',
            'Type',
            'Rangka',
            'Mesin',
            'Tahun',
            'Plat',
            'Pajak',
            'Pemilik',
        ];
    }
}
