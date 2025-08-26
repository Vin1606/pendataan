<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kir;
use App\Models\Stnk;
use App\Models\Karyawan;
use Barryvdh\DomPDF\Pdf;
use App\Models\Insurance;
use App\Models\Kendaraan;
use App\Exports\StnkExport;
use App\Enums\TypeInsurance;
use Illuminate\Http\Request;
use App\Exports\InsuranceExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{

    // ALL DATA KENDARAAN
    // ------------------------------------
    public function all(Request $request)
    {
        $title = 'KENDARAAN';
        $subtitle = 'HALAMAN KENDARAAN';
        $query = Kendaraan::with(['insurance', 'stnk']);

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($query) use ($keyword) {
                $query->whereHas('insurance', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('nopol', 'like', '%' . $keyword . '%')
                        ->orWhere('tahun', 'like', '%' . $keyword . '%');
                })
                    ->orWhereHas('stnk', function ($q) use ($keyword) {
                        $q->where('pajak', 'like', '%' . $keyword . '%')
                            ->orWhere('nopol', 'like', '%' . $keyword . '%');
                    });
            });
        }

        if ($request->filled('bulan')) {
            $query->whereHas('insurance', function ($q) use ($request) {
                $q->whereMonth('end_insurance', $request->bulan)
                    ->whereYear('end_insurance', $request->tahun ?? now()->year);
            })->orWhereHas('stnk', function ($q) use ($request) {
                $q->whereMonth('pajak', $request->bulan)
                    ->whereYear('pajak', $request->tahun ?? now()->year);
            });
        }
        $kendaraan = $query->paginate(10)->withQueryString();
        $filteredData = $query->get();
        return view('allkendaraan', compact('title', 'subtitle', 'kendaraan'));
    }

    public function createkendaraan()
    {
        $title = "Create Data";
        $subtitle = "Create New Kendaraan";

        return view('create_kendaraan', compact('title', 'subtitle'));
    }

    public function store_kendaraan(Request $request)
    {
        $validated = $request->validate([
            'nopol' => 'required|string|unique:kendaraan,nopol',
            'merk' => 'required|string',
            'type' => 'required|string',
            'model' => 'required|string',
            'silinder' => 'required|string',
            'warna' => 'required|string',
            'rangka' => 'required|string|min:17|max:17|unique:kendaraan,rangka',
            'mesin' => 'required|string|unique:kendaraan,mesin',
            'tahun' => 'required|integer',
            'pemilik' => 'required|string',
            'jenis_kendaraan' => 'required|string',
            'name' => 'nullable|string',
            'no_polish' => 'nullable|string',
            'harga' => 'nullable|integer',
            'end_insurance' => 'nullable|string',
            'plat' => 'required|string',
            'pajak' => 'required|string',
            'no_kir' => 'nullable|string',
            'end_kir' => 'nullable|string',
        ]);
        // Simpan kendaraan dulu
        $kendaraan = Kendaraan::create([
            'nopol' => $request->nopol,
            'merk' => $request->merk,
            'type' => $request->type,
            'model' => $request->model,
            'silinder' => $request->silinder,
            'warna' => $request->warna,
            'pemilik' => $request->pemilik,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'rangka' => $request->rangka,
            'mesin' => $request->mesin,
            'tahun' => $request->tahun,
        ]);
        // Simpan asuransi dengan referensi kendaraan
        if ($request->filled('name') || $request->filled('no_polish') || $request->filled('harga') || $request->filled('end_insurance')) {
            $kendaraan->insurance()->create([
                'id_kendaraan' => $kendaraan->id_kendaraan,
                'name' => $request->name,
                'no_polish' => $request->no_polish,
                'harga' => $request->harga,
                'end_insurance' => $request->end_insurance,
            ]);
        }
        // Simpan stnk dengan referensi kendaraan
        $kendaraan->stnk()->create([
            'id_kendaraan' => $kendaraan->id_kendaraan,
            'plat' => $request->plat,
            'pajak' => $request->pajak,
        ]);
        // Simpan kir jika ada
        if ($request->filled('no_kir') || $request->filled('end_kir')) {
            $kendaraan->kir()->create([
                'id_kendaraan' => $kendaraan->id_kendaraan,
                'no_kir' => $request->no_kir,
                'end_kir' => $request->end_kir,
            ]);
        }

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('all.kendaraan')->with('success', 'Data Added!');
    }

    public function editall(Kendaraan $kendaraan)
    {
        $title = "Edit Data";
        $subtitle = "Edit Kendaraan";
        return view('edit_all', compact('title', 'subtitle', 'kendaraan'));
    }

    public function update_all(Request $request, Kendaraan $kendaraan)
    {
        $validated = $request->validate([
            'nopol' => 'required|string',
            'merk' => 'required|string',
            'type' => 'required|string',
            'model' => 'required|string',
            'silinder' => 'required|string',
            'warna' => 'required|string',
            'rangka' => 'required|string|min:17|max:17',
            'mesin' => 'required|string',
            'tahun' => 'required|integer',
            'pemilik' => 'required|string',
            'jenis_kendaraan' => 'required|string',
            'name' => 'nullable|string',
            'no_polish' => 'nullable|string',
            'harga' => 'nullable|integer',
            'end_insurance' => 'nullable|string',
            'plat' => 'required|string',
            'pajak' => 'required|string',
            'no_kir' => 'nullable|string',
            'end_kir' => 'nullable|string',
        ]);
        // Simpan kendaraan dulu
        $kendaraan->update([
            'nopol' => $request->nopol,
            'merk' => $request->merk,
            'type' => $request->type,
            'model' => $request->model,
            'silinder' => $request->silinder,
            'warna' => $request->warna,
            'pemilik' => $request->pemilik,
            'jenis_kendaraan' => $request->jenis_kendaraan,
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
        // Simpan stnk dengan referensi kendaraan
        $kendaraan->stnk()->updateOrCreate(
            ['id_kendaraan' => $kendaraan->id_kendaraan], // ini kunci pencarian
            [ // ini data yang akan diupdate atau dibuat
                'plat' => $request->plat,
                'pajak' => $request->pajak,
            ]
        );
        // Simpan kir jika ada
        if ($request->filled('no_kir') || $request->filled('end_kir')) {
            $kendaraan->kir()->updateOrCreate(
                ['id_kendaraan' => $kendaraan->id_kendaraan], // ini kunci pencarian
                [ // ini data yang akan diupdate atau dibuat
                    'no_kir' => $request->no_kir,
                    'end_kir' => $request->end_kir,
                ]
            );
        } else {
            // Jika tidak ada data kir, hapus jika ada
            $kendaraan->kir()->delete();
        }
        // Redirect atau tampilkan pesan sukses
        return redirect()->route('all.kendaraan')->with('success', 'Data Updated!');
    }

    // ASURANSI
    // ------------------------------------
    public function index(Request $request)
    {
        $title = 'ASURANSI';
        $subtitle = 'HALAMAN ASURANSI';
        $query = Kendaraan::with('insurance');

        if ($request->filled('keyword')) {
            $query->whereHas('insurance', function ($q) use ($request) {
                $keyword = $request->keyword;
                $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('nopol', 'like', '%' . $keyword . '%')
                    ->orWhere('tahun', 'like', '%' . $keyword . '%');
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

        return view('asuransi', compact('title', 'subtitle', 'kendaraan'));
    }

    public function create_asuransi()
    {
        $title = "Create Data";
        $subtitle = "Create New Insurance";

        return view('create_asuransi', compact('title', 'subtitle'));
    }

    public function detail_asuransi(Kendaraan $kendaraan)
    {
        $title = "Detail Data";
        $subtitle = "Detail Insurance";
        return view('detail_asuransi', compact('title', 'subtitle', 'kendaraan'));
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

        $kendaraan = $query->paginate(10)->withQueryString();
        $filteredData = $query->get();

        return view('stnk', compact('title', 'subtitle', 'kendaraan'));
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
        return view('edit_stnk', compact('title', 'subtitle', 'kendaraan'));
    }

    // public function detail_stnk(Stnk $stnk)
    // {
    //     $title = "Detail Data";
    //     $subtitle = "Detail Stnk";
    //     return view('detail_stnk', compact('title', 'subtitle', 'stnk'));
    // }

    // public function uploadPhoto(Request $request, Stnk $stnk)
    // {
    //     $request->validate([
    //         'photo' => 'required|image|max:2048',
    //     ]);

    //     $path = $request->file('photo')->store('stnk_photos', 'public');
    //     $stnk->photo_path = $path;
    //     $stnk->save();

    //     return back()->with('success', 'Berhasil Diunggah');
    // }


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
        $pdf->loadView('export_pdf_stnk', ['data' => $filteredData])
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
        $pdf->loadView('surat_kuasa_stnk', ['data' => $filteredData], compact('kendaraan'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('surat-kuasa-stnk.pdf');
    }

    // public function deletePhoto(Stnk $stnk)
    // {
    //     if ($stnk->photo_path && Storage::disk('public')->exists($stnk->photo_path)) {
    //         Storage::disk('public')->delete($stnk->photo_path);
    //     }

    //     $stnk->photo_path = null;
    //     $stnk->save();

    //     return back()->with('success', 'Berhasi Dihapus');
    // }

    // KIR
    // ---------------------------------------
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

        return view('kir', compact('title', 'subtitle', 'kendaraan'));
    }

    public function edit_kir(Kendaraan $kendaraan)
    {
        $title = "Edit Data";
        $subtitle = "Edit Kir";
        $karyawans = Karyawan::all();
        return view('edit_kir', compact('title', 'subtitle', 'kendaraan', 'karyawans'));
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
        $pdf->loadView('surat_kuasa_kir', ['data' => $filteredData], compact('kendaraan'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('surat-kuasa-kir.pdf');
    }

    // Karyawan
    // ---------------------------------------
    public function data_karyawan(Request $request)
    {
        $title = 'KARYAWAN';
        $subtitle = 'HALAMAN KARYAWAN';
        $karyawans = Karyawan::paginate(10);
        return view('karyawan', compact('title', 'subtitle', 'karyawans'));
    }

    public function create_karyawan()
    {
        $title = "Create Data";
        $subtitle = "Create New Karyawan";

        return view('create_karyawan', compact('title', 'subtitle'));
    }

    public function store_karyawan(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'no_ktp' => 'required|string|unique:karyawan,no_ktp',
            'alamat' => 'required|string',
            'pekerjaan' => 'required|string',
        ]);
        Karyawan::create($validated);

        return redirect()->route('data.karyawan')->with('success', 'Data Added!');
    }
}
