@extends('layouts.app')

@section('content')
    {{-- NAV + HERO UTAMA --}}
    <div class="relative bg-white">
        <!-- BACKGROUND GRADIENT TOP -->
        <div class="relative isolate px-6 lg:px-8">
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
                <div
                    class="relative left-1/2 aspect-[1155/678] w-[50rem] -translate-x-1/2 -translate-y-40 
                           bg-gradient-to-tr from-blue-900 to-blue-500 opacity-30">
                </div>
            </div>

            <!-- HERO CONTENT -->
            <div class="mx-auto max-w-2xl py-24 sm:py-32 lg:py-40">
                <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                    <div class="relative rounded-full px-4 py-1 text-sm text-blue-700 ring-1 ring-blue-300 bg-blue-50">
                        Lowongan baru telah dibuka —
                        <a href="#" class="font-semibold text-blue-600">
                            Lihat selengkapnya <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </div>

                <div class="text-center">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-gray-900">
                        Bergabunglah Dengan Tim IBINET
                    </h1>
                    <p class="mt-6 text-lg sm:text-xl text-gray-600">
                        Perusahaan telekomunikasi yang berkomitmen membangun konektivitas terbaik di Indonesia.
                        Mari berkembang bersama kami.
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <a href="#features"
                           class="rounded-md bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-blue-500/30 hover:bg-blue-500 transition">
                            Mulai Sekarang
                        </a>
                        <a href="#features" class="text-sm font-semibold text-blue-700 hover:text-blue-900">
                            Pelajari Selanjutnya <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- SECTION FITUR -->
            <section id="features" class="mx-auto max-w-5xl pb-24">
                <h2 class="text-center text-2xl font-bold mb-8 text-blue-900">Kenapa Gabung IBINET?</h2>
                <div class="grid gap-6 md:grid-cols-3">
                    <div class="rounded-2xl border border-blue-200 bg-blue-50/60 p-6">
                        <h3 class="font-semibold text-blue-900 mb-2">Lingkungan Profesional</h3>
                        <p class="text-sm text-blue-700">
                            Tim yang solid dan profesional, cocok untuk kamu yang ingin berkembang di dunia telekomunikasi.
                        </p>
                    </div>
                    <div class="rounded-2xl border border-blue-200 bg-blue-50/60 p-6">
                        <h3 class="font-semibold text-blue-900 mb-2">Kesempatan Bertumbuh</h3>
                        <p class="text-sm text-blue-700">
                            Berbagai peluang pengembangan skill melalui project nyata dan pelatihan internal.
                        </p>
                    </div>
                    <div class="rounded-2xl border border-blue-200 bg-blue-50/60 p-6">
                        <h3 class="font-semibold text-blue-900 mb-2">Dampak Nyata</h3>
                        <p class="text-sm text-blue-700">
                            Ikut berkontribusi membawa internet berkualitas untuk lebih banyak orang.
                        </p>
                    </div>
                </div>
            </section>

            <!-- BACKGROUND GRADIENT BOTTOM -->
            <div class="absolute inset-x-0 top-[calc(100%-15rem)] -z-10 transform-gpu overflow-hidden blur-3xl">
                <div
                    class="relative left-1/2 aspect-[1155/678] w-[45rem] -translate-x-1/2 
                           bg-gradient-to-tr from-blue-200 to-blue-500 opacity-20">
                </div>
            </div>
        </div>
    </div>
@endsection
