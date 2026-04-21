<x-layout>
    {{-- JUDUL WEB --}}
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- JENIS HALAMAN --}}
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-lg">
        <form action="{{ route('store_stnk') }}" method="POST" class="space-y-5">
            @csrf
            <!-- Nopol -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Polisi</label>
                <input type="text" name="nopol" placeholder="Nomor Polisi"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('nopol')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Asuransi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Type Kendaraan</label>
                <select name="type"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                    <option disabled selected>Jenis Kendaraan</option>
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
                <input type="text" name="rangka" placeholder="Nomor Rangka"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('rangka')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Mesin -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Mesin</label>
                <input type="text" name="mesin" placeholder="Nomor Mesin"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('mesin')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tahun -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                <input type="text" name="tahun" placeholder="Tahun"
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
                    <option disabled selected>Pemilik</option>
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
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('plat')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Pajak -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pajak</label>
                <input type="date" name="pajak"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
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
