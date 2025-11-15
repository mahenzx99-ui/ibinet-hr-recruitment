@extends('layouts.app')

@section('content')
<section class="py-10">

    {{-- HEADER HR DASHBOARD + TAB NAV --}}
    <header class="mb-8 flex items-center justify-between gap-4">
        <div class="flex flex-col gap-2">
            <div class="inline-flex items-center gap-2">
                <span class="inline-flex items-center justify-center rounded-xl bg-slate-900/80 px-3 py-1 text-[11px] font-semibold tracking-wide text-amber-300 uppercase border border-amber-500/40">
                    IBINET HR DASHBOARD
                </span>
                <span class="inline-flex items-center rounded-full bg-emerald-500/10 px-3 py-1 text-[11px] font-semibold text-emerald-300 border border-emerald-500/40">
                    ● ADMIN MODE
                </span>
            </div>

            <nav class="mt-3 flex flex-wrap items-center gap-3 text-xs font-medium">
                {{-- TAB: Pelamar (aktif di halaman ini) --}}
                <a href="{{ route('admin.applications.index') }}"
                   class="rounded-full px-4 py-2 border
                          {{ request()->routeIs('admin.applications.index') 
                                ? 'border-blue-400 bg-blue-500/15 text-blue-100' 
                                : 'border-slate-700 bg-slate-900/60 text-slate-300 hover:border-blue-400 hover:text-blue-100' }}">
                    Pelamar
                </a>

                {{-- TAB: Kelola Lowongan --}}
                <a href="{{ route('admin.jobs.index') }}"
                   class="rounded-full px-4 py-2 border
                          {{ request()->routeIs('admin.jobs.index') 
                                ? 'border-blue-400 bg-blue-500/15 text-blue-100' 
                                : 'border-slate-700 bg-slate-900/60 text-slate-300 hover:border-blue-400 hover:text-blue-100' }}">
                    Kelola Lowongan
                </a>

                {{-- TAB: Halaman Karier Publik --}}
                <a href="{{ url('/careers') }}"
                   class="rounded-full px-4 py-2 border border-slate-700 bg-slate-900/40 text-slate-300 hover:border-emerald-400 hover:text-emerald-200">
                    Halaman Karier Publik
                </a>
            </nav>
        </div>
    </header>

    {{-- ========== KONTEN LAMA (TIDAK DIUBAH) ========== --}}
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <div>
            <h1 class="text-2xl font-extrabold text-blue-900">
                Daftar Pelamar
            </h1>
            <p class="text-sm text-slate-600 mt-1">
                Semua lamaran yang masuk ke IBINET Recruitment.
            </p>

            @if ($selectedJobSlug && $selectedJobSlug !== 'all')
                @php
                    $jobSelected = $jobs->firstWhere('slug', $selectedJobSlug);
                @endphp
                @if ($jobSelected)
                    <p class="text-xs text-blue-700 mt-1">
                        Menampilkan pelamar untuk posisi:
                        <span class="font-semibold">{{ $jobSelected->title }}</span>
                    </p>
                @endif
            @endif
        </div>

        {{-- Kanan: total pelamar + tombol export + filter job + filter status --}}
        <div class="flex flex-col items-end gap-2">
            {{-- Baris: total pelamar + tombol export --}}
            <div class="flex items-center gap-3">
                <div class="text-xs text-slate-500">
                    Total Pelamar:
                    <span class="font-semibold text-blue-700">
                        {{ $applications->count() }}
                    </span>
                </div>

                {{-- Tombol Export Excel (ikut filter yang sedang aktif) --}}
                <a
                    href="{{ route('admin.applications.export', request()->query()) }}"
                    class="inline-flex items-center rounded-md bg-emerald-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-emerald-500 transition"
                >
                    Export Excel
                    <span class="ml-1 text-[10px]" aria-hidden="true">⬇</span>
                </a>
            </div>

            {{-- Form Filter Job + Status (GET) --}}
            <form
                action="{{ route('admin.applications.index') }}"
                method="GET"
                class="flex flex-wrap items-center gap-2 justify-end text-xs"
            >
                {{-- Filter Job --}}
                <div class="flex items-center gap-1">
                    <label for="job-filter" class="text-slate-500">
                        Posisi:
                    </label>
                    <select
                        id="job-filter"
                        name="job"
                        class="rounded-md border border-blue-100 bg-white/80 px-3 py-1.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/60"
                        onchange="this.form.submit()"
                    >
                        <option value="all"
                            {{ ($selectedJobSlug ?? 'all') === 'all' ? 'selected' : '' }}>
                            Semua Posisi
                        </option>

                        @foreach ($jobs as $job)
                            <option
                                value="{{ $job->slug }}"
                                {{ ($selectedJobSlug ?? '') === $job->slug ? 'selected' : '' }}
                            >
                                {{ $job->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter Status --}}
                <div class="flex items-center gap-1">
                    <label for="status-filter" class="text-slate-500">
                        Status:
                    </label>
                    <select
                        id="status-filter"
                        name="status_filter"
                        class="rounded-md border border-blue-100 bg-white/80 px-3 py-1.5 text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500/60"
                        onchange="this.form.submit()"
                    >
                        <option value="all"
                            {{ ($selectedStatus ?? 'all') === 'all' ? 'selected' : '' }}>
                            Semua Status
                        </option>
                        <option value="submitted" {{ ($selectedStatus ?? '') === 'submitted' ? 'selected' : '' }}>
                            Submitted
                        </option>
                        <option value="reviewed" {{ ($selectedStatus ?? '') === 'reviewed' ? 'selected' : '' }}>
                            Reviewed
                        </option>
                        <option value="accepted" {{ ($selectedStatus ?? '') === 'accepted' ? 'selected' : '' }}>
                            Accepted
                        </option>
                        <option value="rejected" {{ ($selectedStatus ?? '') === 'rejected' ? 'selected' : '' }}>
                            Rejected
                        </option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    {{-- 🔔 FLASH MESSAGE SUKSES --}}
    @if (session('success'))
        <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-2 text-xs text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-2xl border border-blue-100 bg-white/90 shadow-sm">
        <table class="min-w-full text-sm">
            <thead class="bg-blue-50/70 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 py-3 text-left">Pelamar</th>
                    <th class="px-4 py-3 text-left">Posisi</th>
                    <th class="px-4 py-3 text-left">Kontak</th>
                    <th class="px-4 py-3 text-left">Sumber</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">CV</th>
                    <th class="px-4 py-3 text-left">Masuk</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($applications as $app)
                    <tr class="border-t border-blue-50 hover:bg-blue-50/40 transition">
                        {{-- Pelamar --}}
                        <td class="px-4 py-3 align-top">
                            <div class="font-semibold text-slate-800">
                                <a href="{{ route('admin.applications.show', $app->id) }}"
                                   class="text-blue-800 hover:text-blue-600 hover:underline">
                                    {{ $app->name }}
                                </a>
                            </div>
                            <div class="text-xs text-slate-500">
                                {{ $app->city ?? 'Domisili belum diisi' }}
                            </div>
                        </td>

                        {{-- POSISI --}}
                        <td class="px-4 py-3 align-top">
                            <div class="text-slate-800">
                                {{ $app->job?->title ?? '-' }}
                            </div>
                            <div class="text-[11px] text-slate-500">
                                {{ $app->job?->location }} • {{ $app->job?->type }}
                            </div>
                        </td>

                        {{-- KONTAK --}}
                        <td class="px-4 py-3 align-top text-xs text-slate-700 space-y-1">
                            <div>
                                <span class="font-semibold">Email:</span>
                                <a href="mailto:{{ $app->email }}" class="text-blue-700 hover:underline">
                                    {{ $app->email }}
                                </a>
                            </div>
                            <div>
                                <span class="font-semibold">WA/HP:</span>
                                <span>{{ $app->phone }}</span>
                            </div>
                        </td>

                        {{-- SUMBER INFORMASI --}}
                        <td class="px-4 py-3 align-top text-xs text-slate-500">
                            {{ $app->source ?? '-' }}
                        </td>

                        {{-- 🔥 STATUS + DROPDOWN UPDATE --}}
                        <td class="px-4 py-3 align-top">
                            <div class="flex flex-col gap-2">

                                {{-- Badge status --}}
                                <span class="inline-flex items-center rounded-full px-2.5 py-1 text-[11px] font-medium
                                    @if ($app->status === 'submitted')
                                        bg-blue-50 text-blue-700
                                    @elseif ($app->status === 'reviewed')
                                        bg-amber-50 text-amber-700
                                    @elseif ($app->status === 'accepted')
                                        bg-emerald-50 text-emerald-700
                                    @elseif ($app->status === 'rejected')
                                        bg-rose-50 text-rose-700
                                    @else
                                        bg-slate-100 text-slate-700
                                    @endif
                                ">
                                    {{ ucfirst($app->status) }}
                                </span>

                                {{-- Form update status --}}
                                <form
                                    action="{{ route('admin.applications.updateStatus', $app->id) }}"
                                    method="POST"
                                    class="flex items-center gap-1 text-[11px]"
                                >
                                    @csrf
                                    @method('PATCH')

                                    {{-- Bawa filter job --}}
                                    @if(request('job'))
                                        <input type="hidden" name="job" value="{{ request('job') }}">
                                    @endif

                                    {{-- Bawa filter status --}}
                                    @if(request('status_filter'))
                                        <input type="hidden" name="status_filter" value="{{ request('status_filter') }}">
                                    @endif

                                    <select
                                        name="status"
                                        class="rounded-md border border-blue-100 bg-white/80 px-2 py-1 text-[11px] text-slate-700 focus:outline-none focus:ring-1 focus:ring-blue-500/60"
                                        onchange="this.form.submit()"
                                    >
                                        <option value="submitted" {{ $app->status === 'submitted' ? 'selected' : '' }}>Submitted</option>
                                        <option value="reviewed" {{ $app->status === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                        <option value="accepted" {{ $app->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                                        <option value="rejected" {{ $app->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </form>
                            </div>
                        </td>

                        {{-- CV --}}
                        <td class="px-4 py-3 align-top">
                            @if ($app->cv_path)
                                <a href="{{ asset('storage/'.$app->cv_path) }}"
                                   target="_blank"
                                   class="inline-flex items-center text-xs font-semibold text-blue-700 hover:text-blue-900">
                                    Lihat CV
                                    <span class="ml-1" aria-hidden="true">↗</span>
                                </a>
                            @else
                                <span class="text-xs text-slate-400">Tidak ada file</span>
                            @endif
                        </td>

                        {{-- TANGGAL --}}
                        <td class="px-4 py-3 align-top text-xs text-slate-500">
                            {{ $app->created_at?->format('d M Y H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-sm text-slate-500">
                            Belum ada pelamar yang masuk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
