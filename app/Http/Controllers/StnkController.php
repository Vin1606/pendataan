<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kendaraan;
use App\Exports\StnkExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StnkController extends Controller
{
    public function data_stnk(Request $request)
    {
        $title = 'STNK';
        $subtitle = 'HALAMAN STNK';
        $query = Kendaraan::select('kendaraan.*')
            ->join('stnk', 'stnk.id_kendaraan', '=', 'kendaraan.id_kendaraan')
            ->orderBy('stnk.pajak')
            ->with(['stnk']);

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $keyword = $request->keyword;
                $q->where('pemilik', 'like', '%' . $keyword . '%')
                    ->orWhere('nopol', 'like', '%' . $keyword . '%')
                    ->orWhere('type', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->filled('bulan')) {
            $query->whereHas('stnk', function ($q) use ($request) {
                $q->whereMonth('pajak', $request->bulan)
                    ->whereYear('pajak', $request->tahun ?? now()->year);
            });
        }

        $kendaraan = $query->paginate(10)->withQueryString();
        $filteredData = $query->get();

        // Tandai STNK yang mati atau belum diperpanjang
        $kendaraan->getCollection()->transform(function ($item) {
            $pajak = optional($item->stnk)->pajak;
            $now = Carbon::now()->startOfMonth();
            $nextMonth = $now->copy()->addMonth();

            $item->is_expired = $pajak && Carbon::parse($pajak)->lt($now);
            $item->is_upcoming = $pajak && Carbon::parse($pajak)->month === $nextMonth->month
                && Carbon::parse($pajak)->year === $nextMonth->year;

            return $item;
        });

        return view('stnk.stnk', compact('title', 'subtitle', 'kendaraan'));
    }

    public function create_stnk()
    {
        $title = "Create Data";
        $subtitle = "Create New Stnk";

        return view('stnk.create_stnk', compact('title', 'subtitle'));
    }

    public function store_stnk(Request $request)
    {
        $validated = $request->validate([
            'nopol' => 'required|string',
            'type' => 'required|string',
            'rangka' => 'required|string|min:17|max:17',
            'mesin' => 'required|string',
            'tahun' => 'required|integer',
            'plat' => 'required|string',
            'pajak' => 'required|string',
            'pemilik' => 'required|string',
        ]);
        // Simpan kendaraan dulu
        $kendaraan = Kendaraan::create([
            'nopol' => $request->nopol,
            'type' => $request->type,
            'rangka' => $request->rangka,
            'mesin' => $request->mesin,
            'tahun' => $request->tahun,
            'pemilik' => $request->pemilik,
        ]);

        // Simpan asuransi dengan referensi kendaraan
        $kendaraan->stnk()->create([
            'id_kendaraan' => $kendaraan->id_kendaraan,
            'plat' => $request->plat,
            'pajak' => $request->pajak,
        ]);
        return redirect()->route('data.stnk')->with('success', 'Data Added!');
    }

    public function edit_stnk(Kendaraan $kendaraan)
    {
        $title = "Edit Data";
        $subtitle = "Edit Stnk";
        return view('stnk.edit_stnk', compact('title', 'subtitle', 'kendaraan'));
    }


    public function update_stnk(Request $request, Kendaraan $kendaraan)
    {
        $validated = $request->validate([
            'nopol' => 'required|string',
            'type' => 'required|string',
            'rangka' => 'required|string|min:17|max:17',
            'mesin' => 'required|string',
            'tahun' => 'required|integer',
            'plat' => 'required|string',
            'pajak' => 'required|string',
            'pemilik' => 'required|string',
        ]);
        // Simpan kendaraan dulu
        $kendaraan->update([
            'nopol' => $request->nopol,
            'type' => $request->type,
            'rangka' => $request->rangka,
            'mesin' => $request->mesin,
            'tahun' => $request->tahun,
            'pemilik' => $request->pemilik,
        ]);
        // Simpan stnk dengan referensi kendaraan
        $kendaraan->stnk()->updateOrCreate(
            ['id_kendaraan' => $kendaraan->id_kendaraan], // ini kunci pencarian
            [ // ini data yang akan diupdate atau dibuat
                'plat' => $request->plat,
                'pajak' => $request->pajak,
            ]
        );
        return redirect()->route('data.stnk')->with('success', 'Data Updated!');
    }

    public function exportSTNK(Request $request)
    {
        $query = Kendaraan::with('stnk');

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $keyword = $request->keyword;
                $q->where('pemilik', 'like', '%' . $keyword . '%')
                    ->orWhere('nopol', 'like', '%' . $keyword . '%')
                    ->orWhere('type', 'like', '%' . $keyword . '%');
            });
        }
        if ($request->filled('bulan')) {
            $query->whereHas('stnk', function ($q) use ($request) {
                $q->whereMonth('pajak', $request->bulan)
                    ->whereYear('pajak', $request->tahun ?? now()->year);
            });
        }
        $filteredData = $query->get();
        return Excel::download(new StnkExport($filteredData), 'stnk.xlsx');
    }

    public function exportPDFSTNK(Request $request)
    {
        $query = Kendaraan::with('stnk');

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $keyword = $request->keyword;
                $q->where('pemilik', 'like', '%' . $keyword . '%')
                    ->orWhere('nopol', 'like', '%' . $keyword . '%')
                    ->orWhere('type', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->filled('bulan')) {
            $query->whereHas('stnk', function ($q) use ($request) {
                $q->whereMonth('pajak', $request->bulan)
                    ->whereYear('pajak', $request->tahun ?? now()->year);
            });
        }

        $filteredData = $query->get();

        // Gunakan instance DomPDF
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('stnk.export_pdf_stnk', ['data' => $filteredData])
            ->setPaper('A4', 'portrait');

        return $pdf->download('stnk.pdf');
    }

    public function KuasaSTNKPDF(Request $request, Kendaraan $kendaraan)
    {
        $query = Kendaraan::with('stnk');

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $keyword = $request->keyword;
                $q->where('pemilik', 'like', '%' . $keyword . '%')
                    ->orWhere('nopol', 'like', '%' . $keyword . '%')
                    ->orWhere('type', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->filled('bulan')) {
            $query->whereHas('stnk', function ($q) use ($request) {
                $q->whereMonth('pajak', $request->bulan)
                    ->whereYear('pajak', $request->tahun ?? now()->year);
            });
        }

        $filteredData = $query->get();

        // Gunakan instance DomPDF
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('stnk.surat_kuasa_stnk', ['data' => $filteredData], compact('kendaraan'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('surat-kuasa-stnk.pdf');
    }
}
