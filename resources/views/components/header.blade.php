@php
    $isAdmin = request()->is('admin/*');
@endphp

<header x-data="{ mobileOpen: false }" class="relative">
    <nav class="max-w-6xl mx-auto flex items-center justify-between px-4 sm:px-6 lg:px-8 py-4" aria-label="Global">
        {{-- Logo + Brand --}}
        <div class="flex lg:flex-1 items-center gap-3">
            <a href="{{ $isAdmin ? url('/admin/applications') : url('/') }}" class="-m-1.5 p-1.5 flex items-center gap-2">
                <span class="sr-only">IBINET</span>
                <img
                    class="h-9 w-auto rounded-md object-cover"
                    src="{{ asset('img/logo.png') }}"
                    alt="Logo IBINET"
                />
                <div class="flex flex-col">
                    <span class="font-semibold tracking-tight {{ $isAdmin ? 'text-slate-100' : 'text-blue-900' }}">
                        {{ $isAdmin ? 'IBINET HR DASHBOARD' : 'HR IBINET RECRUITMENT' }}
                    </span>

                    @if($isAdmin)
                        <span class="inline-flex items-center gap-1 mt-0.5 text-[10px] font-semibold px-2 py-0.5 rounded-full bg-amber-400/10 text-amber-300 border border-amber-400/40">
                            <span class="inline-block w-1 h-1 rounded-full bg-amber-300"></span>
                            ADMIN MODE
                        </span>
                    @endif
                </div>
            </a>
        </div>

        {{-- Desktop Nav Links --}}
        @if ($isAdmin)
            <div class="hidden lg:flex lg:gap-x-8 text-sm">
                <a href="{{ route('admin.applications.index') }}"
                   class="inline-flex items-center gap-1 text-slate-100 hover:text-blue-300 font-semibold transition">
                    {{-- Icon User List --}}
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="9" cy="7" r="3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17 11h4M19 9v4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Pelamar
                </a>
                <a href="{{ route('careers.index') }}"
                   class="inline-flex items-center gap-1 text-slate-400 hover:text-blue-300 transition">
                    {{-- Icon Globe --}}
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M3 12h18M12 3a15.3 15.3 0 0 1 4 9 15.3 15.3 0 0 1-4 9 15.3 15.3 0 0 1-4-9 15.3 15.3 0 0 1 4-9Z"/>
                    </svg>
                    Halaman Karier Publik
                </a>
            </div>
        @else
            <x-nav-bar />
        @endif

        {{-- Desktop Right Side --}}
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
            @if ($isAdmin)
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="inline-flex items-center gap-1 text-sm font-semibold text-rose-300 hover:text-rose-200 transition"
                    >
                        {{-- Icon Logout --}}
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15"/>
                            <path d="M12 9l3-3m0 0 3 3m-3-3v12" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            @else
                {{-- Publik: tanpa tombol login --}}
                <span class="text-xs text-slate-400"></span>
            @endif
        </div>

        {{-- Mobile button --}}
        <div class="flex lg:hidden">
            <button
                type="button"
                @click="mobileOpen = true"
                :aria-expanded="mobileOpen"
                class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5
                       {{ $isAdmin ? 'text-slate-100 hover:bg-slate-800' : 'text-blue-700 hover:bg-blue-50' }} transition"
            >
                <span class="sr-only">Open main menu</span>
                <svg class="size-6" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                          stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </nav>

    {{-- Mobile menu overlay --}}
    <div
        class="fixed inset-0 z-40 bg-slate-900/60 lg:hidden"
        x-show="mobileOpen"
        x-transition.opacity
        @click="mobileOpen = false"
        x-cloak
    ></div>

    {{-- Mobile menu panel --}}
    <div
        class="fixed inset-y-0 right-0 z-50 w-full max-w-sm {{ $isAdmin ? 'bg-slate-900 text-slate-100' : 'bg-white text-slate-900' }} p-6 shadow-xl border-l {{ $isAdmin ? 'border-slate-700' : 'border-blue-100' }} lg:hidden"
        x-show="mobileOpen"
        x-transition.opacity.duration.200ms
        x-transition.transform.duration.200ms
        @click.outside="mobileOpen = false"
        x-cloak
    >
        <div class="flex items-center justify-between">
            <a href="{{ $isAdmin ? url('/admin/applications') : url('/') }}" class="-m-1.5 p-1.5 flex items-center gap-2">
                <span class="sr-only">IBINET</span>
                <img
                    class="h-8 w-auto rounded-md object-cover"
                    src="{{ asset('img/logo.png') }}"
                    alt="Logo IBINET"
                >
                <span class="font-semibold tracking-tight">
                    {{ $isAdmin ? 'IBINET Admin' : 'IBINET' }}
                </span>
            </a>
            <button type="button"
                    @click="mobileOpen = false"
                    class="-m-2.5 rounded-md p-2.5 {{ $isAdmin ? 'text-slate-100 hover:bg-slate-800' : 'text-blue-700 hover:bg-blue-50' }} transition">
                <span class="sr-only">Close menu</span>
                <svg class="size-6" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path d="M6 18 18 6M6 6l12 12"
                          stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        <div class="mt-6 flow-root">
            <div class="-my-6 divide-y {{ $isAdmin ? 'divide-slate-700' : 'divide-blue-100' }}">
                <div class="space-y-2 py-6">
                    @if ($isAdmin)
                        <a href="{{ route('admin.applications.index') }}"
                           class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold hover:bg-slate-800 transition">
                            Pelamar
                        </a>
                        <a href="{{ route('careers.index') }}"
                           class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold hover:bg-slate-800 transition">
                            Halaman Karier Publik
                        </a>
                    @else
                        <a href="{{ url('/') }}"
                           class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-blue-900 hover:bg-blue-50 transition">
                            Beranda
                        </a>
                        <a href="{{ url('/careers') }}"
                           class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-blue-900 hover:bg-blue-50 transition">
                            Lowongan Kerja
                        </a>
                        <a href="{{ url('/about') }}"
                           class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-blue-900 hover:bg-blue-50 transition">
                            Tentang Kami
                        </a>
                        <a href="{{ url('/contact') }}"
                           class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-blue-900 hover:bg-blue-50 transition">
                            Kontak
                        </a>
                        <a href="{{ url('/blog') }}"
                           class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-blue-900 hover:bg-blue-50 transition">
                            Blog
                        </a>
                    @endif
                </div>

                <div class="py-6">
                    @if ($isAdmin)
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                type="submit"
                                class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold text-rose-300 hover:bg-rose-900/30 transition">
                                Keluar
                            </button>
                        </form>
                    @else
                        <span class="block text-xs text-slate-400 px-3"></span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>