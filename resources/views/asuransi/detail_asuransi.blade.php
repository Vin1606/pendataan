<x-layout>
    {{-- JUDUL WEB --}}
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- JENIS HALAMAN --}}
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-lg">
        <form action="{{ route('update_asuransi', $kendaraan) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <!-- Nopol -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Polisi</label>
                <input type="text" name="nopol"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="{{ $kendaraan->nopol ?? '-' }}" />
                @error('nopol')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Asuransi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Asuransi</label>
                <select name="name"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                    <option selected>{{ $kendaraan->insurance->name ?? '-' }}</option>
                    <option value="Tidak Ada">Tidak Ada</option>
                    <option value="Sunday">Sunday</option>
                    <option value="Bosowa">Bosowa</option>
                    <option value="Abda">Abda</option>
                    <option value="Sea Insure">Sea Insure</option>
                    <option value="Sompo">Sompo</option>
                    <option value="Etiqa">Etiqa</option>
                    <option value="Malaca Trust">Malaca Trust</option>
                    <option value="ACA">ACA</option>
                    <option value="Zurich">Zurich</option>
                    <option value="Maximus Insurance">Maximus Insurance</option>
                    <option value="Takaful Insurance">Takaful Insurance</option>
                    <option value="BCA Insurance">BCA Insurance</option>
                </select>
            </div>

            <!-- No Polish -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Polish</label>
                <input type="text" name="no_polish" placeholder="Nomor Polish"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="{{ $kendaraan->insurance->no_polish ?? '-' }}" />
                @error('no_polish')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Rangka -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Rangka</label>
                <input type="text" name="rangka" placeholder="Nomor Rangka"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="{{ $kendaraan->rangka }}" />
                @error('rangka')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Mesin -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Mesin</label>
                <input type="text" name="mesin" placeholder="Nomor Mesin"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="{{ $kendaraan->mesin }}" />
                @error('mesin')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tahun -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                <input type="text" name="tahun" placeholder="Tahun"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="{{ $kendaraan->tahun }}" />
                @error('tahun')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Harga -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                <input type="text" name="harga" placeholder="Harga"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="{{ $kendaraan->insurance->harga ?? 0 }}" />
                @error('harga')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- End -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Berakhir</label>
                <input type="date" name="end_insurance"
                    class="w-full px-2 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="{{ $kendaraan->insurance->end_insurance ?? '-' }}" />
                @error('end_insurance')
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
