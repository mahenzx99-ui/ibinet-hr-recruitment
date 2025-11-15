@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto space-y-8">

        {{-- Breadcrumb kecil --}}
        <nav class="text-sm text-slate-500 mb-2">
            <a href="{{ url('/') }}" class="hover:text-blue-600">Beranda</a>
            <span class="mx-1">/</span>
            <a href="{{ route('careers.index') }}" class="hover:text-blue-600">Lowongan Kerja</a>
            <span class="mx-1">/</span>
            <a href="{{ route('jobs.show', $job->slug) }}" class="hover:text-blue-600">{{ $job->title }}</a>
            <span class="mx-1">/</span>
            <span class="text-slate-700 font-medium">Formulir Lamaran</span>
        </nav>

        <div class="grid gap-8 lg:grid-cols-[1.2fr,1fr] items-start">

            {{-- INFO SINGKAT LOWONGAN --}}
            <section class="space-y-4">
                <h1 class="text-2xl md:text-3xl font-bold text-slate-900">
                    Lamar: {{ $job->title }}
                </h1>
                <p class="text-slate-500 text-sm">
                    Lokasi: <span class="font-medium text-slate-700">{{ $job->location }}</span>
                    <span class="mx-2">•</span>
                    Tipe: <span class="font-medium text-slate-700">{{ $job->type }}</span>
                </p>

                <div class="mt-4 rounded-2xl border border-blue-100 bg-blue-50/60 px-4 py-3 text-sm text-blue-800 flex items-center gap-2">
                    <span class="inline-flex h-2 w-2 rounded-full bg-green-500 animate-pulse"></span>
                    <span>
                        Pastikan data yang kamu isi sudah benar sebelum mengirimkan lamaran.
                    </span>
                </div>

                <div class="mt-4 space-y-4 text-sm text-slate-600">
                    <p>
                        Kamu sedang melamar posisi <strong>{{ $job->title }}</strong> di <strong>IBINET</strong>.
                    </p>
                    <p>
                        Setelah mengirim lamaran, tim HR akan melakukan screening CV.
                        Jika memenuhi kualifikasi, kamu akan dihubungi melalui email atau WhatsApp.
                    </p>
                </div>
            </section>

            {{-- FORMULIR LAMARAN --}}
            <section class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 space-y-4">

                @if (session('success'))
                    <div class="mb-3 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-3 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-800">
                        <div class="font-semibold mb-1">Periksa kembali formulir kamu:</div>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h2 class="text-lg font-semibold text-slate-900 mb-1">Formulir Lamaran</h2>
                <p class="text-xs text-slate-500 mb-4">
                    Lengkapi data di bawah ini untuk melamar posisi <span class="font-semibold">{{ $job->title }}</span>.
                </p>

                <form
                    action="{{ route('jobs.apply', $job->slug) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-4 text-sm"
                >
                    @csrf

                    <div>
                        <label class="block text-slate-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-slate-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-slate-700 mb-1">No. Telepon / WhatsApp</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                   class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-slate-700 mb-1">Kota Domisili</label>
                            <input type="text" name="city" value="{{ old('city') }}"
                                   class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-slate-700 mb-1">Sumber Informasi Lowongan</label>
                        <select name="source"
                                class="w-full rounded-lg border-slate-200 focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Pilih salah satu</option>
                            <option value="Website" {{ old('source') == 'Website' ? 'selected' : '' }}>Website IBINET</option>
                            <option value="Instagram" {{ old('source') == 'Instagram' ? 'selected' : '' }}>Instagram</option>
                            <option value="LinkedIn" {{ old('source') == 'LinkedIn' ? 'selected' : '' }}>LinkedIn</option>
                            <option value="Job Portal" {{ old('source') == 'Job Portal' ? 'selected' : '' }}>Job Portal (Glints, dsb)</option>
                            <option value="Referensi" {{ old('source') == 'Referensi' ? 'selected' : '' }}>Referensi Teman/Kerabat</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-slate-700 mb-1">
                            Upload CV (PDF, max 2MB)
                        </label>
                        <input type="file" name="cv"
                               class="block w-full text-sm text-slate-600 file:mr-3 file:py-2 file:px-4
                                      file:rounded-lg file:border-0 file:text-sm file:font-semibold
                                      file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <button type="submit"
                            class="w-full inline-flex justify-center items-center rounded-lg bg-blue-600 px-4 py-2.5
                                   text-sm font-semibold text-white shadow-sm hover:bg-blue-700
                                   focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2
                                   focus-visible:outline-blue-600 transition">
                        Kirim Lamaran
                    </button>

                    <p class="text-[11px] text-slate-400 mt-1">
                        Dengan mengirimkan lamaran ini, kamu menyetujui bahwa data yang kamu berikan
                        akan digunakan untuk keperluan proses rekrutmen di IBINET.
                    </p>
                </form>
            </section>
        </div>
    </div>
@endsection