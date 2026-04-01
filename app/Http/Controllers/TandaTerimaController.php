<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class TandaTerimaController extends Controller
{
    public function penyerahanStnk(Kendaraan $kendaraan)
    {
        // Eager load relasi stnk dan data terkait lainnya jika perlu
        $kendaraan->load('stnk');

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('tanda_terima.penyerahan_stnk', compact('kendaraan'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('tanda-terima-penyerahan-stnk-' . $kendaraan->nopol . '.pdf');
    }

    public function pengambilanStnk(Kendaraan $kendaraan)
    {
        // Eager load relasi stnk
        $kendaraan->load('stnk');

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('tanda_terima.pengambilan_stnk', compact('kendaraan'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('tanda-terima-pengambilan-stnk-' . $kendaraan->nopol . '.pdf');
    }

    public function penyerahanStnkBulk(Request $request)
    {
        $request->validate([
            'selected_ids' => 'required|array|min:1',
            'selected_ids.*' => 'exists:kendaraan,id_kendaraan',
        ], [
            'selected_ids.required' => 'Mohon pilih setidaknya satu kendaraan.',
        ]);

        $kendaraans = Kendaraan::whereIn('id_kendaraan', $request->selected_ids)->with('stnk')->get();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('tanda_terima.penyerahan_stnk_bulk', compact('kendaraans'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('tanda-terima-penyerahan-stnk-bulk.pdf');
    }

    public function pengambilanStnkBulk(Request $request)
    {
        $request->validate([
            'selected_ids' => 'required|array|min:1',
            'selected_ids.*' => 'exists:kendaraan,id_kendaraan',
        ], [
            'selected_ids.required' => 'Mohon pilih setidaknya satu kendaraan.',
        ]);

        $kendaraans = Kendaraan::whereIn('id_kendaraan', $request->selected_ids)->with('stnk')->get();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('tanda_terima.pengambilan_stnk_bulk', compact('kendaraans'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('tanda-terima-pengambilan-stnk-bulk.pdf');
    }
}
