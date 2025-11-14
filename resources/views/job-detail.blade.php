@extends('layouts.app')

@section('content')
<section class="py-10 max-w-4xl mx-auto">
    {{-- Breadcrumb --}}
    <nav class="text-xs text-slate-500 mb-4">
        <a href="{{ url('/') }}" class="hover:text-blue-600">Home</a>
        <span class="mx-1">/</span>
        <a href="{{ route('careers.index') }}" class="hover:text-blue-600">Careers</a>
        <span class="mx-1">/</span>
        <span class="text-slate-700">{{ $job->title }}</span>
    </nav>

    {{-- Title + Meta --}}
    <header class="mb-8">
        <h1 class="text-2xl md:text-3xl font-extrabold text-blue-900">
            {{ $job->title }}
        </h1>
        <p class="mt-2 text-sm text-slate-600">
            {{ $job->location }} • {{ $job->type }}
        </p>
        <div class="mt-3 inline-flex items-center gap-2 text-xs">
            <span class="inline-flex items-center rounded-full bg-blue-50 px-3 py-1 font-medium text-blue-700">
                {{ $job->is_open ? 'Open for Applications' : 'Closed' }}
            </span>
            <span class="text-slate-400">
                Diposting: {{ $job->created_at?->format('d M Y') }}
            </span>
        </div>
    </header>

    <div class="grid gap-10 md:grid-cols-3">
        {{-- Deskripsi / Job Detail --}}
        <div class="md:col-span-2 space-y-6">
            <div class="rounded-2xl bg-white/90 p-6 shadow-sm border border-blue-100">
                <h2 class="text-base font-semibold text-blue-900 mb-3">Deskripsi Pekerjaan</h2>
                <p class="text-sm text-slate-700 leading-relaxed">
                    {{ $job->description ?? 'Deskripsi pekerjaan akan diperbarui oleh tim HR IBINET.' }}
                </p>
            </div>

            <div class="rounded-2xl bg-white/90 p-6 shadow-sm border border-blue-100">
                <h2 class="text-base font-semibold text-blue-900 mb-3">Kualifikasi</h2>
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
        </div>

        {{-- Form Lamaran --}}
        <aside id="apply" class="md:col-span-1">
            <div class="rounded-2xl bg-white/95 p-5 shadow-md border border-blue-100">
                <h2 class="text-base font-semibold text-blue-900 mb-1">
                    Formulir Lamaran
                </h2>
                <p class="text-[11px] text-slate-500 mb-3">
                    Lengkapi data di bawah ini untuk melamar posisi
                    <span class="font-semibold">{{ $job->title }}</span>.
                </p>

                @if(session('success'))
                    <div class="mb-3 rounded-lg bg-emerald-50 text-emerald-700 px-3 py-2 text-xs">
                        {{ session('success') }}
                    </div>
                @endif

                <form
                    action="{{ route('applications.store', $job->slug) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="grid gap-3 md:grid-cols-2 bg-white border border-slate-200 rounded-xl p-4 shadow-sm"
                >
                    @csrf

                    {{-- Nama --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-700">
                            Nama Lengkap
                        </label>
                        <input
                            type="text"
                            name="name"
                            class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500"
                            value="{{ old('name') }}"
                            required
                        >
                        @error('name')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-700">
                            Email
                        </label>
                        <input
                            type="email"
                            name="email"
                            class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500"
                            value="{{ old('email') }}"
                            required
                        >
                        @error('email')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- No. WA / HP --}}
                    <div class="md:col-span-1">
                        <label class="block text-xs font-medium text-slate-700">
                            No. Telepon / WhatsApp
                        </label>
                        <input
                            type="text"
                            name="phone"
                            class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500"
                            value="{{ old('phone') }}"
                            required
                        >
                        @error('phone')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kota Domisili --}}
                    <div class="md:col-span-1">
                        <label class="block text-xs font-medium text-slate-700">
                            Kota Domisili
                        </label>
                        <input
                            type="text"
                            name="city"
                            class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500"
                            value="{{ old('city') }}"
                        >
                        @error('city')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Sumber Informasi --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-700">
                            Sumber Informasi Lowongan
                        </label>
                        <select
                            name="source"
                            class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500"
                        >
                            <option value="">Pilih salah satu</option>
                            <option value="Website" {{ old('source') === 'Website' ? 'selected' : '' }}>Website</option>
                            <option value="Instagram" {{ old('source') === 'Instagram' ? 'selected' : '' }}>Instagram</option>
                            <option value="LinkedIn" {{ old('source') === 'LinkedIn' ? 'selected' : '' }}>LinkedIn</option>
                            <option value="Teman/Kerabat" {{ old('source') === 'Teman/Kerabat' ? 'selected' : '' }}>Teman / Kerabat</option>
                            <option value="Lainnya" {{ old('source') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('source')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Upload CV --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-700">
                            Upload CV (PDF, max 2MB)
                        </label>
                        <input
                            type="file"
                            name="cv"
                            accept="application/pdf"
                            class="mt-1 w-full text-xs text-slate-600 file:mr-2 file:rounded-md file:border-0 file:bg-blue-600 file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-white hover:file:bg-blue-500"
                            required
                        >
                        @error('cv')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Catatan Tambahan --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-slate-700">
                            Catatan Tambahan (opsional)
                        </label>
                        <textarea
                            name="notes"
                            rows="3"
                            class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Tulis pesan singkat untuk HR (opsional)..."
                        >{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-[11px] text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2 flex justify-end">
                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-xs font-semibold text-white shadow-sm hover:bg-blue-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                        >
                            Kirim Lamaran
                        </button>
                    </div>
                </form>

                <p class="mt-2 text-[11px] text-slate-500">
                    Dengan mengirim lamaran, kamu menyetujui bahwa data akan diteruskan ke tim HR IBINET untuk proses seleksi.
                </p>
            </div>
        </aside>
    </div>
</section>
@endsection