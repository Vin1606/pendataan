<x-layout>
    {{-- JUDUL WEB --}}
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- JENIS HALAMAN --}}
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <style>
        .form-card {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            max-width: 72rem;
            margin: 0 auto;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .form-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            outline: none;
            transition: all 0.2s ease;
            background-color: #f9fafb;
            font-size: 0.95rem;
        }

        .form-input:focus {
            background-color: #ffffff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .form-input.is-invalid {
            border-color: #ef4444;
            background-color: #fef2f2;
        }

        .form-input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
        }

        .error-msg {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 0.375rem;
            display: block;
        }

        .btn-container {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
        }

        @media (min-width: 768px) {
            .btn-container {
                grid-column: span 3;
            }
        }

        .btn {
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s;
            cursor: pointer;
            text-align: center;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-cancel {
            background-color: #f3f4f6;
            color: #4b5563;
        }

        .btn-cancel:hover {
            background-color: #e5e7eb;
            color: #1f2937;
        }

        .btn-save {
            background-color: #2563eb;
            color: #ffffff;
            box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
        }

        .btn-save:hover {
            background-color: #1d4ed8;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
            transform: translateY(-1px);
        }
    </style>

    <div class="form-card">
        <form action="{{ route('store_kendaraan') }}" method="POST" class="form-grid">
            @csrf
            <!-- Nomor Polisi -->
            <div>
                <label class="form-label">Nomor Polisi</label>
                <input type="text" name="nopol" value="{{ old('nopol') }}" placeholder="Masukkan Nomor Polisi"
                    class="form-input @error('nopol') is-invalid @enderror" />
                @error('nopol')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- No Polish -->
            <div>
                <label class="form-label">Nomor Polish</label>
                <input type="text" name="no_polish" value="{{ old('no_polish') }}" placeholder="Nomor Polish"
                    class="form-input @error('no_polish') is-invalid @enderror" />
                @error('no_polish')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- No Kir -->
            <div>
                <label class="form-label">Nomor Kir</label>
                <input type="text" name="no_kir" value="{{ old('no_kir') }}" placeholder="Masukkan Nomor KIR"
                    class="form-input @error('no_kir') is-invalid @enderror" />
                @error('no_kir')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Merk -->
            <div>
                <label class="form-label">Merk</label>
                <input type="text" name="merk" value="{{ old('merk') }}" placeholder="Masukkan Merk Kendaraan"
                    class="form-input @error('merk') is-invalid @enderror" />
                @error('merk')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Asuransi -->
            <div>
                <label class="form-label">Asuransi</label>
                <select name="name" class="form-input @error('name') is-invalid @enderror">
                    <option disabled {{ old('name') ? '' : 'selected' }}>-- Pilih Asuransi --</option>
                    @foreach (['Sunday', 'Bosowa', 'Abda', 'Sea Insure', 'Sompo', 'Etiqa', 'Malaca Trust', 'ACA', 'Zurich', 'Maximus Insurance', 'Takaful Insurance', 'BCA Insurance', 'Astra Buana', 'Avrist'] as $asuransi)
                        <option value="{{ $asuransi }}" {{ old('name') == $asuransi ? 'selected' : '' }}>
                            {{ $asuransi }}</option>
                    @endforeach
                </select>
                @error('name')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- End Kir -->
            <div>
                <label class="form-label">Tanggal Berakhir Kir</label>
                <input type="date" name="end_kir" value="{{ old('end_kir') }}"
                    class="form-input @error('end_kir') is-invalid @enderror" />
                @error('end_kir')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Type -->
            <div>
                <label class="form-label">Type</label>
                <input type="text" name="type" value="{{ old('type') }}" placeholder="Masukkan Type Kendaraan"
                    class="form-input @error('type') is-invalid @enderror" />
                @error('type')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Harga -->
            <div>
                <label class="form-label">Harga</label>
                <input type="text" name="harga" value="{{ old('harga') }}" placeholder="Harga"
                    class="form-input @error('harga') is-invalid @enderror" />
                @error('harga')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Model -->
            <div>
                <label class="form-label">Model</label>
                <input type="text" name="model" value="{{ old('model') }}" placeholder="Masukkan Model Kendaraan"
                    class="form-input @error('model') is-invalid @enderror" />
                @error('model')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Silinder -->
            <div>
                <label class="form-label">Isi Silinder</label>
                <input type="text" name="silinder" value="{{ old('silinder') }}"
                    placeholder="Masukkan Isi Silinder Kendaraan"
                    class="form-input @error('silinder') is-invalid @enderror" />
                @error('silinder')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- End -->
            <div>
                <label class="form-label">Tanggal Berakhir Asuransi</label>
                <input type="date" name="end_insurance" value="{{ old('end_insurance') }}"
                    class="form-input @error('end_insurance') is-invalid @enderror" />
                @error('end_insurance')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Warna -->
            <div>
                <label class="form-label">Warna Kendaraan</label>
                <input type="text" name="warna" value="{{ old('warna') }}" placeholder="Masukkan Warna Kendaraan"
                    class="form-input @error('warna') is-invalid @enderror" />
                @error('warna')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nomor Rangka -->
            <div>
                <label class="form-label">Nomor Rangka</label>
                <input type="text" name="rangka" value="{{ old('rangka') }}" placeholder="Masukkan Nomor Rangka"
                    class="form-input @error('rangka') is-invalid @enderror" />
                @error('rangka')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Nomor Mesin -->
            <div>
                <label class="form-label">Nomor Mesin</label>
                <input type="text" name="mesin" value="{{ old('mesin') }}" placeholder="Masukkan Nomor Mesin"
                    class="form-input @error('mesin') is-invalid @enderror" />
                @error('mesin')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tahun -->
            <div>
                <label class="form-label">Tahun</label>
                <input type="text" name="tahun" value="{{ old('tahun') }}"
                    placeholder="Masukkan Tahun Kendaraan" class="form-input @error('tahun') is-invalid @enderror" />
                @error('tahun')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Pemilik -->
            <div>
                <label class="form-label">Pemilik Kendaraan</label>
                <select name="pemilik" class="form-input @error('pemilik') is-invalid @enderror">
                    <option disabled {{ old('pemilik') ? '' : 'selected' }}>Pemilik</option>
                    @foreach (['TFT', 'RMA', 'TERANG FAJAR', 'JUNINGSIH SUTJIONO'] as $pemilik)
                        <option value="{{ $pemilik }}" {{ old('pemilik') == $pemilik ? 'selected' : '' }}>
                            {{ $pemilik }}</option>
                    @endforeach
                </select>
                @error('pemilik')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Jenis Kendaraan -->
            <div>
                <label class="form-label">Jenis Kendaraan</label>
                <select name="jenis_kendaraan" class="form-input @error('jenis_kendaraan') is-invalid @enderror">
                    <option disabled {{ old('jenis_kendaraan') ? '' : 'selected' }}>Jenis Kendaraan</option>
                    @foreach (['Dump Truck', 'Box', 'Bus', 'Hiace', 'Pribadi', 'Storing'] as $jenis)
                        <option value="{{ $jenis }}" {{ old('jenis_kendaraan') == $jenis ? 'selected' : '' }}>
                            {{ $jenis }}</option>
                    @endforeach
                </select>
                @error('jenis_kendaraan')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>


            <!-- Tanggal Plat -->
            <div>
                <label class="form-label">Tanggal Plat</label>
                <input type="date" name="plat" value="{{ old('plat') }}"
                    class="form-input @error('plat') is-invalid @enderror" />
                @error('plat')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tanggal Pajak -->
            <div>
                <label class="form-label">Tanggal Pajak</label>
                <input type="date" name="pajak" value="{{ old('pajak') }}"
                    class="form-input @error('pajak') is-invalid @enderror" />
                @error('pajak')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Simpan -->
            <div class="btn-container">
                <a href="{{ url()->previous() }}" class="btn btn-cancel">
                    Batal
                </a>
                <button type="submit" class="btn btn-save">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-layout>
