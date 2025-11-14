@extends('layouts.app')

@section('content')
    <section class="py-10 space-y-6">
        <a href="{{ route('careers.index') }}" class="text-sm text-blue-600 hover:underline">
            ← Kembali ke daftar lowongan
        </a>

        <div class="bg-white/80 backdrop-blur rounded-2xl shadow-sm border border-blue-100 p-6 space-y-4">
            <h1 class="text-2xl font-bold text-blue-900">
                {{ $job->title }}
            </h1>

            <p class="text-sm text-slate-500">
                Lokasi: {{ $job->location ?? 'Tidak disebutkan' }} ·
                Tipe: {{ $job->type ?? 'Full-time' }}
            </p>

            @if($job->short_description)
                <p class="text-slate-700">
                    {{ $job->short_description }}
                </p>
            @endif

            @if($job->description)
                <div class="prose max-w-none text-slate-700">
                    {!! nl2br(e($job->description)) !!}
                </div>
            @endif

            <a href="#form-lamaran"
               class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-semibold shadow-lg shadow-blue-500/30 hover:bg-blue-500 transition">
                Lamar Sekarang
            </a>
        </div>

        {{-- Nanti di sini kita taruh form lamaran --}}
        <div id="form-lamaran" class="bg-blue-50/80 border border-blue-100 rounded-2xl p-6">
            <h2 class="text-lg font-semibold text-blue-900 mb-4">Form Lamaran</h2>
            <p class="text-sm text-slate-600">
                Untuk sekarang, form lamaran masih kita kerjakan di langkah berikutnya 😊
            </p>
        </div>
    </section>
@endsection
