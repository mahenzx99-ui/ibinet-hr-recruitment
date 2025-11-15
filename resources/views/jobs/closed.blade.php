@extends('layouts.app')

@section('content')
<section class="py-16 max-w-xl mx-auto text-center">
    <h1 class="text-3xl font-extrabold text-red-600 mb-4">
        Lowongan Ditutup
    </h1>

    <p class="text-slate-600 mb-6">
        Lowongan
        <span class="font-semibold text-slate-900">{{ $job->title }}</span>
        saat ini sudah tidak menerima lamaran.
    </p>

    <a href="{{ url('/careers') }}"
       class="inline-flex items-center px-5 py-2 rounded-lg bg-blue-600 text-white text-sm font-semibold hover:bg-blue-500 transition">
        ← Kembali ke daftar lowongan
    </a>
</section>
@endsection
