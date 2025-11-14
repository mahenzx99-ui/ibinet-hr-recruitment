@extends('layouts.app')

@section('content')
<div class="relative bg-white">
    <div class="relative isolate px-6 lg:px-8">
        <!-- Gradient background kecil -->
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-56">
            <div
                class="relative left-1/2 aspect-[1155/678] w-[35rem] -translate-x-1/2 
                       bg-gradient-to-tr from-blue-200 to-blue-500 opacity-30">
            </div>
        </div>

        <div class="mx-auto max-w-4xl py-20 sm:py-24">
            <p class="text-sm font-semibold text-blue-600 mb-3">Tentang Kami</p>

            <h1 class="text-3xl sm:text-4xl font-extrabold text-blue-900 mb-4">
                IBINET Global Nusatindo
            </h1>

            <p class="text-base sm:text-lg text-gray-700 leading-relaxed mb-6">
                IBINET adalah perusahaan yang bergerak di bidang telekomunikasi, berfokus pada penyediaan
                layanan internet dan infrastruktur jaringan untuk mendukung kebutuhan digital masyarakat
                dan bisnis di Indonesia.
            </p>

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="lg:col-span-2 space-y-6">
                    <div class="rounded-2xl border border-blue-200 bg-blue-50/60 p-6">
                        <h2 class="text-xl font-semibold text-blue-900 mb-2">Visi & Misi</h2>
                        <p class="text-sm text-gray-700 mb-2">
                            <span class="font-semibold text-blue-700">Visi:</span>
                            Menjadi mitra telekomunikasi terpercaya yang menghadirkan konektivitas cepat,
                            stabil, dan terjangkau untuk seluruh lapisan masyarakat.
                        </p>
                        <p class="text-sm text-gray-700">
                            <span class="font-semibold text-blue-700">Misi:</span>
                        </p>
                        <ul class="mt-2 space-y-1 text-sm text-gray-600 list-disc list-inside">
                            <li>Mengembangkan infrastruktur jaringan yang handal dan berkualitas.</li>
                            <li>Mendukung transformasi digital untuk bisnis dan UMKM.</li>
                            <li>Memberikan layanan dan support terbaik untuk pelanggan.</li>
                        </ul>
                    </div>

                    <div class="rounded-2xl border border-blue-200 bg-blue-50/60 p-6">
                        <h2 class="text-xl font-semibold text-blue-900 mb-2">Budaya Kerja</h2>
                        <p class="text-sm text-gray-700 mb-2">
                            Di IBINET, kami percaya bahwa tim yang kuat adalah pondasi utama perusahaan.
                        </p>
                        <ul class="space-y-1 text-sm text-gray-600 list-disc list-inside">
                            <li>Kolaboratif dan saling mendukung.</li>
                            <li>Terbuka pada ide dan inovasi baru.</li>
                            <li>Profesional, namun tetap hangat dan bersahabat.</li>
                        </ul>
                    </div>
                </div>

                {{-- Card Owner / HR --}}
                <div class="space-y-6">
                    <div class="rounded-2xl border border-blue-300 bg-white p-6 shadow-sm">
                        <h3 class="text-lg font-semibold text-blue-900 mb-2">Informasi HR / Owner</h3>
                        <p class="text-sm text-gray-600 mb-1">
                            Halaman ini dikelola oleh:
                        </p>
                        <p class="text-base font-semibold text-blue-800">
                            {{ $nama }}
                        </p>
                        <p class="mt-3 text-sm text-gray-600">
                            Untuk informasi lebih lanjut mengenai peluang karier dan rekrutmen,
                            silakan hubungi tim HR IBINET.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-blue-100 bg-blue-50/70 p-4">
                        <h4 class="text-xs font-semibold text-blue-800 uppercase tracking-wide mb-2">
                            Navigasi
                        </h4>
                        <div class="flex flex-wrap gap-2 text-sm">
                            <a href="{{ url('/') }}" class="px-3 py-1 rounded-full border border-blue-300 text-blue-800 hover:bg-blue-100 transition">
                                Home
                            </a>
                            <a href="{{ url('/about') }}" class="px-3 py-1 rounded-full border border-blue-500 bg-blue-600 text-white">
                                About
                            </a>
                            <a href="{{ url('/contact') }}" class="px-3 py-1 rounded-full border border-blue-300 text-blue-800 hover:bg-blue-100 transition">
                                Contact
                            </a>
                            <a href="{{ url('/blog') }}" class="px-3 py-1 rounded-full border border-blue-300 text-blue-800 hover:bg-blue-100 transition">
                                Blog
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
