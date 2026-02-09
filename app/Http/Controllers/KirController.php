<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KirController extends Controller
{
    public function data_kir(Request $request)
    {
        $title = 'KIR';
        $subtitle = 'HALAMAN KIR';

        $query = Kendaraan::with('kir') // pastikan relasi karyawan dimuat
            ->whereHas('kir', function ($query) {
                $query->whereNotNull('end_kir');
            });

        // 🔍 Filter berdasarkan keyword
        if ($request->filled('keyword')) {
            $query->whereHas('kir', function ($q) use ($request) {
                $keyword = $request->keyword;
                $q->where('no_kir', 'like', '%' . $keyword . '%')
                    ->orWhere('nopol', 'like', '%' . $keyword . '%')
                    ->orWhere('tahun', 'like', '%' . $keyword . '%')
                    ->orWhere('jenis_kendaraan', 'like', '%' . $keyword . '%');
            });
        }

        // 📅 Filter berdasarkan bulan dan tahun
        if ($request->filled('bulan')) {
            $query->whereHas('kir', function ($q) use ($request) {
                $q->whereMonth('end_kir', $request->bulan)
                    ->whereYear('end_kir', $request->tahun ?? now()->year);
            });
        }

        $kendaraan = $query->paginate(10)->withQueryString();

        return view('kir.kir', compact('title', 'subtitle', 'kendaraan'));
    }

    public function edit_kir(Kendaraan $kendaraan)
    {
        $title = "Edit Data";
        $subtitle = "Edit Kir";
        $karyawans = Karyawan::all();
        return view('kir.edit_kir', compact('title', 'subtitle', 'kendaraan', 'karyawans'));
    }

    public function update_kir(Request $request, Kendaraan $kendaraan)
    {
        $validated = $request->validate([
            'nopol' => 'required|string',
            'rangka' => 'required|string|min:17|max:17',
            'mesin' => 'required|string',
            'tahun' => 'required|integer',
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'no_kir' => 'required|string',
            'end_kir' => 'required|string',
        ]);
        // Simpan kendaraan dulu
        $kendaraan->update([
            'nopol' => $request->nopol,
            'rangka' => $request->rangka,
            'mesin' => $request->mesin,
            'tahun' => $request->tahun,
        ]);
        // Simpan stnk dengan referensi kendaraan
        $kendaraan->kir()->updateOrCreate(
            ['id_kendaraan' => $kendaraan->id_kendaraan], // ini kunci pencarian
            [ // ini data yang akan diupdate atau dibuat
                'no_kir' => $request->no_kir,
                'end_kir' => $request->end_kir,
                'id_karyawan' => $request->id_karyawan,
                'id_kendaraan' => $kendaraan->id_kendaraan,
            ]
        );
        return redirect()->route('data.kir')->with('success', 'Data Updated!');
    }

    public function KuasaKIRPDF(Request $request, Kendaraan $kendaraan)
    {
        $query = Kendaraan::with(['kir.karyawan']) // eager load relasi kir dan karyawan
            ->whereHas('kir', function ($q) use ($request) {
                $q->whereNotNull('end_kir');

                if ($request->filled('id_karyawan')) {
                    $q->where('id_karyawan', $request->id_karyawan);
                }

                if ($request->filled('bulan')) {
                    $q->whereMonth('end_kir', $request->bulan)
                        ->whereYear('end_kir', $request->tahun ?? now()->year);
                }
            });

        $filteredData = $query->get();

        // Gunakan instance DomPDF
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('kir.surat_kuasa_kir', ['data' => $filteredData], compact('kendaraan'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('surat-kuasa-kir.pdf');
    }
}
