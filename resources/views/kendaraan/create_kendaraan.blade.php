<x-layout>
    {{-- JUDUL WEB --}}
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- JENIS HALAMAN --}}
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="max-w-6xl mx-auto bg-white p-8 rounded-xl shadow-lg">
        <form action="{{ route('store_kendaraan') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @csrf
            <!-- Nomor Polisi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Polisi</label>
                <input type="text" name="nopol" placeholder="Masukkan Nomor Polisi"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('nopol')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- No Polish -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Polish</label>
                <input type="text" name="no_polish" placeholder="Nomor Polish"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('no_polish')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- No Kir -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Kir</label>
                <input type="text" name="no_kir" placeholder="Masukkan Nomor KIR"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('no_kir')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Merk -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Merk</label>
                <input type="text" name="merk" placeholder="Masukkan Merk Kendaraan"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('merk')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Asuransi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Asuransi</label>
                <select name="name"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                    <option disabled selected>-- Pilih Asuransi --</option>
                    <option value="Sunday">Sunday</option>
                    <option value="Bosowa">Bosowa</option>
                    <option value="Abda">Abda</option>
                    <option value="Sea Insure">Sea Insure</option>
                    <option value="Sompo">Sompo</option>
                    <option value="Etiqa">Etiqa</option>
                    <option value="Malaca Trust">Malaca Trust</option>
                    <option value="ACA">ACA</option>
                    <option value="Zurich">Zurich</option>
                </select>
            </div>

            <!-- End Kir -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Berakhir Kir</label>
                <input type="date" name="end_kir"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('end_kir')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Type -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                <input type="text" name="type" placeholder="Masukkan Type Kendaraan"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('type')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Harga -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                <input type="text" name="harga" placeholder="Harga"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('harga')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Model -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Model</label>
                <input type="text" name="model" placeholder="Masukkan Model Kendaraan"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('model')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Silinder -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Isi Silinder</label>
                <input type="text" name="silinder" placeholder="Masukkan Isi Silinder Kendaraan"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('silinder')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- End -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Berakhir Asuransi</label>
                <input type="date" name="end_insurance"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('end_insurance')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Warna -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Warna Kendaraan</label>
                <input type="text" name="warna" placeholder="Masukkan Warna Kendaraan"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('warna')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nomor Rangka -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Rangka</label>
                <input type="text" name="rangka" placeholder="Masukkan Nomor Rangka"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('rangka')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nomor Mesin -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Mesin</label>
                <input type="text" name="mesin" placeholder="Masukkan Nomor Mesin"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('mesin')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tahun -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                <input type="text" name="tahun" placeholder="Masukkan Tahun Kendaraan"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('tahun')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Pemilik -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pemilik Kendaraan</label>
                <select name="pemilik"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                    <option disabled selected>Pemilik</option>
                    <option value="TFT">TFT</option>
                    <option value="RMA">RMA</option>
                    <option value="TERANG FAJAR">TERANG FAJAR</option>
                    <option value="JUNINGSIH SUTJIONO">JUNINGSIH SUTJIONO</option>
                </select>
            </div>

            <!-- Jenis Kendaraan -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kendaraan</label>
                <select name="jenis_kendaraan"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                    <option disabled selected>Jenis Kendaraan</option>
                    <option value="Dump Truck">Dump Truck</option>
                    <option value="Box">Box</option>
                    <option value="Bus">Bus</option>
                    <option value="Hiace">Hiace</option>
                    <option value="Pribadi">Pribadi</option>
                    <option value="Storing">Storing</option>
                </select>
            </div>


            <!-- Tanggal Plat -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Plat</label>
                <input type="date" name="plat"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('plat')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tanggal Pajak -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pajak</label>
                <input type="date" name="pajak"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                @error('pajak')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Simpan -->
            <div class="col-span-1 md:col-span-3">
                <button type="submit"
                    class="w-full bg-blue-700 hover:bg-blue-900 text-white py-3 rounded-lg font-semibold transition duration-300">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-layout>
