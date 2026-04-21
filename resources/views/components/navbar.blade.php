<nav class="glass sticky top-0 z-50 border-b border-white/40 shadow-sm" x-data="{ isOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">
            <!-- Logo & Desktop Nav -->
            <div class="flex items-center gap-10">
                <a href="/Dashboard" class="shrink-0 group flex items-center gap-3">
                    <div class="relative w-12 h-12 rounded-2xl bg-gradient-to-br from-brand-500 to-indigo-600 shadow-md shadow-brand-500/20 flex items-center justify-center p-2 transition-transform duration-300 group-hover:scale-105 group-hover:-rotate-3">
                        <img class="w-full h-full object-contain filter brightness-0 invert drop-shadow-md"
                            src="https://service.tftgrup.com/javax.faces.resource/images/TerangFajar-Logo.PNG.xhtml"
                            alt="Terang Fajar" />
                    </div>
                    <div class="hidden sm:flex flex-col">
                        <span class="font-extrabold text-xl tracking-tight text-slate-800 leading-tight group-hover:text-brand-600 transition-colors">TF <span class="text-brand-600">Grup</span></span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-[-2px]">Management</span>
                    </div>
                </a>

                <div class="hidden md:block">
                    <div class="flex items-center space-x-2">
                        <!-- Dashboard -->
                        <a href="/Dashboard"
                            class="{{ request()->is('Dashboard') ? 'bg-white shadow-sm text-brand-600 ring-1 ring-slate-200/60' : 'text-slate-500 hover:bg-slate-50/80 hover:text-slate-900' }} px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2.5 group">
                            <div class="w-7 h-7 rounded-lg {{ request()->is('Dashboard') ? 'bg-brand-50 text-brand-600' : 'bg-slate-100 text-slate-400 group-hover:bg-brand-50 group-hover:text-brand-500' }} flex items-center justify-center transition-colors">
                                <i class="fa-solid fa-chart-pie"></i>
                            </div>
                            Dashboard
                        </a>

                        <!-- Dropdown Data Master -->
                        <div x-data="{ open: false }" class="relative" @click.away="open = false" @mouseenter="open = true" @mouseleave="open = false">
                            @php
                                $masterRoutes = ['All', 'Asuransi', 'DataStnk', 'DataKir', 'DataKaryawan'];
                                $isMasterActive = in_array(request()->path(), $masterRoutes);
                                $currentMaster = 'Data Master';
                                if($isMasterActive) {
                                    if(request()->is('All')) $currentMaster = 'Data Kendaraan';
                                    elseif(request()->is('Asuransi')) $currentMaster = 'Data Asuransi';
                                    elseif(request()->is('DataStnk')) $currentMaster = 'Data STNK';
                                    elseif(request()->is('DataKir')) $currentMaster = 'Data KIR';
                                    elseif(request()->is('DataKaryawan')) $currentMaster = 'Data Karyawan';
                                }
                            @endphp

                            <button @click="open = !open"
                                class="{{ $isMasterActive ? 'bg-white shadow-sm text-brand-600 ring-1 ring-slate-200/60' : 'text-slate-500 hover:bg-slate-50/80 hover:text-slate-900' }} px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2.5 group">
                                <div class="w-7 h-7 rounded-lg {{ $isMasterActive ? 'bg-brand-50 text-brand-600' : 'bg-slate-100 text-slate-400 group-hover:bg-brand-50 group-hover:text-brand-500' }} flex items-center justify-center transition-colors">
                                    <i class="fa-solid fa-database"></i>
                                </div>
                                <span>{{ $currentMaster }}</span>
                                <i class="fa-solid fa-chevron-down text-[10px] ml-1 transition-transform duration-300" :class="{ 'rotate-180': open }"></i>
                            </button>

                            <div x-show="open" 
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-3 scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                x-transition:leave-end="opacity-0 translate-y-3 scale-95"
                                style="display: none;"
                                class="absolute left-0 mt-2 w-[240px] p-2.5 bg-white/95 backdrop-blur-xl rounded-2xl shadow-xl ring-1 ring-slate-200 overflow-hidden z-50">
                                
                                <div class="space-y-1">
                                    <a href="/All" class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->is('All') ? 'bg-brand-50 text-brand-700' : 'text-slate-600 hover:bg-slate-50 hover:text-brand-600' }} transition-colors group/nav">
                                        <div class="w-9 h-9 rounded-lg {{ request()->is('All') ? 'bg-white shadow-sm text-brand-600' : 'bg-slate-100 text-slate-500 group-hover/nav:bg-white group-hover/nav:text-brand-500 group-hover/nav:shadow-sm' }} flex items-center justify-center shrink-0 transition-all">
                                            <i class="fa-solid fa-car-side"></i>
                                        </div>
                                        Data Kendaraan
                                    </a>
                                    <a href="/Asuransi" class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->is('Asuransi') ? 'bg-brand-50 text-brand-700' : 'text-slate-600 hover:bg-slate-50 hover:text-brand-600' }} transition-colors group/nav">
                                        <div class="w-9 h-9 rounded-lg {{ request()->is('Asuransi') ? 'bg-white shadow-sm text-brand-600' : 'bg-slate-100 text-slate-500 group-hover/nav:bg-white group-hover/nav:text-brand-500 group-hover/nav:shadow-sm' }} flex items-center justify-center shrink-0 transition-all">
                                            <i class="fa-solid fa-shield-halved"></i>
                                        </div>
                                        Data Asuransi
                                    </a>
                                    <a href="/DataStnk" class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->is('DataStnk') ? 'bg-brand-50 text-brand-700' : 'text-slate-600 hover:bg-slate-50 hover:text-brand-600' }} transition-colors group/nav">
                                        <div class="w-9 h-9 rounded-lg {{ request()->is('DataStnk') ? 'bg-white shadow-sm text-brand-600' : 'bg-slate-100 text-slate-500 group-hover/nav:bg-white group-hover/nav:text-brand-500 group-hover/nav:shadow-sm' }} flex items-center justify-center shrink-0 transition-all">
                                            <i class="fa-solid fa-file-invoice"></i>
                                        </div>
                                        Data STNK
                                    </a>
                                    <a href="/DataKir" class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->is('DataKir') ? 'bg-brand-50 text-brand-700' : 'text-slate-600 hover:bg-slate-50 hover:text-brand-600' }} transition-colors group/nav">
                                        <div class="w-9 h-9 rounded-lg {{ request()->is('DataKir') ? 'bg-white shadow-sm text-brand-600' : 'bg-slate-100 text-slate-500 group-hover/nav:bg-white group-hover/nav:text-brand-500 group-hover/nav:shadow-sm' }} flex items-center justify-center shrink-0 transition-all">
                                            <i class="fa-solid fa-truck-fast"></i>
                                        </div>
                                        Data KIR
                                    </a>
                                    <a href="/DataKaryawan" class="flex items-center gap-3.5 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->is('DataKaryawan') ? 'bg-brand-50 text-brand-700' : 'text-slate-600 hover:bg-slate-50 hover:text-brand-600' }} transition-colors group/nav">
                                        <div class="w-9 h-9 rounded-lg {{ request()->is('DataKaryawan') ? 'bg-white shadow-sm text-brand-600' : 'bg-slate-100 text-slate-500 group-hover/nav:bg-white group-hover/nav:text-brand-500 group-hover/nav:shadow-sm' }} flex items-center justify-center shrink-0 transition-all">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                        Data Karyawan
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Pengaturan -->
                        <a href="/Pengaturan"
                            class="{{ request()->is('Pengaturan') ? 'bg-white shadow-sm text-brand-600 ring-1 ring-slate-200/60' : 'text-slate-500 hover:bg-slate-50/80 hover:text-slate-900' }} px-4 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2.5 group">
                            <div class="w-7 h-7 rounded-lg {{ request()->is('Pengaturan') ? 'bg-brand-50 text-brand-600' : 'bg-slate-100 text-slate-400 group-hover:bg-brand-50 group-hover:text-brand-500' }} flex items-center justify-center transition-colors">
                                <i class="fa-solid fa-gear"></i>
                            </div>
                            Pengaturan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Side (Profile) -->
            <div class="flex items-center gap-4">
                <div class="hidden md:block">
                    <div class="relative ml-3" x-data="{ openProfile: false }">
                        <button type="button" @click="openProfile = !openProfile" @click.away="openProfile = false"
                            class="flex items-center gap-3 p-1.5 pr-4 rounded-full bg-slate-50 hover:bg-white border border-slate-200 hover:border-slate-300 transition-all focus:outline-none focus:ring-2 focus:ring-brand-500/30">
                            <div class="relative inline-block">
                                <img class="h-9 w-9 rounded-full object-cover shadow-sm bg-white"
                                    src="https://ui-avatars.com/api/?name=Admin&background=bfdbfe&color=1e3a8a&bold=true&font-size=0.4"
                                    alt="Admin" />
                                <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-emerald-400 ring-2 ring-white"></span>
                            </div>
                            <div class="flex flex-col items-start leading-none">
                                <span class="text-sm font-bold text-slate-700">Admin</span>
                                <span class="text-[10px] font-bold text-slate-400 mt-0.5 uppercase tracking-wide">Administrator</span>
                            </div>
                            <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 ml-1 transition-transform" :class="{ 'rotate-180': openProfile }"></i>
                        </button>

                        <div x-show="openProfile" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-3 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 translate-y-3 scale-95"
                            style="display: none;"
                            class="absolute right-0 mt-3 w-64 p-2.5 bg-white/95 backdrop-blur-xl rounded-2xl shadow-xl ring-1 ring-slate-200 overflow-hidden z-50">
                            
                            <div class="px-3 py-3 border-b border-slate-100 mb-2 flex flex-col items-center text-center">
                                <img class="h-16 w-16 rounded-full object-cover mb-2 ring-4 ring-brand-50" src="https://ui-avatars.com/api/?name=Admin&background=bfdbfe&color=1e3a8a&bold=true" alt="Admin" />
                                <p class="text-sm font-extrabold text-slate-800">Admin TF Grup</p>
                                <p class="text-xs font-semibold text-slate-400 mt-0.5">admin@terangfajar.com</p>
                            </div>
                            
                            <div class="space-y-1">
                                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-brand-600 transition-colors">
                                    <i class="fa-regular fa-id-badge w-4 text-center"></i> Profil Saya
                                </a>
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button class="w-full flex items-center justify-center gap-2 mt-2 px-3 py-2.5 rounded-xl text-sm font-bold text-red-600 bg-red-50 hover:bg-red-100 hover:text-red-700 transition-colors shadow-sm">
                                        <i class="fa-solid fa-power-off"></i> Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="flex md:hidden">
                    <button type="button" @click="isOpen = !isOpen"
                        class="inline-flex items-center justify-center rounded-xl p-2.5 text-slate-500 hover:bg-slate-100 hover:text-brand-600 focus:outline-none transition-colors">
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
    </div>

    <!-- Mobile menu -->
    <div x-show="isOpen" class="md:hidden border-t border-slate-200/60 bg-white/95 backdrop-blur-xl" id="mobile-menu" style="display: none;">
        <div class="space-y-1.5 px-4 pb-4 pt-3">
            <a href="/Dashboard" class="{{ request()->is('Dashboard') ? 'bg-brand-50 text-brand-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} flex items-center gap-3 rounded-xl px-4 py-3 text-base font-semibold transition-colors">
                 <i class="fa-solid fa-chart-pie w-5 text-center {{ request()->is('Dashboard') ? 'text-brand-500' : 'text-slate-400' }}"></i> Dashboard
            </a>

            <!-- Mobile Dropdown for Data Master -->
            <div x-data="{ openMaster: false }">
                <button @click="openMaster = !openMaster" class="flex w-full items-center justify-between rounded-xl px-4 py-3 text-base font-semibold text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-database w-5 text-center text-slate-400"></i>
                        <span>Data Master</span>
                    </div>
                    <i class="fa-solid fa-chevron-down text-sm transition-transform duration-300" :class="{ 'rotate-180': openMaster }"></i>
                </button>
                
                <div x-show="openMaster" class="mt-1 space-y-1 pl-10 pr-2 pb-2">
                    <a href="/All" class="{{ request()->is('All') ? 'text-brand-600 font-bold' : 'text-slate-500 hover:text-brand-600 font-medium' }} block rounded-lg px-3 py-2.5 text-sm transition-colors">Data Kendaraan</a>
                    <a href="/Asuransi" class="{{ request()->is('Asuransi') ? 'text-brand-600 font-bold' : 'text-slate-500 hover:text-brand-600 font-medium' }} block rounded-lg px-3 py-2.5 text-sm transition-colors">Data Asuransi</a>
                    <a href="/DataStnk" class="{{ request()->is('DataStnk') ? 'text-brand-600 font-bold' : 'text-slate-500 hover:text-brand-600 font-medium' }} block rounded-lg px-3 py-2.5 text-sm transition-colors">Data STNK</a>
                    <a href="/DataKir" class="{{ request()->is('DataKir') ? 'text-brand-600 font-bold' : 'text-slate-500 hover:text-brand-600 font-medium' }} block rounded-lg px-3 py-2.5 text-sm transition-colors">Data KIR</a>
                    <a href="/DataKaryawan" class="{{ request()->is('DataKaryawan') ? 'text-brand-600 font-bold' : 'text-slate-500 hover:text-brand-600 font-medium' }} block rounded-lg px-3 py-2.5 text-sm transition-colors">Data Karyawan</a>
                </div>
            </div>

            <a href="/Pengaturan" class="{{ request()->is('Pengaturan') ? 'bg-brand-50 text-brand-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} flex items-center gap-3 rounded-xl px-4 py-3 text-base font-semibold transition-colors">
                <i class="fa-solid fa-gear w-5 text-center {{ request()->is('Pengaturan') ? 'text-brand-500' : 'text-slate-400' }}"></i> Pengaturan
            </a>
        </div>
        
        <div class="border-t border-slate-200/60 pb-5 pt-4 px-4">
            <div class="flex items-center rounded-xl bg-slate-50 p-3">
                <div class="shrink-0">
                    <img class="h-12 w-12 rounded-full border-2 border-white shadow-sm" src="https://ui-avatars.com/api/?name=Admin&background=bfdbfe&color=1e3a8a&bold=true" alt="" />
                </div>
                <div class="ml-4">
                    <div class="text-base font-bold text-slate-800">Admin User</div>
                    <div class="text-xs font-semibold text-slate-500">admin@terangfajar.com</div>
                </div>
            </div>
            
            <div class="mt-4 space-y-2">
                <form method="POST" action="/logout">
                    @csrf
                    <button class="w-full flex items-center justify-center gap-2 rounded-xl px-4 py-3 text-base font-bold text-red-600 bg-red-50 hover:bg-red-100 transition-colors">
                        <i class="fa-solid fa-power-off"></i> Sign out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
