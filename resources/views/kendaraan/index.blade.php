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
        <div class="bg-white/90 rounded-2xl shadow-sm border border-slate-200/60 p-5 backdrop-blur-xl">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5">
                {{-- Left: Add Button & Actions --}}
                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('create_kendaraan') }}"
                        class="inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white hover:from-blue-700 hover:to-indigo-700 rounded-xl text-sm font-medium shadow-md shadow-blue-200 transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0">
                        <i class="fa-solid fa-plus mr-2.5"></i> Tambah Data
                    </a>
                    
                    <div class="h-6 w-px bg-slate-200 hidden sm:block"></div>

                    <button type="submit" form="bulk-form" formaction="{{ route('tanda.terima.penyerahan.stnk.bulk') }}"
                        formtarget="_blank"
                        class="inline-flex items-center justify-center px-4 py-2.5 bg-white text-slate-600 hover:text-green-600 hover:bg-green-50 hover:border-green-200 border border-slate-200 rounded-xl text-sm font-medium shadow-sm transition-all duration-200"
                        onclick="if (document.querySelectorAll('.row-checkbox:checked').length === 0) { alert('Pilih setidaknya satu kendaraan.'); return false; }">
                        <i class="fa-solid fa-print mr-2 text-green-500"></i> Cetak Penyerahan
                    </button>
                    <button type="submit" form="bulk-form"
                        formaction="{{ route('tanda.terima.pengambilan.stnk.bulk') }}" formtarget="_blank"
                        class="inline-flex items-center justify-center px-4 py-2.5 bg-white text-slate-600 hover:text-orange-600 hover:bg-orange-50 hover:border-orange-200 border border-slate-200 rounded-xl text-sm font-medium shadow-sm transition-all duration-200"
                        onclick="if (document.querySelectorAll('.row-checkbox:checked').length === 0) { alert('Pilih setidaknya satu kendaraan.'); return false; }">
                        <i class="fa-solid fa-file-invoice mr-2 text-orange-500"></i> Cetak Pengambilan
                    </button>
                </div>

                {{-- Right: Search & Filter --}}
                <form method="GET" action="{{ route('all.kendaraan') }}"
                    class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">

                    {{-- Search Input --}}
                    <div class="relative w-full sm:w-64 group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <i class="fa-solid fa-magnifying-glass text-slate-400 group-focus-within:text-indigo-500 transition-colors"></i>
                        </div>
                        <input type="text" name="keyword" placeholder="Cari Nopol, Merk..."
                            value="{{ request('keyword') }}"
                            class="block w-full pl-10 pr-4 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:bg-white focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 transition-all outline-none placeholder-slate-400">
                    </div>

                    {{-- Month Select --}}
                    <div class="relative w-full sm:w-48 group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <i class="fa-regular fa-calendar text-slate-400 group-focus-within:text-indigo-500 transition-colors"></i>
                        </div>
                        <select name="bulan"
                            class="block w-full pl-10 pr-10 py-2.5 bg-slate-50/50 border border-slate-200 rounded-xl text-sm text-slate-700 focus:bg-white focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-500 transition-all outline-none appearance-none cursor-pointer">
                            <option value="" class="bg-white">Semua Bulan</option>
                            @foreach (range(1, 12) as $bulan)
                                <option value="{{ $bulan }}" {{ request('bulan') == $bulan ? 'selected' : '' }} class="bg-white">
                                    {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3.5 pointer-events-none">
                            <i class="fa-solid fa-chevron-down text-xs text-slate-400"></i>
                        </div>
                    </div>

                    <button type="submit"
                        class="inline-flex items-center justify-center px-5 py-2.5 bg-slate-800 hover:bg-slate-700 text-white rounded-xl text-sm font-medium shadow-sm shadow-slate-200 transition-all duration-200 active:scale-95 border border-slate-700">
                        Filter
                    </button>
                </form>
            </div>
        </div>

        {{-- Data Table Card --}}
        <form id="bulk-form" method="POST">
            @csrf
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden relative">
                {{-- Decorative background element --}}
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 opacity-80"></div>
                
                <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-white">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800 tracking-tight">Data Semua Kendaraan</h2>
                        <p class="text-xs text-slate-500 mt-1">Menampilkan total <span class="font-semibold text-indigo-600">{{ $kendaraan->count() }}</span> data ditemukan</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-slate-50/80 text-slate-600 uppercase text-xs font-semibold tracking-wider border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-4 text-center w-12">
                                    <input type="checkbox"
                                        onclick="document.querySelectorAll('.row-checkbox').forEach(checkbox => checkbox.checked = this.checked);"
                                        class="w-4 h-4 text-indigo-600 bg-white border-slate-300 rounded focus:ring-indigo-500 focus:ring-2 disabled:opacity-50 transition-colors cursor-pointer">
                                </th>
                                <th class="px-6 py-4 text-center w-16">No</th>
                                <th class="px-6 py-4">Identitas</th>
                                <th class="px-6 py-4">Kendaraan</th>
                                <th class="px-6 py-4 text-center">Tahun</th>
                                <th class="px-6 py-4 text-center">Warna</th>
                                <th class="px-6 py-4">Pemilik</th>
                                <th class="px-6 py-4 text-center w-24">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($kendaraan as $index => $as)
                                <tr class="hover:bg-slate-50/80 transition-all duration-200 group">
                                    <td class="px-6 py-4 text-center">
                                        <input type="checkbox" name="selected_ids[]" value="{{ $as->id_kendaraan }}"
                                            class="row-checkbox w-4 h-4 text-indigo-600 bg-white border-slate-300 rounded focus:ring-indigo-500 focus:ring-2 cursor-pointer transition-colors">
                                    </td>
                                    <td class="px-6 py-4 text-center font-medium text-slate-600">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex flex-col items-start gap-1.5">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-blue-50 border border-blue-200 text-blue-700 font-bold tracking-widest text-sm shadow-sm">
                                                {{ $as->nopol }}
                                            </span>
                                            <span class="text-xs font-medium text-slate-600 bg-slate-100 border border-slate-200 px-2 py-0.5 rounded-full">{{ $as->jenis_kendaraan }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 border border-slate-200 flex items-center justify-center text-slate-500 shadow-sm flex-shrink-0">
                                                <i class="fa-solid fa-car-side text-lg"></i>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="font-bold text-slate-800">{{ $as->merk }}</span>
                                                <span class="text-xs text-slate-500 mt-0.5">{{ $as->type }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center justify-center px-2.5 py-1 rounded-lg bg-orange-50 text-orange-600 text-xs font-semibold border border-orange-200">
                                            {{ $as->tahun }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="font-medium text-slate-600 capitalize">{{ $as->warna }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-50 to-purple-50 flex items-center justify-center text-indigo-600 border border-indigo-100 shadow-sm flex-shrink-0">
                                                <i class="fa-solid fa-user text-xs"></i>
                                            </div>
                                            <span class="font-semibold text-slate-700 line-clamp-1">{{ $as->pemilik }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2 opacity-100 sm:opacity-70 group-hover:opacity-100 transition-opacity duration-200">
                                            <a href="{{ route('edit_all', $as) }}"
                                                class="relative w-8 h-8 rounded-lg bg-white border border-slate-200 text-blue-600 flex items-center justify-center hover:bg-blue-50 hover:text-blue-700 hover:border-blue-200 transition-all duration-200 shadow-sm group/btn"
                                                title="Edit Data">
                                                <i class="fa-solid fa-pen text-xs"></i>
                                            </a>
                                            <!-- Dropdown Tanda Terima -->
                                            <div class="relative" x-data="{ open: false }">
                                                <button @click.prevent="open = !open" type="button"
                                                    class="relative w-8 h-8 rounded-lg bg-white border border-slate-200 text-slate-500 flex items-center justify-center hover:bg-slate-50 hover:text-slate-700 hover:border-slate-300 transition-all duration-200 shadow-sm"
                                                    title="Menu Cetak">
                                                    <i class="fa-solid fa-ellipsis-vertical text-xs"></i>
                                                </button>
                                                <div x-show="open" @click.away="open = false" style="display: none;"
                                                    class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg z-30 border border-slate-200 overflow-hidden font-medium"
                                                    x-transition:enter="transition ease-out duration-150"
                                                    x-transition:enter-start="transform opacity-0 scale-95 translate-y-2"
                                                    x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
                                                    x-transition:leave="transition ease-in duration-100"
                                                    x-transition:leave-start="transform opacity-100 scale-100 translate-y-0"
                                                    x-transition:leave-end="transform opacity-0 scale-95 translate-y-2">
                                                    <div class="p-1.5 flex flex-col gap-1">
                                                        <a href="{{ route('tanda.terima.penyerahan.stnk', $as) }}"
                                                            target="_blank"
                                                            class="flex items-center gap-2.5 w-full text-left px-3 py-2 text-sm text-slate-600 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors">
                                                            <i class="fa-solid fa-print text-green-600 w-4 text-center"></i> Penyerahan STNK
                                                        </a>
                                                        <a href="{{ route('tanda.terima.pengambilan.stnk', $as) }}"
                                                            target="_blank"
                                                            class="flex items-center gap-2.5 w-full text-left px-3 py-2 text-sm text-slate-600 hover:bg-orange-50 hover:text-orange-700 rounded-lg transition-colors">
                                                            <i class="fa-solid fa-file-invoice text-orange-600 w-4 text-center"></i> Pengambilan STNK
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-16 text-center text-slate-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-20 h-20 bg-slate-50 border border-slate-200 rounded-full flex items-center justify-center mb-5 shadow-inner">
                                                <i class="fa-solid fa-car-side text-3xl text-slate-400"></i>
                                            </div>
                                            <p class="text-lg font-bold text-slate-800">Tidak ada data ditemukan</p>
                                            <p class="text-sm mt-1.5 text-slate-500 max-w-sm mx-auto">Coba ubah filter pencarian Anda atau tambahkan kendaraan baru ke dalam sistem.</p>
                                            <a href="{{ route('create_kendaraan') }}" class="mt-4 inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-200 text-indigo-600 hover:bg-indigo-50 hover:border-indigo-200 hover:text-indigo-700 rounded-lg text-sm font-medium transition-all shadow-sm">
                                                <i class="fa-solid fa-plus mr-2"></i> Tambah Data Sekarang
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            {{-- Pagination --}}
            @if ($kendaraan->total() > 0)
                <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-slate-500">Show</span>
                        <select onchange="window.location.href=this.value" class="bg-white border border-slate-200 text-slate-700 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block py-1.5 pl-2 pr-6 outline-none cursor-pointer">
                            <option value="{{ request()->fullUrlWithQuery(['per_page' => 10]) }}" @if(request('per_page') == 10 || !request('per_page')) selected @endif>10</option>
                            <option value="{{ request()->fullUrlWithQuery(['per_page' => 50]) }}" @if(request('per_page') == 50) selected @endif>50</option>
                            <option value="{{ request()->fullUrlWithQuery(['per_page' => 'all']) }}" @if(request('per_page') == 'all') selected @endif>All</option>
                        </select>
                        <span class="text-sm text-slate-500">entries</span>
                    </div>
                    <div class="w-full sm:w-auto">
                        {{ $kendaraan->links() }}
                    </div>
                </div>
            @endif
            </div>
        </form>
    </div>
</x-layout>
