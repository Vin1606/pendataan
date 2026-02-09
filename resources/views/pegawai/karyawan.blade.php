<x-layout>
    {{-- JUDUL HALAMAN --}}
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    @if (session('success'))
        <x-alert-success>
            {{ session('success') }}
        </x-alert-success>
    @endif

    {{-- Main Container --}}
    <div class="space-y-6">
        {{-- Toolbar: Actions & Filters --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                {{-- Left: Actions --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('create_karyawan') }}"
                        class="inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 text-white hover:bg-blue-700 rounded-lg text-sm font-medium shadow-sm transition-all duration-200">
                        <i class="fa-solid fa-plus mr-2"></i>
                        <span>Tambah Data</span>
                    </a>

                    <a href="#"
                        class="inline-flex items-center justify-center px-4 py-2.5 bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-200 rounded-lg text-sm font-medium transition-colors duration-200 group">
                        <i
                            class="fa-solid fa-file-pdf mr-2 text-rose-600 group-hover:scale-110 transition-transform"></i>
                        <span>Export PDF</span>
                    </a>
                </div>

                {{-- Right: Search --}}
                <form method="GET" action="" class="flex w-full md:w-auto">
                    <div class="relative w-full md:w-64 group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i
                                class="fa-solid fa-magnifying-glass text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                        </div>
                        <input type="text" name="keyword" placeholder="Cari Nama / KTP..."
                            value="{{ request('keyword') }}"
                            class="block w-full pl-10 pr-3 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-700 focus:bg-white focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all outline-none">
                    </div>
                </form>
            </div>
        </div>

        {{-- Data Table Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            {{-- Card Header --}}
            <div
                class="px-6 py-5 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Data Karyawan</h2>
                    <p class="text-xs text-gray-500 mt-1">Kelola data pegawai dan informasi pribadi</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead
                        class="bg-gray-50/50 text-gray-500 uppercase text-xs font-semibold tracking-wider border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-center w-16">No</th>
                            <th class="px-6 py-4">Profil Pegawai</th>
                            <th class="px-6 py-4">Alamat</th>
                            <th class="px-6 py-4 text-center w-24">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($karyawans->sortBy('nama')->values() as $index => $as)
                            <tr class="bg-white hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 text-center font-medium text-gray-400">
                                    {{ $karyawans->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center text-sm font-bold shadow-sm">
                                            {{ substr($as->nama, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-800">{{ $as->nama }}</div>
                                            <div class="text-xs text-gray-500 font-mono mt-0.5 flex items-center">
                                                <i class="fa-regular fa-id-card mr-1.5 text-gray-400"></i>
                                                {{ $as->no_ktp }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    <div class="flex items-start gap-2 max-w-xs">
                                        <i class="fa-solid fa-location-dot mt-1 text-gray-400 text-xs"></i>
                                        <span class="line-clamp-2 leading-relaxed">{{ $as->alamat }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('edit_karyawan', $as->id_karyawan) }}"
                                        class="group relative inline-flex w-8 h-8 rounded-lg bg-blue-50 text-blue-600 items-center justify-center hover:bg-blue-600 hover:text-white transition-all duration-200 shadow-sm hover:shadow-blue-200">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                        <span
                                            class="absolute bottom-full mb-2 hidden group-hover:block px-2 py-1 bg-gray-800 text-white text-xs rounded whitespace-nowrap z-20">Edit</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <i class="fa-solid fa-users-slash text-2xl text-gray-400"></i>
                                        </div>
                                        <p class="text-base font-medium">Belum ada data karyawan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($karyawans->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $karyawans->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layout>
