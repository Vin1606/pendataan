<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Stnk;
use Barryvdh\DomPDF\Pdf;
use App\Models\Insurance;
use App\Exports\StnkExport;
use App\Enums\TypeInsurance;
use Illuminate\Http\Request;
use App\Exports\InsuranceExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{

    // ASURANSI
    // ------------------------------------
    public function index(Request $request)
    {
        $title = 'ASURANSI';
        $subtitle = 'HALAMAN ASURANSI';
        $query = Insurance::query();

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $keyword = $request->keyword;
                $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('nopol', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('end', $request->bulan)
                ->whereYear('end', Carbon::now()->year); // atau bisa request('tahun') kalau mau fleksibel
        }

        $insurances = $query->paginate(10)->withQueryString();
        $filteredData = $query->get();

        return view('asuransi', compact('title', 'subtitle', 'insurances'));
    }

    public function create_asuransi()
    {
        $title = "Create Data";
        $subtitle = "Create New Insurance";

        return view('create_asuransi', compact('title', 'subtitle'));
    }

    public function detail_asuransi(Insurance $insurance)
    {
        $title = "Detail Data";
        $subtitle = "Detail Insurance";
        return view('detail_asuransi', compact('title', 'subtitle', 'insurance'));
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
            'start' => 'required|string',
            'end' => 'required|string',
        ]);
        Insurance::create($validated);
        return redirect()->route('index')->with('success', 'Data Added!');
    }

    public function update_asuransi(Request $request, Insurance $insurance)
    {
        $validated = $request->validate([
            'nopol' => 'required|string',
            'name' => 'required|string',
            'no_polish' => 'required|string',
            'rangka' => 'required|string|min:17|max:17',
            'mesin' => 'required|string',
            'tahun' => 'required|integer',
            'harga' => 'required|integer',
            'start' => 'required|string',
            'end' => 'required|string',
        ]);
        $insurance->update($validated);
        return redirect()->route('index')->with('success', 'Data Updated!');
    }

    public function export(Request $request)
    {
        $query = Insurance::query();

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('nopol', 'like', "%{$keyword}%");
            });
        }
        if ($request->filled('bulan')) {
            $query->whereMonth('end', $request->bulan)
                ->whereYear('end', Carbon::now()->year); // atau bisa request('tahun') kalau mau fleksibel
        }
        $filteredData = $query->get();
        return Excel::download(new InsuranceExport($filteredData), 'asuransi_filtered.xlsx');
    }

    public function exportPDF(Request $request)
    {
        $query = Insurance::query();

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('nopol', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('end', $request->bulan)
                ->whereYear('end', Carbon::now()->year);
        }

        $filteredData = $query->get();

        // Gunakan instance DomPDF
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('export_pdf', ['data' => $filteredData])
            ->setPaper('A4', 'portrait');

        return $pdf->download('asuransi.pdf');
    }

    // STNK
    // ----------------------------------------
    public function data_stnk(Request $request)
    {
        $title = 'STNK';
        $subtitle = 'HALAMAN STNK';
        $query = Stnk::query();

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $keyword = $request->keyword;
                $q->where('pemilik', 'like', '%' . $keyword . '%')
                    ->orWhere('nopol', 'like', '%' . $keyword . '%')
                    ->orWhere('type', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('pajak', $request->bulan)
                ->whereYear('pajak', Carbon::now()->year); // atau bisa request('tahun') kalau mau fleksibel
        }

        $stnk = $query->paginate(10)->withQueryString();
        $filteredData = $query->get();

        return view('stnk', compact('title', 'subtitle', 'stnk'));
    }

    public function create_stnk()
    {
        $title = "Create Data";
        $subtitle = "Create New Stnk";

        return view('create_stnk', compact('title', 'subtitle'));
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
        Stnk::create($validated);
        return redirect()->route('data.stnk')->with('success', 'Data Added!');
    }

    public function edit_stnk(Stnk $stnk)
    {
        $title = "Edit Data";
        $subtitle = "Edit Stnk";
        return view('edit_stnk', compact('title', 'subtitle', 'stnk'));
    }

    public function detail_stnk(Stnk $stnk)
    {
        $title = "Detail Data";
        $subtitle = "Detail Stnk";
        return view('detail_stnk', compact('title', 'subtitle', 'stnk'));
    }

    public function uploadPhoto(Request $request, Stnk $stnk)
    {
        $request->validate([
            'photo' => 'required|image|max:2048',
        ]);

        $path = $request->file('photo')->store('stnk_photos', 'public');
        $stnk->photo_path = $path;
        $stnk->save();

        return back()->with('success', 'Berhasil Diunggah');
    }


    public function update_stnk(Request $request, Stnk $stnk)
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
        $stnk->update($validated);
        return redirect()->route('data.stnk')->with('success', 'Data Updated!');
    }

    public function exportSTNK(Request $request)
    {
        $query = Stnk::query();

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $keyword = $request->keyword;
                $q->where('pemilik', 'like', '%' . $keyword . '%')
                    ->orWhere('nopol', 'like', '%' . $keyword . '%')
                    ->orWhere('type', 'like', '%' . $keyword . '%');
            });
        }
        if ($request->filled('bulan')) {
            $query->whereMonth('pajak', $request->bulan)
                ->whereYear('pajak', Carbon::now()->year); // atau bisa request('tahun') kalau mau fleksibel
        }
        $filteredData = $query->get();
        return Excel::download(new StnkExport($filteredData), 'stnk.xlsx');
    }

    public function exportPDFSTNK(Request $request)
    {
        $query = Stnk::query();

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $keyword = $request->keyword;
                $q->where('pemilik', 'like', '%' . $keyword . '%')
                    ->orWhere('nopol', 'like', '%' . $keyword . '%')
                    ->orWhere('type', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('pajak', $request->bulan)
                ->whereYear('pajak', Carbon::now()->year);
        }

        $filteredData = $query->get();

        // Gunakan instance DomPDF
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('export_pdf_stnk', ['data' => $filteredData])
            ->setPaper('A4', 'portrait');

        return $pdf->download('stnk.pdf');
    }

    public function deletePhoto(Stnk $stnk)
    {
        if ($stnk->photo_path && Storage::disk('public')->exists($stnk->photo_path)) {
            Storage::disk('public')->delete($stnk->photo_path);
        }

        $stnk->photo_path = null;
        $stnk->save();

        return back()->with('success', 'Berhasi Dihapus');
    }
}
