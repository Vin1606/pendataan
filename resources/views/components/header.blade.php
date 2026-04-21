<header class="relative bg-transparent mt-8 mb-2 z-10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            {{-- Page Title Section --}}
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/60 border border-slate-200 shadow-sm mb-3 backdrop-blur-md">
                    <div class="w-1.5 h-1.5 rounded-full bg-brand-500 animate-pulse"></div>
                    <span class="text-xs font-bold text-slate-600 tracking-wide uppercase">{{ date('l, d F Y') }}</span>
                </div>
                
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                    {{ $subtitle ?? 'Dashboard Overview' }}
                </h1>
                
                <div class="mt-2 flex items-center gap-2 text-sm font-semibold text-slate-500">
                    <a href="/Dashboard" class="hover:text-brand-600 transition-colors">
                        <i class="fa-solid fa-house mb-0.5"></i>
                    </a>
                    <span class="text-slate-300">/</span>
                    <span class="text-brand-600">{{ $subtitle ?? 'Overview' }}</span>
                </div>
            </div>
            
            {{-- Optional Right Side Action or Stats --}}
            <div class="hidden lg:flex items-center gap-3 opacity-90 hover:opacity-100 transition-opacity">
                <div class="flex flex-col items-end px-4 py-2 bg-white/70 backdrop-blur-md rounded-2xl border border-white shadow-sm">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Status Sistem</span>
                    <div class="flex items-center gap-2 mt-0.5">
                        <i class="fa-solid fa-circle-check text-emerald-500 text-sm"></i>
                        <span class="text-sm font-extrabold text-slate-700">All Systems Operational</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
