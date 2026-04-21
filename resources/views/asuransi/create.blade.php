<x-layout>
    {{-- JUDUL WEB --}}
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- JENIS HALAMAN --}}
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        <div class="mb-6 border-b border-gray-100 pb-4">
            <h2 class="text-xl font-bold text-gray-800">Form Tambah Data Asuransi</h2>
            <p class="text-sm text-gray-500 mt-1">Silakan lengkapi informasi kendaraan dan asuransi di bawah ini.</p>
        </div>

        <form action="{{ route('store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri: Informasi Kendaraan -->
                <div class="space-y-5">
                    <h3 class="text-lg font-semibold text-gray-700 border-l-4 border-blue-500 pl-3">Informasi Kendaraan
                    </h3>

                    <!-- Nopol -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Polisi</label>
                        <input type="text" name="nopol" placeholder="Contoh: B 1234 XYZ"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 outline-none" />
                        @error('nopol')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Rangka -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Rangka</label>
                        <input type="text" name="rangka" placeholder="Masukkan Nomor Rangka"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 outline-none" />
                        @error('rangka')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Mesin -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Mesin</label>
                        <input type="text" name="mesin" placeholder="Masukkan Nomor Mesin"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 outline-none" />
                        @error('mesin')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tahun -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tahun Pembuatan</label>
                        <input type="number" name="tahun" placeholder="Contoh: 2023" min="1900" max="2100"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 outline-none" />
                        @error('tahun')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Kolom Kanan: Informasi Asuransi -->
                <div class="space-y-5">
                    <h3 class="text-lg font-semibold text-gray-700 border-l-4 border-green-500 pl-3">Detail Asuransi
                    </h3>

                    <!-- Asuransi -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Provider Asuransi</label>
                        <div class="relative">
                            <select name="name"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 outline-none bg-white appearance-none">
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
                                <option value="Maximus Insurance">Maximus Insurance</option>
                                <option value="Takaful Insurance">Takaful Insurance</option>
                                <option value="BCA Insurance">BCA Insurance</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- No Polish -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Polis</label>
                        <input type="text" name="no_polish" placeholder="Masukkan Nomor Polis"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 outline-none" />
                        @error('no_polish')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Harga -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Harga Premi</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">Rp</span>
                            <input type="text" name="harga" placeholder="0"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 outline-none" />
                        </div>
                        @error('harga')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- End -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Berakhir</label>
                        <input type="date" name="end_insurance"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 outline-none" />
                        @error('end_insurance')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Tombol Simpan -->
            <div class="mt-8 pt-4 border-t border-gray-100 flex justify-end">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-semibold shadow-md hover:shadow-lg transition duration-300 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</x-layout>
