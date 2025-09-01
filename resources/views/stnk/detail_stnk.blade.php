<x-layout>
    {{-- JUDUL HALAMAN --}}
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    @if (session('success'))
        <x-alert-success>
            {{ session('success') }}
        </x-alert-success>
    @endif

    <div class="max-w-4xl mx-auto p-6 bg-white shadow-xl rounded-lg border border-gray-200">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 tracking-tight">Detail STNK</h2>

        <div class="grid grid-cols-3 gap-6 text-gray-700 text-sm">
            <div>
                <p class="mb-2"><span class="font-semibold text-gray-900">Nomor Polisi:</span> {{ $stnk->nopol }}</p>
                <p class="mb-2"><span class="font-semibold text-gray-900">Nama Pemilik:</span> {{ $stnk->pemilik }}</p>
            </div>
            <div>
                <p class="mb-2"><span class="font-semibold text-gray-900">Type Kendaraan:</span> {{ $stnk->type }}</p>
                <p class="mb-2"><span class="font-semibold text-gray-900">Tahun:</span> {{ $stnk->tahun }}</p>
            </div>
            <div>
                <p class="mb-2"><span class="font-semibold text-gray-900">Masa
                        Plat:</span> {{ \Carbon\Carbon::parse($stnk->plat)->translatedFormat('d-m-Y') }} </p>
                <p class="mb-2"><span class="font-semibold text-gray-900">Masa
                        Pajak:</span> {{ \Carbon\Carbon::parse($stnk->pajak)->translatedFormat('d-m-Y') }}
                </p>
            </div>
        </div>

        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">🖼️ Foto Tanda Terima</h3>
            @if ($stnk->photo_path)
                <div class="relative group w-full max-w-md">
                    <img src="{{ asset('storage/' . $stnk->photo_path) }}" alt="Foto STNK"
                        class="rounded-lg shadow-lg transition duration-300 group-hover:scale-105">
                    <form action="{{ route('photo.delete', $stnk) }}" method="POST"
                        class="absolute top-2 right-2 bg-white bg-opacity-80 rounded shadow px-2 py-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Hapus Foto"
                            class="text-red-600 hover:text-red-800 transition duration-200">
                            X
                        </button>
                    </form>
                </div>
            @else
                <p class="text-gray-500 italic">Belum ada foto diunggah.</p>
            @endif
        </div>

        <div class="mt-8">
            <form action="{{ route('stnk.upload', $stnk) }}" method="POST" enctype="multipart/form-data"
                class="bg-gray-50 p-4 rounded-lg border border-dashed border-gray-300">
                @csrf
                <label class="block mb-2 font-medium text-gray-700">📤 Unggah Foto Tanda Terima</label>
                <input type="file" name="photo"
                    class="block w-full text-sm text-gray-700 border border-gray-300 rounded px-3 py-2 mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
                    ⬆️ Upload
                </button>
            </form>
        </div>

        <div class="mt-4">
            <a href="{{ route('data.stnk') }}" class="btn btn-primary">&laquo; Kembali</a>
        </div>
    </div>
</x-layout>
