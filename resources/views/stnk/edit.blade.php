<x-layout>
    {{-- JUDUL WEB --}}
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- JENIS HALAMAN --}}
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-lg">
        <form action="{{ route('update_stnk', $kendaraan) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <!-- Nopol -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Polisi</label>
                <input type="text" name="nopol" value="{{ $kendaraan->nopol }}"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('nopol')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Asuransi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kendaraan</label>
                <select name="type"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                    <option selected>{{ $kendaraan->jenis_kendaraan }}</option>
                    <option value="Dump Truck">Dump Truck</option>
                    <option value="Box">Box</option>
                    <option value="Bus">Bus</option>
                    <option value="Hiace">Hiace</option>
                    <option value="Pribadi">Pribadi</option>
                    <option value="Storing">Storing</option>
                </select>
            </div>

            <!-- Rangka -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Rangka</label>
                <input type="text" name="rangka" value="{{ $kendaraan->rangka }}"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('rangka')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Mesin -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Mesin</label>
                <input type="text" name="mesin" value="{{ $kendaraan->mesin }}"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('mesin')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tahun -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                <input type="text" name="tahun" value="{{ $kendaraan->tahun }}"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('tahun')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Pemilik -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pemilik Kendaraan</label>
                <select name="pemilik"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                    <option selected>{{ $kendaraan->pemilik }}</option>
                    <option value="TFT">TFT</option>
                    <option value="RMA">RMA</option>
                    <option value="TERANG FAJAR">TERANG FAJAR</option>
                    <option value="JUNINGSIH SUTJIONO">JUNINGSIH SUTJIONO</option>
                </select>
            </div>

            <!-- Plat -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Plat</label>
                <input type="date" name="plat"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="{{ $kendaraan->stnk->plat }}" />
                @error('plat')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Pajak -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pajak</label>
                <input type="date" name="pajak"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="{{ $kendaraan->stnk->pajak }}" />
                @error('pajak')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Simpan -->
            <div>
                <button type="submit"
                    class="w-full bg-blue-700 hover:bg-blue-900 text-white py-3 rounded-lg font-semibold transition duration-300">Simpan
                </button>
            </div>
        </form>
    </div>
</x-layout>
