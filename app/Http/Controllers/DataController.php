<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class DataController extends Controller
{
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
                        ->orWhere('tahun', 'like', '%' . $keyword . '%')
                        ->orWhere('pemilik', 'like', '%' . $keyword . '%');
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
        $kendaraan = $query->orderBy('jenis_kendaraan')->paginate(10)->withQueryString();
        $filteredData = $query->get();
        return view('kendaraan.allkendaraan', compact('title', 'subtitle', 'kendaraan'));
    }

    public function createkendaraan()
    {
        $title = "Create Data";
        $subtitle = "Create New Kendaraan";

        return view('kendaraan.create_kendaraan', compact('title', 'subtitle'));
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
        return view('kendaraan.edit_all', compact('title', 'subtitle', 'kendaraan'));
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
}
