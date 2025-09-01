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
                <a href="{{ route('exportInsurance', request()->query()) }}"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm shadow hover:bg-green-700 transition">
                    <i class="fa-solid fa-file-excel mr-2"></i>Export Excel
                </a>

                <a href="{{ route('export.pdf', request()->query()) }}"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm shadow hover:bg-red-700 transition">
                    <i class="fa-solid fa-file-pdf mr-2"></i>Export PDF
                </a>
            </div>

            {{-- Form Filter --}}
            <form method="GET" action="{{ route('index') }}" class="flex flex-wrap gap-2 items-center">

                <input type="text" name="keyword" placeholder="Cari" value="{{ request('keyword') }}"
                    class="border border-gray-300 px-3 py-2 rounded text-sm w-full md:w-48">

                <select name="bulan" class="border border-gray-300 px-3 py-2 rounded text-sm w-full md:w-40">
                    <option value="">Pilih Bulan</option>
                    @foreach (range(1, 12) as $bulan)
                        <option value="{{ $bulan }}" {{ request('bulan') == $bulan ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                    class="bg-blue-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-700 transition">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>



    {{-- ALL ASURANSI --}}
    <div class="my-5">
        <div class="mb-3">
            <h1 class="font-bold">DATA ASURANSI SEMUA KENDARAAN</h1>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-max w-full text-sm mt-1">
                <thead class="bg-blue-500 text-white text-center sticky top-0 z-10">
                    <tr>
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Nomor Polisi</th>
                        <th class="border px-4 py-2">Asuransi</th>
                        <th class="border px-4 py-2">Nomor Polish</th>
                        <th class="border px-4 py-2">No.Rangka</th>
                        <th class="border px-4 py-2">No.Mesin</th>
                        <th class="border px-4 py-2">Tahun</th>
                        <th class="border px-4 py-2">Harga</th>
                        <th class="border px-4 py-2">Berakhir</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kendaraan as $index => $as)
                        <tr @if ($as->is_expired) style="background-color: #dc3545; color: white;"  
                            @elseif($as->is_upcoming) style="background-color: #fff3cd;" @endif
                            class="text-center text-xs">
                            <td class="border px-4 py-2">{{ $kendaraan->firstItem() + $index }}</td>
                            <td class="border px-4 py-2">{{ $as->nopol }}</td>
                            <td class="border px-4 py-2">{{ $as->insurance->name ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $as->insurance->no_polish ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ $as->rangka }}</td>
                            <td class="border px-4 py-2">{{ $as->mesin }}</td>
                            <td class="border px-2 py-2">{{ $as->tahun }}</td>
                            <td class="border px-2 py-2">
                                {{ $as->insurance?->harga ? Number::currency($as->insurance->harga, in: 'IDR') : '-' }}
                            </td>
                            <td class="border px-2 py-2">
                                {{ $as->insurance?->end_insurance ? \Carbon\Carbon::parse($as->insurance->end_insurance)->translatedFormat('d-m-Y') : '-' }}
                            </td>
                            <td class="border px-1 py-2">
                                <a href="{{ route('detail_asuransi', $as) }}" class="btn btn-primary text-xs"><i
                                        class="fa-solid fa-pen" style="font-size: 10px"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $kendaraan->links() }}
        </div>
    </div>
</x-layout>
