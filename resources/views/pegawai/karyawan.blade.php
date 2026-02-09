<x-layout>
    {{-- JUDUL HALAMAN --}}
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    @if (session('success'))
        <x-alert-success>
            {{ session('success') }}
        </x-alert-success>
    @endif

    <div class="mt-4 py-4 px-4 bg-white rounded-lg shadow-sm">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            {{-- Tombol Aksi --}}
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('create_karyawan') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm shadow hover:bg-blue-700 transition">
                    <i class="fa-solid fa-plus mr-2"></i>Tambah Data
                </a>

                <a href="#"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm shadow hover:bg-red-700 transition">
                    <i class="fa-solid fa-file-pdf mr-2"></i>Export PDF
                </a>
            </div>
        </div>
    </div>


    {{-- ALL KARYAWAN --}}
    <div class="my-5">
        <div class="mb-3">
            <h1 class="font-bold">DATA KARYAWAN</h1>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-max w-full text-sm mt-1">
                <thead class="bg-blue-500 text-white text-center sticky top-0 z-10">
                    <tr>
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">No.KTP</th>
                        <th class="border px-4 py-2">Alamat</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($karyawans as $index => $as)
                        <tr class="text-center text-xs">
                            <td class="border px-4 py-2">{{ $karyawans->firstItem() + $index }}</td>
                            <td class="border px-4 py-2">{{ $as->nama }}</td>
                            <td class="border px-4 py-2">{{ $as->no_ktp }}</td>
                            <td class="border px-4 py-2">{{ $as->alamat }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('edit_karyawan', $as->id_karyawan) }}" class="btn btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6">
                {{ $karyawans->links() }}
            </div>
        </div>
    </div>
</x-layout>
