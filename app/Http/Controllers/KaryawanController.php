<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function data_karyawan(Request $request)
    {
        $title = 'KARYAWAN';
        $subtitle = 'HALAMAN KARYAWAN';
        $karyawans = Karyawan::paginate(10);
        return view('pegawai.karyawan', compact('title', 'subtitle', 'karyawans'));
    }

    public function create_karyawan()
    {
        $title = "Create Data";
        $subtitle = "Create New Karyawan";
        return view('pegawai.create_karyawan', compact('title', 'subtitle'));
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

    public function edit_karyawan(Karyawan $karyawan)
    {
        $karyawan = Karyawan::findOrFail($karyawan->id_karyawan);
        $title = "Edit Data";
        $subtitle = "Edit Karyawan";
        return view('pegawai.edit_karyawan', compact('title', 'subtitle', 'karyawan'));
    }

    public function update_karyawan(Request $request, Karyawan $karyawan)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'no_ktp' => 'required|string|unique:karyawan,no_ktp,' . $karyawan->id_karyawan . ',id_karyawan',
            'alamat' => 'required|string',
            'pekerjaan' => 'required|string',
        ]);

        $karyawan->update($validated);

        return redirect()->route('data.karyawan')->with('success', 'Data Updated!');
    }
}
