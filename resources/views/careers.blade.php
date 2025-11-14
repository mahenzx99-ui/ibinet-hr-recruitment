@extends('layouts.app')

@section('content')
<section class="py-10">
    {{-- TITLE SECTION --}}
    <div class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-extrabold text-blue-900">
            Lowongan di IBINET
        </h1>
        <p class="mt-3 text-sm md:text-base text-slate-600 max-w-2xl mx-auto">
            Temukan posisi yang sesuai dengan passion dan keahlianmu. 
            Kami selalu mencari talenta terbaik untuk tumbuh bersama IBINET.
        </p>
    </div>

    {{-- LIST JOBS --}}
    <div class="grid gap-6 md:grid-cols-2">
        @forelse ($jobs as $job)
            <article class="rounded-2xl border border-blue-100 bg-white/90 shadow-sm hover:shadow-md transition p-5">
                <header class="flex items-start justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-semibold text-blue-900">
                            {{ $job->title }}
                        </h2>
                        <p class="text-xs text-slate-500 mt-1">
                            {{ $job->location }} • {{ $job->type }}
                        </p>
                    </div>
                    <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-1 text-[11px] font-medium text-blue-700">
                        {{ $job->is_open ? 'Open' : 'Closed' }}
                    </span>
                </header>

                <p class="mt-4 text-sm text-slate-600">
                    {{ $job->short_description }}
                </p>

                <div class="mt-5 flex items-center justify-between">
                    <div class="mt-5 flex items-center justify-between">
    <a href="{{ route('jobs.show', $job->slug) }}"
       class="inline-flex items-center text-sm font-semibold text-blue-700 hover:text-blue-900 transition">
        Lihat detail
        <span class="ml-1" aria-hidden="true">→</span>
    </a>

    <a href="{{ route('jobs.show', $job->slug) }}#apply"
       class="inline-flex items-center rounded-full bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-blue-500 transition">
        Lamar sekarang
    </a>
</div>

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
