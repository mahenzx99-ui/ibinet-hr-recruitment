@extends('layouts.app')

@section('content')
<section class="py-10 max-w-5xl mx-auto">

    {{-- Breadcrumb --}}
    <nav class="text-xs text-slate-500 mb-4 flex items-center gap-1">
        <a href="{{ url('/') }}" class="hover:text-blue-600">Home</a>
        <span>/</span>
        <a href="{{ route('admin.applications.index') }}" class="hover:text-blue-600">Daftar Pelamar</a>
        <span>/</span>
        <span class="text-slate-700">{{ $application->name }}</span>
    </nav>

    {{-- Flash message --}}
    @if (session('success'))
        <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-2 text-xs text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    {{-- HEADER --}}
    <header class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-blue-900">
                {{ $application->name }}
            </h1>
            <p class="mt-1 text-sm text-slate-600">
                Melamar sebagai:
                <span class="font-semibold text-blue-800">
                    {{ $application->job?->title ?? '-' }}
                </span>
            </p>
            <p class="mt-1 text-xs text-slate-500">
                Diajukan pada: {{ $application->created_at?->format('d M Y H:i') }}
            </p>
        </div>

        <div class="flex flex-col items-start md:items-end gap-2">
            {{-- Status badge --}}
            <span class="inline-flex items-center rounded-full px-3 py-1 text-[11px] font-medium
                @if ($application->status === 'submitted')
                    bg-blue-50 text-blue-700
                @elseif ($application->status === 'reviewed')
                    bg-amber-50 text-amber-700
                @elseif ($application->status === 'accepted')
                    bg-emerald-50 text-emerald-700
                @elseif ($application->status === 'rejected')
                    bg-rose-50 text-rose-700
                @else
                    bg-slate-100 text-slate-700
                @endif
            ">
                Status: {{ ucfirst($application->status) }}
            </span>

            <a href="{{ route('admin.applications.index') }}"
               class="inline-flex items-center rounded-md border border-blue-200 bg-white/80 px-3 py-1.5 text-xs font-semibold text-blue-700 hover:bg-blue-50 transition">
                ← Kembali ke daftar pelamar
            </a>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <div class="grid gap-6 md:grid-cols-3">

        {{-- Kiri: Data pelamar + Posisi --}}
        <div class="md:col-span-2 space-y-4">

            {{-- Data Pelamar --}}
            <div class="rounded-2xl bg-white/95 p-5 shadow-sm border border-blue-100">
                <h2 class="text-sm font-semibold text-blue-900 mb-3">
                    Data Pelamar
                </h2>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-6 text-sm text-slate-700">
                    <div>
                        <dt class="text-xs uppercase tracking-wide text-slate-400">Nama Lengkap</dt>
                        <dd class="font-medium text-slate-800">{{ $application->name }}</dd>
                    </div>

                    <div>
                        <dt class="text-xs uppercase tracking-wide text-slate-400">Email</dt>
                        <dd>
                            <a href="mailto:{{ $application->email }}" class="text-blue-700 hover:underline">
                                {{ $application->email }}
                            </a>
                        </dd>
                    </div>

                    <div>
                        <dt class="text-xs uppercase tracking-wide text-slate-400">No. WhatsApp / HP</dt>
                        <dd>{{ $application->phone }}</dd>
                    </div>

                    <div>
                        <dt class="text-xs uppercase tracking-wide text-slate-400">Domisili</dt>
                        <dd>{{ $application->city ?? '-' }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Info Posisi --}}
            <div class="rounded-2xl bg-white/95 p-5 shadow-sm border border-blue-100">
                <h2 class="text-sm font-semibold text-blue-900 mb-3">
                    Informasi Posisi
                </h2>

                @if ($application->job)
                    <p class="text-sm text-slate-800 font-medium">
                        {{ $application->job->title }}
                    </p>
                    <p class="mt-1 text-xs text-slate-600">
                        Lokasi: {{ $application->job->location ?? '-' }}<br>
                        Tipe: {{ $application->job->type ?? '-' }}
                    </p>
                    @if ($application->job->short_description)
                        <p class="mt-3 text-sm text-slate-700">
                            {{ $application->job->short_description }}
                        </p>
                    @endif
                @else
                    <p class="text-sm text-slate-600">
                        Posisi terkait tidak ditemukan (mungkin sudah dihapus).
                    </p>
                @endif
            </div>
        </div>

        {{-- Kanan: CV + Catatan HR --}}
        <aside class="md:col-span-1 space-y-4">

            {{-- CV --}}
            <div class="rounded-2xl bg-white/95 p-5 shadow-sm border border-blue-100">
                <h2 class="text-sm font-semibold text-blue-900 mb-3">
                    Curriculum Vitae
                </h2>

                @if ($application->cv_path)
                    <a href="{{ asset('storage/'.$application->cv_path) }}"
                       target="_blank"
                       class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-xs font-semibold text-white shadow-sm hover:bg-blue-500 transition">
                        Lihat / Download CV
                        <span class="ml-1" aria-hidden="true">↗</span>
                    </a>
                    <p class="mt-2 text-[11px] text-slate-500">
                        File disimpan di: <code class="bg-slate-50 px-1 py-0.5 rounded">{{ $application->cv_path }}</code>
                    </p>
                @else
                    <p class="text-sm text-slate-600">
                        Tidak ada file CV yang terupload.
                    </p>
                @endif
            </div>

            {{-- Catatan HR --}}
            <div class="rounded-2xl bg-white/95 p-5 shadow-sm border border-blue-100">
                <h2 class="text-sm font-semibold text-blue-900 mb-3">
                    Catatan HR
                </h2>

                <form
                    action="{{ route('admin.applications.updateNotes', $application->id) }}"
                    method="POST"
                    class="space-y-2"
                >
                    @csrf
                    @method('PATCH')

                    <textarea
                        name="notes"
                        rows="6"
                        class="w-full rounded-md border border-blue-100 bg-white/90 px-3 py-2 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/60"
                        placeholder="Tulis catatan internal di sini. Contoh: Kuat di pengalaman ISP, perlu cek kemampuan teknis jaringan lanjutan."
                    >{{ old('notes', $application->notes) }}</textarea>

                    @error('notes')
                        <p class="text-[11px] text-red-600">{{ $message }}</p>
                    @enderror

                    <button
                        type="submit"
                        class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-xs font-semibold text-white shadow-sm hover:bg-blue-500 transition"
                    >
                        Simpan Catatan
                    </button>

                    <p class="mt-1 text-[11px] text-slate-500">
                        Catatan ini hanya terlihat oleh tim HR di halaman admin, tidak dikirim ke pelamar.
                    </p>
                </form>
            </div>

        </aside>
    </div>
</section>
@endsection
