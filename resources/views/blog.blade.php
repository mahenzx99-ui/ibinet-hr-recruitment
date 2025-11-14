@extends('layouts.app')

@section('content')
<div class="relative bg-white">
    <div class="mx-auto max-w-4xl px-6 py-20">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-blue-900 mb-4">
            Halaman Blog
        </h1>
        <p class="text-gray-600 text-base sm:text-lg">
            Di sini nanti kamu bisa menampilkan artikel, update lowongan, atau berita terbaru dari IBINET.
        </p>

        {{-- Contoh placeholder list post --}}
        <div class="mt-10 space-y-6">
            <div class="rounded-2xl border border-blue-100 bg-blue-50/60 p-4">
                <h2 class="text-lg font-semibold text-blue-900">Judul Postingan 1</h2>
                <p class="text-sm text-gray-600 mt-1">
                    Deskripsi singkat postingan pertama. Nanti bisa diisi dari database.
                </p>
            </div>
            <div class="rounded-2xl border border-blue-100 bg-blue-50/60 p-4">
                <h2 class="text-lg font-semibold text-blue-900">Judul Postingan 2</h2>
                <p class="text-sm text-gray-600 mt-1">
                    Contoh konten lain. Bisa lowongan baru, pengumuman, dsb.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
