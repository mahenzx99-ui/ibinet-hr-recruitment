@extends('layouts.app')

@section('content')
<section class="py-10 max-w-4xl mx-auto">
    {{-- Breadcrumb --}}
    <nav class="text-xs text-slate-500 mb-4">
        <a href="{{ url('/') }}" class="hover:text-blue-600">Home</a>
        <span class="mx-1">/</span>
        <a href="{{ route('careers.index') }}" class="hover:text-blue-600">Careers</a>
        <span class="mx-1">/</span>
        <span class="text-slate-700 font-medium">{{ $job->title }}</span>
    </nav>

    {{-- Title + Meta --}}
    <header class="mb-8 space-y-2">
        <h1 class="text-2xl md:text-3xl font-extrabold text-blue-900">
            {{ $job->title }}
        </h1>

        <p class="text-sm text-slate-600">
            {{ $job->location ?? 'Lokasi tidak disebutkan' }} • {{ $job->type ?? 'Full-time' }}
        </p>

        <div class="mt-1 inline-flex items-center gap-2 text-xs">
            <span class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1 font-medium text-blue-700">
                {{ $job->is_open ? 'Open for Applications' : 'Closed' }}
            </span>
            @if ($job->created_at)
                <span class="text-slate-400">
                    Diposting: {{ $job->created_at->format('d M Y') }}
                </span>
            @endif
        </div>
    </header>

    <div class="grid gap-10 md:grid-cols-3 items-start">
        {{-- Kolom kiri: Deskripsi & Kualifikasi --}}
        <div class="md:col-span-2 space-y-6">
            {{-- Deskripsi Pekerjaan --}}
            <div class="rounded-2xl bg-white/90 p-6 shadow-sm border border-blue-100">
                <h2 class="text-base font-semibold text-blue-900 mb-3">
                    Deskripsi Pekerjaan
                </h2>

                @if ($job->description)
                    <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                        {{ $job->description }}
                    </p>
                @else
                    <p class="text-sm text-slate-600">
                        Deskripsi pekerjaan akan diperbarui oleh tim HR IBINET.
                    </p>
                @endif
            </div>

            {{-- Kualifikasi --}}
            <div class="rounded-2xl bg-white/90 p-6 shadow-sm border border-blue-100">
                <h2 class="text-base font-semibold text-blue-900 mb-3">
                    Kualifikasi
                </h2>

                @if ($job->requirements)
                    <div class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                        {{ $job->requirements }}
                    </div>
                @else
                    <p class="text-sm text-slate-600">
                        Kualifikasi detail akan diinformasikan oleh tim HR pada tahap selanjutnya.
                    </p>
                @endif
            </div>

            {{-- Tombol Lamar Sekarang --}}
            <div>
                {{-- Tombol di halaman detail --}}
                    @if ($job->is_open)
                        <a href="{{ route('jobs.apply', $job->slug) }}"
                        class="inline-flex items-center px-5 py-2 rounded-lg bg-blue-600 text-white text-sm font-semibold hover:bg-blue-500 transition">
                            Lamar Sekarang
                        </a>
                    @else
                        <div class="mt-4 inline-flex items-center px-4 py-2 rounded-lg bg-red-100 text-red-700 text-sm font-semibold">
                            Lowongan ini sudah ditutup dan tidak menerima lamaran baru.
                        </div>
                    @endif

            </div>
        </div>

        {{-- Kolom kanan: Info Form Lamaran --}}
        <aside id="apply" class="md:col-span-1 w-full">
            <div class="rounded-2xl bg-white/95 p-5 shadow-md border border-blue-100 space-y-3">
                <h2 class="text-base font-semibold text-blue-900">
                    Formulir Lamaran
                </h2>

                <p class="text-[11px] text-slate-500">
                    Untuk melamar posisi
                    <span class="font-semibold">{{ $job->title }}</span>,
                    silakan klik tombol <span class="font-semibold">"Lamar sekarang"</span>
                    di sebelah kiri. Kamu akan diarahkan ke halaman form lamaran.
                </p>

                @if (session('success'))
                    <div class="rounded-lg bg-emerald-50 text-emerald-700 px-3 py-2 text-[11px]">
                        {{ session('success') }}
                    </div>
                @endif

                <p class="mt-1 text-[11px] text-slate-500 leading-relaxed">
                    Dengan mengirim lamaran, kamu menyetujui bahwa data akan diteruskan ke tim HR IBINET
                    untuk proses seleksi. Pastikan informasi yang kamu isi sudah benar.
                </p>
            </div>
        </aside>
    </div>
</section>
@endsection
