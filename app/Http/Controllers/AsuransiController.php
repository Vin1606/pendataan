<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Exports\InsuranceExport;
use Maatwebsite\Excel\Facades\Excel;

class AsuransiController extends Controller
{
    public function index(Request $request)
    {
        $title = 'ASURANSI';
        $subtitle = 'HALAMAN ASURANSI';
        $query = Kendaraan::select('kendaraan.*')
            ->join('insurances', 'insurances.id_kendaraan', '=', 'kendaraan.id_kendaraan')
            ->orderBy('insurances.end_insurance', 'asc')
            ->with(['insurance']);


        if ($request->filled('keyword')) {
            $query->whereHas('insurance', function ($q) use ($request) {
                $keyword = $request->keyword;
                $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('nopol', 'like', '%' . $keyword . '%')
                    ->orWhere('tahun', 'like', '%' . $keyword . '%')
                    ->orWhere('no_polish', 'like', '%' . $keyword . '%')
                    ->orWhere('rangka', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->filled('bulan')) {
            $query->whereHas('insurance', function ($q) use ($request) {
                $q->whereMonth('end_insurance', $request->bulan)
                    ->whereYear('end_insurance', $request->tahun ?? now()->year);
            });
        }

        $kendaraan = $query->paginate(10)->withQueryString();
        $filteredData = $query->get();

        // Tandai ASURANSI yang mati atau belum diperpanjang
        $kendaraan->getCollection()->transform(function ($item) {
            $end_insurance = optional($item->insurance)->end_insurance;
            $now = Carbon::now()->startOfMonth();
            $nextMonth = $now->copy()->addMonth();

            $item->is_expired = $end_insurance && Carbon::parse($end_insurance)->lt($now);
            $item->is_upcoming = $end_insurance && Carbon::parse($end_insurance)->month === $nextMonth->month
                && Carbon::parse($end_insurance)->year === $nextMonth->year;

            return $item;
        });

        return view('asuransi.asuransi', compact('title', 'subtitle', 'kendaraan'));
    }

    public function create_asuransi()
    {
        $title = "Create Data";
        $subtitle = "Create New Insurance";

        return view('asuransi.create_asuransi', compact('title', 'subtitle'));
    }

    public function detail_asuransi(Kendaraan $kendaraan)
    {
        $title = "Detail Data";
        $subtitle = "Detail Insurance";
        return view('asuransi.detail_asuransi', compact('title', 'subtitle', 'kendaraan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nopol' => 'required|string',
            'name' => 'required|string',
            'no_polish' => 'required|string',
            'rangka' => 'required|string|min:17|max:17',
            'mesin' => 'required|string',
            'tahun' => 'required|integer',
            'harga' => 'required|integer',
            'end_insurance' => 'required|string',
        ]);
        // Simpan kendaraan dulu
        $kendaraan = Kendaraan::create([
            'nopol' => $request->nopol,
            'rangka' => $request->rangka,
            'mesin' => $request->mesin,
            'tahun' => $request->tahun,
        ]);

        // Simpan asuransi dengan referensi kendaraan
        $kendaraan->insurance()->create([
            'id_kendaraan' => $kendaraan->id_kendaraan,
            'name' => $kendaraan->name,
            'no_polish' => $request->no_polish,
            'harga' => $request->harga,
            'end_insurance' => $request->end_insurance,
        ]);
        // Redirect atau tampilkan pesan sukses
        return redirect()->route('index')->with('success', 'Data Added!');
    }

    public function update_asuransi(Request $request, Kendaraan $kendaraan)
    {
        $validated = $request->validate([
            'nopol' => 'required|string',
            'name' => 'nullable|string',
            'no_polish' => 'nullable|string',
            'rangka' => 'required|string|min:17|max:17',
            'mesin' => 'required|string',
            'tahun' => 'required|integer',
            'harga' => 'nullable|integer',
            'end_insurance' => 'nullable|string',
        ]);
        // Simpan kendaraan dulu
        $kendaraan->update([
            'nopol' => $request->nopol,
            'rangka' => $request->rangka,
            'mesin' => $request->mesin,
            'tahun' => $request->tahun,
        ]);

        // Simpan asuransi dengan referensi kendaraan
        if ($request->filled('name') || $request->filled('no_polish') || $request->filled('harga') || $request->filled('end_insurance')) {
            $kendaraan->insurance()->updateOrCreate(
                ['id_kendaraan' => $kendaraan->id_kendaraan], // ini kunci pencarian
                [ // ini data yang akan diupdate atau dibuat
                    'name' => $request->name,
                    'no_polish' => $request->no_polish,
                    'harga' => $request->harga,
                    'end_insurance' => $request->end_insurance,
                ]
            );
        } else {
            // Jika tidak ada data asuransi, hapus jika ada
            $kendaraan->insurance()->delete();
        }

        return redirect()->route('index')->with('success', 'Data Updated!');
    }

    public function export(Request $request)
    {
        $query = Kendaraan::with('insurance');

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->whereHas('insurance', function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('nopol', 'like', "%{$keyword}%");
            });
        }
        if ($request->filled('bulan')) {
            $query->whereHas('insurance', function ($q) use ($request) {
                $q->whereMonth('end_insurance', $request->bulan)
                    ->whereYear('end_insurance', $request->tahun ?? now()->year);
            });
        }
        $filteredData = $query->get();
        return Excel::download(new InsuranceExport($filteredData), 'asuransi_filtered.xlsx');
    }

    public function exportPDF(Request $request)
    {
        $query = Kendaraan::with('insurance');

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->whereHas('insurance', function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('nopol', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('bulan')) {
            $query->whereHas('insurance', function ($q) use ($request) {
                $q->whereMonth('end_insurance', $request->bulan)
                    ->whereYear('end_insurance', $request->tahun ?? now()->year);
            });
        }
        $filteredData = $query->get();

        // Gunakan instance DomPDF
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('asuransi.export_pdf', ['data' => $filteredData])
            ->setPaper('A4', 'portrait');

        return $pdf->download('asuransi.pdf');
    }
}
