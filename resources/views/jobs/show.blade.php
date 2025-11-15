@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto space-y-8 py-10">

        {{-- Breadcrumb --}}
        <nav class="text-sm text-slate-500">
            <a href="{{ url('/') }}" class="hover:text-blue-600">Beranda</a>
            <span class="mx-1">/</span>
            <a href="{{ route('careers.index') }}" class="hover:text-blue-600">Lowongan Kerja</a>
            <span class="mx-1">/</span>
            <span class="text-slate-700 font-medium">{{ $job->title }}</span>
        </nav>

        {{-- Header Job --}}
        <header class="space-y-3">
            <h1 class="text-3xl md:text-4xl font-bold text-slate-900">
                {{ $job->title }}
            </h1>

            <p class="text-slate-500 text-sm">
                {{ $job->location ?? 'Lokasi tidak disebutkan' }} • {{ $job->type ?? 'Full-time' }}
            </p>

            @if($job->short_description)
                <p class="text-sm text-slate-600 leading-relaxed">
                    {{ $job->short_description }}
                </p>
            @endif

            <div class="flex flex-wrap items-center gap-3 text-xs">
                <span class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-3 py-1 text-blue-700 border border-blue-100">
                    <span class="h-2 w-2 rounded-full bg-green-500 animate-pulse"></span>
                    Open for Applications
                </span>
                @if($job->created_at)
                    <span class="text-slate-400">
                        Diposting: {{ $job->created_at->format('d M Y') }}
                    </span>
                @endif
            </div>

            @if (session('success'))
                <div class="mt-3 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif
        </header>

        {{-- Deskripsi & Kualifikasi --}}
        <section class="space-y-6">

            {{-- Deskripsi Pekerjaan --}}
            <div class="rounded-2xl border border-slate-100 bg-white shadow-sm p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-2">Deskripsi Pekerjaan</h2>

                @if($job->description)
                    <div class="prose max-w-none text-sm text-slate-700 leading-relaxed">
                        {!! nl2br(e($job->description)) !!}
                    </div>
                @else
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Deskripsi pekerjaan akan diperbarui oleh tim HR IBINET.
                    </p>
                @endif
            </div>

            {{-- Kualifikasi + Tombol Lamar --}}
            <div class="rounded-2xl border border-slate-100 bg-white shadow-sm p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-2">Kualifikasi</h2>

                @if($job->requirements)
                    <div class="prose max-w-none text-sm text-slate-700 leading-relaxed mb-4">
                        {!! nl2br(e($job->requirements)) !!}
                    </div>
                @else
                    <p class="text-sm text-slate-600 leading-relaxed mb-4">
                        Kualifikasi detail akan diinformasikan oleh tim HR pada tahap selanjutnya.
                    </p>
                @endif

                {{-- TOMBOL LAMAR SEKARANG --}}
                <a href="{{ route('jobs.apply.form', $job->slug) }}"
                   class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition">
                    Lamar sekarang
                    <span class="ml-2" aria-hidden="true">→</span>
                </a>
            </div>
        </section>
    </div>
@endsection
