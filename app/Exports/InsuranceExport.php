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
                'Asuransi'  => $item->name->value, // atau ->label() jika pakai custom label
                'No Polish' => $item->no_polish,
                'Rangka'    => $item->rangka,
                'Mesin'     => $item->mesin,
                'Tahun'     => $item->tahun,
                'Harga'     => $item->harga,
                'Start'     => $item->start,
                'End'       => $item->end,
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
            'Start',
            'End',
        ];
    }
}
