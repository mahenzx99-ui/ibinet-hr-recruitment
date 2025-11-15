<div class="hidden lg:flex lg:gap-x-10">

    @php
        $active = 'text-blue-700 font-semibold';
        $inactive = 'text-slate-600 hover:text-blue-600 transition';
    @endphp

    {{-- Beranda --}}
    <a href="{{ url('/') }}"
       class="relative group text-sm inline-flex items-center gap-1 {{ request()->is('/') ? $active : $inactive }}">
        {{-- Icon Home --}}
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M3 10.5 12 4l9 6.5v8.5a1.5 1.5 0 0 1-1.5 1.5h-6v-6h-3v6h-6A1.5 1.5 0 0 1 3 19z"
                  stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Beranda
        <span class="absolute left-0 -bottom-1 h-[2px] w-0 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
    </a>

    {{-- Lowongan Kerja --}}
    <a href="{{ url('/careers') }}"
       class="relative group text-sm inline-flex items-center gap-1 {{ request()->is('careers') ? $active : $inactive }}">
        {{-- Icon Briefcase --}}
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M9 6V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v1" stroke-linecap="round" stroke-linejoin="round"/>
            <rect x="3" y="7" width="18" height="13" rx="2" ry="2"/>
            <path d="M3 12h18" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Lowongan Kerja
        <span class="absolute left-0 -bottom-1 h-[2px] w-0 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
    </a>

    {{-- Tentang Kami --}}
    <a href="{{ url('/about') }}"
       class="relative group text-sm inline-flex items-center gap-1 {{ request()->is('about') ? $active : $inactive }}">
        {{-- Icon Info --}}
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 9v6M12 7h.01" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Tentang Kami
        <span class="absolute left-0 -bottom-1 h-[2px] w-0 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
    </a>

    {{-- Kontak --}}
    <a href="{{ url('/contact') }}"
       class="relative group text-sm inline-flex items-center gap-1 {{ request()->is('contact') ? $active : $inactive }}">
        {{-- Icon Phone --}}
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M5 4h3l2 5-2 1a11 11 0 0 0 5 5l1-2 5 2v3a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2Z"
                  stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Kontak
        <span class="absolute left-0 -bottom-1 h-[2px] w-0 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
    </a>

    {{-- Blog --}}
    <a href="{{ url('/blog') }}"
       class="relative group text-sm inline-flex items-center gap-1 {{ request()->is('blog') ? $active : $inactive }}">
        {{-- Icon Article --}}
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <rect x="5" y="4" width="14" height="16" rx="2"/>
            <path d="M8 8h8M8 12h5M8 16h3" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Blog
        <span class="absolute left-0 -bottom-1 h-[2px] w-0 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
    </a>

    {{-- Admin Panel → hanya bila admin --}}
    @if(Auth::check() && Auth::user()->is_admin)
        {{-- Link Pelamar --}}
        <a href="{{ route('admin.applications.index') }}"
           class="relative group text-sm inline-flex items-center gap-1 {{ request()->is('admin/applications') ? $active : $inactive }}">
            {{-- Icon Users --}}
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="9" cy="7" r="3"/>
                <path d="M22 21v-2a4 4 0 0 0-3-3.87" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M16 3.13a3 3 0 0 1 0 5.74" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Pelamar
            <span class="absolute left-0 -bottom-1 h-[2px] w-0 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
        </a>

        {{-- Link Kelola Lowongan --}}
        <a href="{{ route('admin.jobs.index') }}"
           class="relative group text-sm inline-flex items-center gap-1 {{ request()->is('admin/jobs') ? $active : $inactive }}">
            {{-- Icon Briefcase Settings --}}
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M9 6V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v1" stroke-linecap="round" stroke-linejoin="round"/>
                <rect x="3" y="7" width="18" height="13" rx="2" ry="2"/>
                <path d="M12 12.5a1.5 1.5 0 1 0 1.5 1.5A1.5 1.5 0 0 0 12 12.5Zm0-2v1M12 17v1"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Kelola Lowongan
            <span class="absolute left-0 -bottom-1 h-[2px] w-0 bg-blue-600 group-hover:w-full transition-all duration-300"></span>
        </a>
    @endif

</div>
