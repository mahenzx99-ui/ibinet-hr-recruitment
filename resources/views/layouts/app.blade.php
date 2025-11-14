@php
    $isAdmin = request()->is('admin/*');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'IBINET' }}</title>

    <!-- Font Modern -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    />

    <!-- Tailwind via Vite -->
    @vite('resources/css/app.css')

    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="{{ $isAdmin ? 'bg-slate-950 text-slate-100' : 'bg-white text-slate-800' }} antialiased relative overflow-x-hidden">

    {{-- BACKGROUND HANYA UNTUK PUBLIK --}}
    @unless($isAdmin)
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <!-- Gradient Wave Left -->
            <div class="absolute -top-32 -left-40 w-[32rem] h-[32rem] bg-blue-500/20 blur-3xl rounded-full animate-pulse"></div>

            <!-- Gradient Wave Right -->
            <div class="absolute -bottom-40 -right-40 w-[36rem] h-[36rem] bg-blue-400/20 blur-3xl rounded-full animate-pulse"></div>

            <!-- Soft Moving Shine (telecom effect) -->
            <div
                class="absolute inset-x-0 top-1/2 h-40 bg-gradient-to-r from-blue-300/0 via-blue-500/15 to-blue-300/0 blur-2xl animate-[shine_6s_infinite]"
            ></div>

            <style>
                @keyframes shine {
                    0% { transform: translateX(-100%); }
                    50% { transform: translateX(40%); }
                    100% { transform: translateX(120%); }
                }
            </style>

            <!-- Signal Pulse Dot -->
            <div class="absolute right-10 top-28 flex items-center gap-2">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-600"></span>
                </span>
                <span class="text-xs text-blue-700">Network Active</span>
            </div>
        </div>
    @endunless

    {{-- NAVBAR GLOBAL --}}
    <div class="{{ $isAdmin
            ? 'bg-slate-900/95 border-b border-slate-800 shadow-sm fixed w-full top-0 z-30'
            : 'backdrop-blur-md bg-white/70 border-b border-blue-100 shadow-sm fixed w-full top-0 z-30' }}">
        <x-header />
    </div>

    {{-- CONTENT --}}
    <main class="pt-28 pb-16">
        <div
            x-data="{ show: false }"
            x-init="setTimeout(() => show = true, 150)"
            x-show="show"
            x-transition.opacity.duration.500ms
            x-transition.transform.duration.500ms
            x-transition.scale.origin-top
        >
            <div class="max-w-6xl mx-auto px-6">
                @yield('content')
            </div>
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="mt-16 {{ $isAdmin ? 'bg-slate-900 border-t border-slate-800' : 'bg-white/80 backdrop-blur border-t border-blue-100' }}">
        <div class="max-w-6xl mx-auto px-6 py-6 flex flex-col md:flex-row justify-between items-center gap-4 text-sm {{ $isAdmin ? 'text-slate-300' : 'text-blue-700' }}">
            
            <div class="flex items-center gap-3">
                <div class="{{ $isAdmin ? 'bg-blue-500 text-white' : 'bg-blue-600 text-white' }} w-10 h-10 rounded-xl flex items-center justify-center shadow-lg">
                    IB
                </div>
                <div>
                    <p class="font-semibold {{ $isAdmin ? 'text-slate-100' : 'text-blue-900' }}">IBINET Global Nusatindo</p>
                    <p class="text-xs {{ $isAdmin ? 'text-slate-400' : 'text-blue-600' }}">Telecommunication & Internet Service Provider</p>
                </div>
            </div>

            <div class="flex items-center gap-3 text-xs {{ $isAdmin ? 'text-slate-400' : 'text-blue-600' }}">
                <span class="flex items-center gap-1">
                    <span class="inline-flex h-2 w-2 rounded-full {{ $isAdmin ? 'bg-emerald-400' : 'bg-blue-500' }} animate-pulse"></span>
                    {{ $isAdmin ? 'Dashboard Admin Aktif' : 'Monitoring Live' }}
                </span>
                <span class="hidden md:inline {{ $isAdmin ? 'text-slate-600' : 'text-blue-400' }}">•</span>
                <span>© {{ date('Y') }} IBINET. All Rights Reserved</span>
            </div>
        </div>
    </footer>

    {{-- Alpine --}}
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
