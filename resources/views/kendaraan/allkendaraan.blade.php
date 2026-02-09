<x-layout>
    {{-- JUDUL HALAMAN --}}
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    @if (session('success'))
        <div class="mb-4">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>
        </div>
    @endif

    {{-- Main Container --}}
    <div class="space-y-6">

        {{-- Toolbar: Actions & Filters --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                {{-- Left: Add Button --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('create_kendaraan') }}"
                        class="inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 text-white hover:bg-blue-700 rounded-lg text-sm font-medium shadow-sm shadow-blue-200 transition-all duration-200 active:scale-95">
                        <i class="fa-solid fa-plus mr-2"></i> Tambah Data
                    </a>
                </div>

                {{-- Right: Search & Filter --}}
                <form method="GET" action="{{ route('all.kendaraan') }}"
                    class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">

                    {{-- Search Input --}}
                    <div class="relative w-full sm:w-64 group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i
                                class="fa-solid fa-magnifying-glass text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                        </div>
                        <input type="text" name="keyword" placeholder="Cari Nopol, Merk..."
                            value="{{ request('keyword') }}"
                            class="block w-full pl-10 pr-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-700 focus:bg-white focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all outline-none">
                    </div>

                    {{-- Month Select --}}
                    <div class="relative w-full sm:w-48">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fa-regular fa-calendar text-gray-400"></i>
                        </div>
                        <select name="bulan"
                            class="block w-full pl-10 pr-8 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-700 focus:bg-white focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all outline-none appearance-none cursor-pointer">
                            <option value="">Semua Bulan</option>
                            @foreach (range(1, 12) as $bulan)
                                <option value="{{ $bulan }}" {{ request('bulan') == $bulan ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i class="fa-solid fa-chevron-down text-xs text-gray-400"></i>
                        </div>
                    </div>

                    <button type="submit"
                        class="inline-flex items-center justify-center px-5 py-2.5 bg-gray-800 hover:bg-gray-900 text-white rounded-lg text-sm font-medium shadow-sm transition-all duration-200 active:scale-95">
                        Filter
                    </button>
                </form>
            </div>
        </div>

        {{-- Data Table Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Data Semua Kendaraan</h2>
                    <p class="text-xs text-gray-500 mt-1">Total {{ $kendaraan->total() }} data ditemukan</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead
                        class="bg-gray-50/50 text-gray-500 uppercase text-xs font-semibold tracking-wider border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-center w-16">No</th>
                            <th class="px-6 py-4">Identitas</th>
                            <th class="px-6 py-4">Kendaraan</th>
                            <th class="px-6 py-4 text-center">Tahun</th>
                            <th class="px-6 py-4 text-center">Warna</th>
                            <th class="px-6 py-4">Pemilik</th>
                            <th class="px-6 py-4 text-center w-24">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($kendaraan as $index => $as)
                            <tr class="bg-white hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-center font-medium text-gray-400">
                                    {{ $kendaraan->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-gray-800 text-base">{{ $as->nopol }}</span>
                                        <span class="text-xs text-gray-500 mt-0.5">{{ $as->jenis_kendaraan }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-medium text-gray-700">{{ $as->merk }}</span>
                                        <span class="text-xs text-gray-500">{{ $as->type }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-2.5 py-1 rounded-md bg-gray-100 text-gray-600 text-xs font-medium border border-gray-200">
                                        {{ $as->tahun }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-gray-600">{{ $as->warna }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                                            <i class="fa-solid fa-user text-xs"></i>
                                        </div>
                                        <span class="font-medium text-gray-700">{{ $as->pemilik }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center">
                                        <a href="{{ route('edit_all', $as) }}"
                                            class="group relative w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all duration-200 shadow-sm hover:shadow-blue-200">
                                            <i class="fa-solid fa-pen text-xs"></i>
                                            <span
                                                class="absolute bottom-full mb-2 hidden group-hover:block px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap">Edit</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <i class="fa-solid fa-folder-open text-2xl text-gray-400"></i>
                                        </div>
                                        <p class="text-base font-medium">Tidak ada data ditemukan</p>
                                        <p class="text-sm mt-1">Coba ubah filter pencarian Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($kendaraan->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $kendaraan->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layout>
