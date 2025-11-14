@extends('layouts.app')

@section('content')
<div class="relative bg-white">
    <div class="relative isolate px-6 lg:px-8">

        <!-- GRADIENT BACKGROUND -->
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl">
            <div
                class="relative left-1/2 aspect-[1155/678] w-[40rem] -translate-x-1/2 bg-gradient-to-tr from-blue-300 to-blue-600 opacity-20">
            </div>
        </div>

        <div class="mx-auto max-w-4xl py-20 px-6">

            <!-- HEADER SECTION -->
            <h1 class="text-4xl sm:text-5xl font-extrabold text-blue-900 mb-4">
                Hubungi IBINET
            </h1>
            <p class="text-gray-700 text-lg leading-relaxed mb-10">
                Tim IBINET siap membantu Anda dalam informasi layanan, kerja sama, maupun keperluan rekrutmen.
                Silakan hubungi kami melalui informasi berikut.
            </p>

            <!-- GRID CONTACT -->
            <div class="grid gap-8 lg:grid-cols-2">

                <!-- INFO PERUSAHAAN -->
                <div class="space-y-6">
                    <div class="rounded-2xl border border-blue-200 bg-blue-50/60 p-6">
                        <h2 class="text-xl font-semibold text-blue-900 mb-3">Kantor Utama</h2>
                        <p class="text-gray-700 text-sm mb-1">IBINET Global Nusatindo</p>
                        <p class="text-gray-600 text-sm">
                            Jl. Telekomunikasi No. 21  
                            Denpasar, Bali  
                            Indonesia
                        </p>
                    </div>

                    <div class="rounded-2xl border border-blue-200 bg-blue-50/60 p-6">
                        <h2 class="text-xl font-semibold text-blue-900 mb-3">Kontak Resmi</h2>
                        <ul class="text-gray-700 text-sm space-y-2">
                            <li><strong class="text-blue-800">Email:</strong> info@ibinet.co.id</li>
                            <li><strong class="text-blue-800">Telepon:</strong> (021) 9876-5432</li>
                            <li><strong class="text-blue-800">Whatsapp:</strong> +62 812-3456-7890</li>
                        </ul>
                    </div>

                    <div class="rounded-2xl border border-blue-200 bg-blue-50/60 p-6">
                        <h2 class="text-xl font-semibold text-blue-900 mb-3">Media Sosial</h2>
                        <ul class="text-gray-700 text-sm space-y-2">
                            <li>
                                Instagram:
                                <a href="https://instagram.com/mahnx21" target="_blank"
                                   class="text-blue-600 font-semibold hover:underline">
                                    @mahnx21
                                </a>
                            </li>
                            <li>
                                LinkedIn:
                                <a href="#" class="text-blue-600 font-semibold hover:underline">
                                    IBINET Official
                                </a>
                            </li>
                            <li>
                                Website:
                                <a href="#" class="text-blue-600 font-semibold hover:underline">
                                    www.ibinet.co.id
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- FORM KONTAK -->
                <div>
                    <div class="rounded-2xl border border-blue-300 bg-white shadow-md p-8">
                        <h2 class="text-xl font-semibold text-blue-900 mb-4">Formulir Kontak</h2>

                        <form action="#" method="POST" class="space-y-4">
                            @csrf

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Nama Lengkap
                                </label>
                                <input type="text" name="nama"
                                       class="w-full rounded-lg border border-blue-200 p-2 text-gray-900 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Email
                                </label>
                                <input type="email" name="email"
                                       class="w-full rounded-lg border border-blue-200 p-2 text-gray-900 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Pesan
                                </label>
                                <textarea name="pesan" rows="4"
                                          class="w-full rounded-lg border border-blue-200 p-2 text-gray-900 focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>

                            <button type="submit"
                                    class="mt-4 w-full rounded-md bg-blue-600 py-2.5 text-sm font-semibold text-white hover:bg-blue-500 transition">
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- GRADIENT FOOTER -->
        <div class="absolute inset-x-0 bottom-0 -z-10 overflow-hidden blur-3xl">
            <div
                class="relative left-1/2 aspect-[1155/678] w-[50rem] -translate-x-1/2 bg-gradient-to-tr from-blue-200 to-blue-500 opacity-20">
            </div>
        </div>

    </div>
</div>
@endsection
