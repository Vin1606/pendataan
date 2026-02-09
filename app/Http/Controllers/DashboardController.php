<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $title = 'Dashboard';
        $subtitle = 'Ringkasan Kendaraan';
        $now = Carbon::now();

        $bulan = Carbon::now()->translatedFormat('F');
        $tahun = $now->year;

        // Hitung total kendaraan dengan asuransi bernama "Sunday"
        $totalAsuransiSunday = Kendaraan::whereHas('insurance', function ($q) {
            $q->where('name', 'like', '%sunday%');
        })->count();

        // Hitung total kendaraan dengan asuransi bernama "Bosowa"
        $totalAsuransiBosowa = Kendaraan::whereHas('insurance', function ($q) {
            $q->where('name', 'like', '%bosowa%');
        })->count();

        // Hitung total kendaraan dengan asuransi bernama "Sea"
        $totalAsuransiSea = Kendaraan::whereHas('insurance', function ($q) {
            $q->where('name', 'like', '%sea insure%');
        })->count();

        // Hitung total kendaraan dengan asuransi bernama "Abda"
        $totalAsuransiAbda = Kendaraan::whereHas('insurance', function ($q) {
            $q->where('name', 'like', '%abda%');
        })->count();

        // Hitung total kendaraan dengan asuransi bernama "Abda"
        $totalAsuransiMalaca = Kendaraan::whereHas('insurance', function ($q) {
            $q->where('name', 'like', '%malaca trust%');
        })->count();

        // Hitung total kendaraan dengan asuransi bernama "Etiqa"
        $totalAsuransiEtiqa = Kendaraan::whereHas('insurance', function ($q) {
            $q->where('name', 'like', '%etiqa%');
        })->count();

        // Hitung total kendaraan dengan asuransi mati bulan ini
        $totalAsuransiMati = Kendaraan::whereHas('insurance', function ($q) use ($now) {
            $q->whereMonth('end_insurance', $now->month)
                ->whereYear('end_insurance', $now->year);
        })->count();

        // Hitung total kendaraan dengan STNK mati bulan ini
        $totalStnkMati = Kendaraan::whereHas('stnk', function ($q) use ($now) {
            $q->whereMonth('pajak', $now->month)
                ->whereYear('pajak', $now->year);
        })->count();

        return view('dashboard', compact(
            'title',
            'subtitle',
            'bulan',
            'tahun',
            'totalAsuransiMati',
            'totalStnkMati',
            'totalAsuransiSunday',
            'totalAsuransiBosowa',
            'totalAsuransiSea',
            'totalAsuransiAbda',
            'totalAsuransiMalaca',
            'totalAsuransiEtiqa'
        ));
    }
}
