<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kendaraan::with(['insurance', 'stnk', 'kir']);

        // Jika ada pencarian
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('nopol', 'like', '%' . $keyword . '%')
                  ->orWhere('merk', 'like', '%' . $keyword . '%')
                  ->orWhere('pemilik', 'like', '%' . $keyword . '%');
            });
        }

        $kendaraan = $query->orderBy('jenis_kendaraan')->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Kendaraan',
            'data'    => $kendaraan
        ], 200);
    }
}
