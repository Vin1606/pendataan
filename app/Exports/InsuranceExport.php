<?php

namespace App\Exports;

use App\Models\Insurance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InsuranceExport implements FromCollection, WithHeadings
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
                'Asuransi'  => $item->name, // atau ->label() jika pakai custom label
                'No Polish' => $item->insurance->no_polish,
                'Rangka'    => $item->rangka,
                'Mesin'     => $item->mesin,
                'Tahun'     => $item->tahun,
                'Harga'     => $item->insurance->harga,
                'End'       => $item->insurance->end_insurance,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nopol',
            'Asuransi',
            'No Polish',
            'Rangka',
            'Mesin',
            'Tahun',
            'Harga',
            'End',
        ];
    }
}
