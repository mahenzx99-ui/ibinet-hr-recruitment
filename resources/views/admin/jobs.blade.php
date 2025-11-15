@extends('layouts.app')

@section('content')
<section class="min-h-screen bg-slate-950 text-slate-100 py-10">
    <div class="max-w-6xl mx-auto px-4">

        {{-- HEADER HR DASHBOARD + TAB NAV (VERSI KHOUS KEPALA LOWONGAN) --}}
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
                    {{-- TAB: Pelamar --}}
                    <a href="{{ route('admin.applications.index') }}"
                       class="rounded-full px-4 py-2 border
                              {{ request()->routeIs('admin.applications.index') 
                                    ? 'border-blue-400 bg-blue-500/15 text-blue-100' 
                                    : 'border-slate-700 bg-slate-900/60 text-slate-300 hover:border-blue-400 hover:text-blue-100' }}">
                        Pelamar
                    </a>

                    {{-- TAB: Kelola Lowongan (aktif di halaman ini) --}}
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

        {{-- Flash message --}}
        @if(session('success'))
            <div class="mb-4 rounded-lg border border-emerald-500/40 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-200">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tabel lowongan --}}
        <div class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-900/70 shadow-xl">
            <table class="min-w-full divide-y divide-slate-800 text-sm">
                <thead class="bg-slate-900/90">
                <tr class="text-xs uppercase tracking-wide text-slate-400">
                    <th class="px-6 py-3 text-left">Posisi</th>
                    <th class="px-6 py-3 text-left">Lokasi</th>
                    <th class="px-6 py-3 text-left">Tipe</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Job Posting</th>
                    <th class="px-6 py-3 text-right">Aksi</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                @forelse($jobs as $job)
                    <tr class="hover:bg-slate-900/80">
                        {{-- Posisi --}}
                        <td class="px-6 py-4 align-top">
                            <div class="font-semibold text-slate-50">
                                {{ $job->title }}
                            </div>
                            <div class="text-[11px] text-slate-400 mt-1">
                                slug: <span class="font-mono text-slate-300">{{ $job->slug }}</span>
                            </div>
                        </td>

                        {{-- Lokasi --}}
                        <td class="px-6 py-4 align-top text-slate-200">
                            {{ $job->location ?? '-' }}
                        </td>

                        {{-- Tipe --}}
                        <td class="px-6 py-4 align-top text-slate-200">
                            {{ $job->type ?? '-' }}
                        </td>

                        {{-- Status badge --}}
                        <td class="px-6 py-4 align-top">
                            @if($job->is_open)
                                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-300 border border-emerald-500/40">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                    Open
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 rounded-full bg-rose-500/10 px-3 py-1 text-xs font-semibold text-rose-300 border border-rose-500/40">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-400"></span>
                                    Closed
                                </span>
                            @endif
                        </td>

                        {{-- Job posting date --}}
                        <td class="px-6 py-4 align-top text-slate-300 text-xs">
                            {{ optional($job->created_at)->format('d M Y') ?? '-' }}
                        </td>

                        {{-- Form ubah status --}}
                        <td class="px-6 py-4 align-top text-right">
                            <form action="{{ route('admin.jobs.updateStatus', $job) }}" method="POST" class="inline-flex items-center gap-2">
                                @csrf
                                @method('PATCH')

                                <select name="is_open"
                                        class="rounded-full border border-slate-700 bg-slate-900/80 text-xs text-slate-100 px-3 py-1 focus:border-blue-500 focus:ring-blue-500">
                                    <option value="1" @selected($job->is_open)>Open</option>
                                    <option value="0" @selected(!$job->is_open)>Closed</option>
                                </select>

                                <button type="submit"
                                        class="inline-flex items-center rounded-full bg-blue-500 px-3 py-1 text-xs font-semibold text-white hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-400/60">
                                    Simpan
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-400 text-sm">
                            Belum ada data lowongan.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
