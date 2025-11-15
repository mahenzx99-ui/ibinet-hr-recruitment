<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    {{-- Dashboard --}}
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>

    @if(Auth::check() && Auth::user()->is_admin)
        {{-- Pelamar --}}
        <x-nav-link :href="route('admin.applications.index')" :active="request()->is('admin/applications')">
            {{ __('Pelamar') }}
        </x-nav-link>

        {{-- Kelola Lowongan --}}
        <x-nav-link :href="route('admin.jobs.index')" :active="request()->is('admin/jobs')">
            {{ __('Kelola Lowongan') }}
        </x-nav-link>
    @endif

    {{-- Link ke halaman karier publik --}}
    <x-nav-link :href="url('/careers')" :active="request()->is('careers')">
        {{ __('Halaman Karier Publik') }}
    </x-nav-link>
</div>