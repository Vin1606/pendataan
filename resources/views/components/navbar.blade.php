<nav class="bg-white border-b border-gray-200 sticky top-0 z-50" x-data="{ isOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <!-- Logo & Desktop Nav -->
            <div class="flex items-center gap-8">
                <div class="shrink-0">
                    <img class="h-10 w-auto"
                        src="https://service.tftgrup.com/javax.faces.resource/images/TerangFajar-Logo.PNG.xhtml"
                        alt="Terang Fajar" />
                </div>
                <div class="hidden md:block">
                    <div class="flex items-center space-x-4">
                        <!-- Dashboard -->
                        <a href="/Dashboard"
                            class="{{ request()->is('Dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} rounded-md px-3 py-2 text-sm font-medium transition-colors duration-200">
                            Dashboard
                        </a>

                        <!-- Dropdown Data Master -->
                        <div x-data="{ open: false }" class="relative" @click.away="open = false">
                            @php
                                $currentMaster = 'Data Master';
                                $isMasterActive = false;
                                if (
                                    request()->is('All') ||
                                    request()->is('Asuransi') ||
                                    request()->is('DataStnk') ||
                                    request()->is('DataKir') ||
                                    request()->is('DataKaryawan')
                                ) {
                                    $isMasterActive = true;
                                    if (request()->is('All')) {
                                        $currentMaster = 'Data Kendaraan';
                                    } elseif (request()->is('Asuransi')) {
                                        $currentMaster = 'Data Asuransi';
                                    } elseif (request()->is('DataStnk')) {
                                        $currentMaster = 'Data STNK';
                                    } elseif (request()->is('DataKir')) {
                                        $currentMaster = 'Data KIR';
                                    } elseif (request()->is('DataKaryawan')) {
                                        $currentMaster = 'Data Karyawan';
                                    }
                                }
                            @endphp

                            <button @click="open = !open"
                                class="{{ $isMasterActive ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group inline-flex items-center rounded-md px-3 py-2 text-sm font-medium focus:outline-none transition-colors duration-200">
                                <span>{{ $currentMaster }}</span>
                                <svg class="{{ $isMasterActive ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-500' }} ml-2 h-4 w-4 transition-transform duration-200"
                                    :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            {{-- phpcs:disable --}}
                            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-1"
                                class="absolute left-0 z-10 mt-2 w-56 origin-top-left rounded-xl bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                style="display: none;">
                                <div class="px-1 py-1">
                                    <a href="/All"
                                        class="{{ request()->is('All') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }} group flex w-full items-center rounded-md px-2 py-2 text-sm">
                                        Data Kendaraan
                                    </a>
                                    <a href="/Asuransi"
                                        class="{{ request()->is('Asuransi') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }} group flex w-full items-center rounded-md px-2 py-2 text-sm">
                                        Data Asuransi
                                    </a>
                                    <a href="/DataStnk"
                                        class="{{ request()->is('DataStnk') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }} group flex w-full items-center rounded-md px-2 py-2 text-sm">
                                        Data STNK
                                    </a>
                                    <a href="/DataKir"
                                        class="{{ request()->is('DataKir') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }} group flex w-full items-center rounded-md px-2 py-2 text-sm">
                                        Data KIR
                                    </a>
                                    <a href="/DataKaryawan"
                                        class="{{ request()->is('DataKaryawan') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }} group flex w-full items-center rounded-md px-2 py-2 text-sm">
                                        Data Karyawan
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Pengaturan -->
                        <a href="/Pengaturan"
                            class="{{ request()->is('Pengaturan') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} rounded-md px-3 py-2 text-sm font-medium transition-colors duration-200">
                            Pengaturan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Side (Profile) -->
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <!-- Profile dropdown -->
                    <div class="relative ml-3" x-data="{ openProfile: false }">
                        <button type="button" @click="openProfile = !openProfile" @click.away="openProfile = false"
                            class="relative flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                            id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full object-cover border border-gray-200"
                                src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff"
                                alt="" />
                        </button>

                        <div x-show="openProfile" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            style="display: none;">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Your
                                Profile</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Settings</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Sign
                                    out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex md:hidden">
                <button type="button" @click="isOpen = !isOpen"
                    class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <span class="sr-only">Open main menu</span>
                    <svg :class="{ 'hidden': isOpen, 'block': !isOpen }" class="block h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg :class="{ 'block': isOpen, 'hidden': !isOpen }" class="hidden h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="isOpen" class="md:hidden border-t border-gray-200" id="mobile-menu" style="display: none;">
        <div class="space-y-1 px-2 pb-3 pt-2">
            <a href="/Dashboard"
                class="{{ request()->is('Dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} block rounded-md px-3 py-2 text-base font-medium">Dashboard</a>

            <!-- Mobile Dropdown for Data Master -->
            <div x-data="{ openMaster: false }">
                <button @click="openMaster = !openMaster"
                    class="flex w-full items-center justify-between rounded-md px-3 py-2 text-base font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                    <span>Data Master</span>
                    <svg class="h-4 w-4 transform transition-transform duration-200"
                        :class="{ 'rotate-180': openMaster }" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="openMaster" class="space-y-1 pl-4">
                    <a href="/All"
                        class="{{ request()->is('All') ? 'text-blue-700' : 'text-gray-500 hover:text-gray-900' }} block rounded-md px-3 py-2 text-sm font-medium">Data
                        Kendaraan</a>
                    <a href="/Asuransi"
                        class="{{ request()->is('Asuransi') ? 'text-blue-700' : 'text-gray-500 hover:text-gray-900' }} block rounded-md px-3 py-2 text-sm font-medium">Data
                        Asuransi</a>
                    <a href="/DataStnk"
                        class="{{ request()->is('DataStnk') ? 'text-blue-700' : 'text-gray-500 hover:text-gray-900' }} block rounded-md px-3 py-2 text-sm font-medium">Data
                        STNK</a>
                    <a href="/DataKir"
                        class="{{ request()->is('DataKir') ? 'text-blue-700' : 'text-gray-500 hover:text-gray-900' }} block rounded-md px-3 py-2 text-sm font-medium">Data
                        KIR</a>
                    <a href="/DataKaryawan"
                        class="{{ request()->is('DataKaryawan') ? 'text-blue-700' : 'text-gray-500 hover:text-gray-900' }} block rounded-md px-3 py-2 text-sm font-medium">Data
                        Karyawan</a>
                </div>
            </div>

            <a href="/Pengaturan"
                class="{{ request()->is('Pengaturan') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} block rounded-md px-3 py-2 text-base font-medium">Pengaturan</a>
        </div>
        <div class="border-t border-gray-200 pb-3 pt-4">
            <div class="flex items-center px-5">
                <div class="shrink-0">
                    <img class="h-10 w-10 rounded-full border border-gray-200"
                        src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff" alt="" />
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium text-gray-800">Admin User</div>
                    <div class="text-sm font-medium text-gray-500">admin@example.com</div>
                </div>
            </div>
            <div class="mt-3 space-y-1 px-2">
                <a href="#"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">Your
                    Profile</a>
                <a href="#"
                    class="block rounded-md px-3 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">Settings</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="block w-full text-left rounded-md px-3 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">Sign
                        out</button>
                </form>
            </div>
        </div>
    </div>
</nav>
