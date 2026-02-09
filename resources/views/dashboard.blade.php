<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:subtitle>{{ $subtitle }}</x-slot:subtitle>

    <style>
        .animated-border {
            height: 100px;
            width: 30%;
            margin: auto;
            background-color: transparent;
            position: relative;
            display: flex;
            place-content: center;
            place-items: center;
            overflow: hidden;
            border-radius: 20px;
        }

        .animated-border h2 {
            color: black;
            z-index: 1;
            font-size: 2em;
        }

        .animated-border::before {
            content: '';
            position: absolute;
            width: 120%;
            background-image: linear-gradient(180deg, rgb(0, 81, 255), rgba(0, 255, 48, 255));
            height: 90%;
            animation: rotBGimg 7s linear infinite;
            transition: all 7s linear;
        }

        @keyframes rotBGimg {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .animated-border::after {
            content: '';
            position: absolute;
            background: white;
            inset: 3px;
            border-radius: 15px;
        }
    </style>

    <div class="animated-border text-center rounded-lg mt-5 mb-4">
        <h2>
            <span>TIPE ASURANSI</span>
        </h2>
    </div>
    <div class="border-t bg-gray-100"></div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
        <div class="relative text-white rounded-lg shadow-md overflow-hidden" style="background-color: #fa4416;">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-4">
                <h2 class="text-xl font-semibold">Asuransi Sunday</h2>
                <div class="w-16 h-16 rounded-full overflow-hidden ring-2 ring-white">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLELCbkMr4w1E_gmRV7UDR9jjEG3ENTv4uNQ&s"
                        alt="Sunday" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-orange-900"></div>

            <!-- Footer -->
            <div class="px-4 py-3 bg-orange-800 text-sm font-medium">
                <span>Total Asuransi : {{ $totalAsuransiSunday }}</span>
            </div>
        </div>

        <div class="relative text-white rounded-lg shadow-md overflow-hidden" style="background-color: #9fc5ff;">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-4">
                <h2 class="text-xl font-semibold">Asuransi Bosowa</h2>
                <div class="w-30 h-16 overflow-hidden ">
                    <img src= "{{ asset('images/bosowa.png') }}" alt="Bosowa" class="w-full h-full">
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-blue-900"></div>

            <!-- Footer -->
            <div class="px-4 py-3 bg-blue-700 text-sm font-medium">
                <span>Total Asuransi : {{ $totalAsuransiBosowa }}</span>
            </div>
        </div>

        <div class="relative text-white rounded-lg shadow-md overflow-hidden" style="background-color: #ffa22f;">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-4">
                <h2 class="text-xl font-semibold">Asuransi Sea Insure</h2>
                <div class="w-[130px] h-16 overflow-hidden ">
                    <img src= "https://seainsure.co.id/static/images/logo.png" alt="Sea"
                        class="w-full h-full object-contain">
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-yellow-900"></div>

            <!-- Footer -->
            <div class="px-4 py-3 bg-yellow-800 text-sm font-medium">
                <span>Total Asuransi : {{ $totalAsuransiSea }}</span>
            </div>
        </div>

        <div class="relative text-white rounded-lg shadow-md overflow-hidden" style="background-color: #482c78;">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-4">
                <h2 class="text-xl font-semibold">Asuransi Abda</h2>
                <div class="w-[130px] h-16 overflow-hidden ">
                    <img src= "https://awsimages.detik.net.id/community/media/visual/2023/02/09/oona-insurance.jpeg?w=600&q=90"
                        alt="Abda" class="w-full h-full object-contain">
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-purple-900"></div>

            <!-- Footer -->
            <div class="px-4 py-3 bg-purple-800 text-sm font-medium">
                <span>Total Asuransi : {{ $totalAsuransiAbda }}</span>
            </div>
        </div>

        <div class="relative text-white rounded-lg overflow-hidden"
            style="background-color: #ffffff; box-shadow: 0 0 2px rgba(0, 0, 0, 0.5);">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-4">
                <h2 class="text-xl text-black font-semibold">Asuransi Malaca</h2>
                <div class="w-[130px] h-16 overflow-hidden ">
                    <img src= "https://cdn.prod.website-files.com/686b8334e2254170163a6b68/686b8334e2254170163a6e68_Malacca-Trust.png"
                        alt="Malaca" class="w-full h-full object-contain">
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-blue-900"></div>

            <!-- Footer -->
            <div class="px-4 py-3 bg-blue-800 text-sm font-medium">
                <span>Total Asuransi : {{ $totalAsuransiMalaca }}</span>
            </div>
        </div>

        <div class="relative text-white rounded-lg shadow-md overflow-hidden" style="background-color: #e35000;">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-4">
                <h2 class="text-xl font-semibold">Asuransi Etiqa</h2>
                <div class="w-[130px] h-16 overflow-hidden ">
                    <img src= "https://upload.wikimedia.org/wikipedia/commons/3/35/Etiqa_Insurance_and_Takaful.png"
                        alt="Abda" class="w-full h-full object-contain">
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-red-900"></div>

            <!-- Footer -->
            <div class="px-4 py-3 bg-red-800 text-sm font-medium">
                <span>Total Asuransi : {{ $totalAsuransiEtiqa }}</span>
            </div>
        </div>
    </div>

    <div class="animated-border text-center rounded-lg mt-5 mb-4">
        <h2>
            <span>MASA BERLAKU</span>
        </h2>
    </div>
    <div class="border-t bg-gray-100"></div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
        <div class="relative text-white rounded-lg shadow-md overflow-hidden" style="background-color: #e35000;">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-4">
                <h2 class="text-xl font-semibold">Asuransi</h2>
                <div class="text-xl font-semibold">
                    <i class="fa-solid fa-calendar"></i>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-red-900"></div>

            <!-- Footer -->
            <div class="px-4 py-3 bg-red-800 text-sm">
                <pre>Total : {{ $totalAsuransiMati }} </pre>
                <pre>Bulan : {{ $bulan }}</pre>
                <pre>Tahun : {{ $tahun }}</pre>
            </div>
        </div>

        <div class="relative text-white rounded-lg shadow-md overflow-hidden" style="background-color: #e35000;">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-4">
                <h2 class="text-xl font-semibold">STNK</h2>
                <div class="text-xl font-semibold">
                    <i class="fa-solid fa-calendar"></i>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-red-900"></div>

            <!-- Footer -->
            <div class="px-4 py-3 bg-red-800 text-sm">
                <pre>Total : {{ $totalStnkMati }} </pre>
                <pre>Bulan : {{ $bulan }}</pre>
                <pre>Tahun : {{ $tahun }}</pre>
            </div>
        </div>
    </div>

</x-layout>
