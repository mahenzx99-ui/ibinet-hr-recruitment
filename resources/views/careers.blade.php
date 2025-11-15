@extends('layouts.app')

@section('content')
<section class="py-10 max-w-5xl mx-auto">

    {{-- TITLE SECTION --}}
    <div class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-extrabold text-blue-900">
            Lowongan di IBINET
        </h1>
        <p class="mt-3 text-sm md:text-base text-slate-600 max-w-2xl mx-auto">
            Temukan posisi terbaik sesuai passion & keahlianmu.  
            IBINET mencari talenta yang siap tumbuh bersama kami.
        </p>
    </div>

    {{-- LIST JOBS --}}
    <div class="grid gap-6 md:grid-cols-2">
        @forelse ($jobs as $job)
            <article class="rounded-3xl bg-white/80 border border-blue-100 shadow-sm p-6 md:p-8 flex flex-col justify-between hover:shadow-lg transition">

                {{-- HEADER (Title + Status) --}}
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-blue-900">
                            {{ $job->title }}
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            {{ $job->location }} • {{ $job->type }}
                        </p>
                    </div>

                    {{-- BADGE --}}
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                                 {{ $job->is_open ? 'bg-blue-50 text-blue-700' : 'bg-slate-100 text-slate-500' }}">
                        {{ $job->is_open ? 'Open' : 'Closed' }}
                    </span>
                </div>

                {{-- DESKRIPSI BARU (Sesuai Per-Job) --}}
                <div class="mt-4 space-y-2 text-sm text-slate-700">

                    {{-- Level & Tipe --}}
                    <p>
                        💼 Level: Staff  
                        <span class="mx-1"></span>
                        ⏰ Tipe: {{ $job->type }}
                    </p>

                    {{-- Penempatan --}}
                    <p>
                        📍 Penempatan:
                        @switch($job->slug)
                            @case('teknisi')
                                Base lokasi proyek (contoh: Makassar / Sorong / Kupang)
                                @break

                            @case('helpdesk-noc')
                                Kantor Pusat / Denpasar
                                @break

                            @case('doc-control-administration')
                                Kantor Pusat / Denpasar
                                @break

                            @case('logistic')
                                Kantor Pusat / Denpasar
                                @break

                            @default
                                {{ $job->location }}
                        @endswitch
                    </p>


                    {{-- PERAN UTAMA --}}
                    <p class="mt-2 leading-relaxed">
                        @switch($job->slug)
                            @case('teknisi')
                                🔧 <span class="font-semibold">Peran Utama:</span>  
                                Melakukan instalasi, aktivasi, dan pemeliharaan jaringan VSAT di lapangan  
                                untuk mendukung konektivitas proyek nasional IBINET. 🚀  
                                Jadilah bagian dari tim teknisi yang menjaga koneksi Indonesia tetap aktif!
                                @break

                            @case('helpdesk-noc')
                                🖥️ <span class="font-semibold">Peran Utama:</span>  
                                Memantau performa jaringan, menangani laporan gangguan,  
                                dan berkoordinasi dengan tim teknisi lapangan untuk menjaga  
                                stabilitas layanan VSAT seluruh Indonesia.  
                                💡 Jadilah garda depan menjaga performa jaringan nasional!
                                @break

                            @case('doc-control-administration')
                                🗂️ <span class="font-semibold">Peran Utama:</span>  
                                Mengelola dokumen proyek, laporan instalasi, dan administrasi operasional  
                                agar proses berjalan tertib & terdokumentasi.  
                                📋 Ketelitianmu menjaga keakuratan data proyek nasional.
                                @break

                            @case('logistic')
                                📦 <span class="font-semibold">Peran Utama:</span>  
                                Mengatur distribusi peralatan jaringan ke berbagai lokasi proyek, memantau stok,  
                                dan memastikan pengiriman tepat waktu.  
                                🚚 Dukung kelancaran proyek nasional melalui logistik handal!
                                @break

                            @default
                                {{ $job->short_description }}
                        @endswitch
                    </p>

                    {{-- TANGGAL POSTING --}}
                    <p class="mt-3 text-xs text-slate-400">
                        Job Posting: 00 Desember 2025
                    </p>
                </div>

                {{-- TOMBOL --}}
                <div class="mt-6 flex items-center justify-between gap-4">

                    {{-- LAMAR --}}
                    {{-- Tombol Lamar --}}
                            @if ($job->is_open)
                                <a href="{{ route('jobs.show', $job->slug) }}"
                                class="inline-flex items-center px-4 py-2 rounded-md bg-blue-600 text-white text-sm font-semibold hover:bg-blue-500 transition">
                                    Lamar sekarang
                                </a>
                            @else
                                <span class="inline-flex items-center px-4 py-2 rounded-md bg-gray-300 text-gray-600 text-sm font-semibold cursor-not-allowed">
                                    Closed
                                </span>
                            @endif


                    {{-- DETAIL --}}
                    <a href="{{ route('jobs.show', $job->slug) }}"
                       class="text-sm font-semibold text-blue-700 hover:text-blue-900 inline-flex items-center gap-1">
                        Detail Pekerjaan
                        <span aria-hidden="true">→</span>
                    </a>
                </div>

            </article>
        @empty
            <p class="text-center text-sm text-slate-500">
                Saat ini belum ada lowongan yang dibuka.
            </p>
        @endforelse
    </div>
</section>
@endsection
