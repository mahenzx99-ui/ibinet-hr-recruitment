<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Job;
use App\Models\Application;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Matikan dulu foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 2) Kosongkan tabel yang terkait
        Application::truncate(); // hapus semua pelamar (hanya di dev, aman)
        Job::truncate();         // hapus semua lowongan lama

        // 3) Hidupkan lagi foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 4) Daftar lowongan baru
        $jobs = [
            [
                'title'             => 'Teknisi',
                'location'          => 'Denpasar',
                'type'              => 'Full-time',
                'short_description' => 'Melakukan instalasi dan maintenance jaringan IBINET di lapangan.',
            ],
            [
                'title'             => 'Helpdesk / NOC',
                'location'          => 'Denpasar',
                'type'              => 'Full-time',
                'short_description' => 'Menangani gangguan pelanggan dan monitoring jaringan dari NOC.',
            ],
            [
                'title'             => 'Doc. Control / Administration',
                'location'          => 'Denpasar',
                'type'              => 'Full-time',
                'short_description' => 'Mengelola dokumen, arsip, dan administrasi operasional IBINET.',
            ],
            [
                'title'             => 'Logistic',
                'location'          => 'Denpasar',
                'type'              => 'Full-time',
                'short_description' => 'Mengelola stok material, gudang, dan distribusi barang.',
            ],
            [
                'title'             => 'Finance',
                'location'          => 'Denpasar',
                'type'              => 'Full-time',
                'short_description' => 'Mengelola laporan keuangan, administrasi, dan rekonsiliasi.',
            ],
            [
                'title'             => 'Staff HR Recruitment',
                'location'          => 'Denpasar',
                'type'              => 'Full-time',
                'short_description' => 'Mengelola proses rekrutmen, screening, dan seleksi kandidat.',
            ],
            [
                'title'             => 'Staff HR Learning and Development',
                'location'          => 'Denpasar',
                'type'              => 'Full-time',
                'short_description' => 'Menyusun dan mengelola program pelatihan karyawan IBINET.',
            ],
            [
                'title'             => 'Staff HR Administration',
                'location'          => 'Denpasar',
                'type'              => 'Full-time',
                'short_description' => 'Mengelola administrasi HR, data karyawan, dan dokumen personalia.',
            ],
        ];

        foreach ($jobs as $data) {
            Job::create([
                'title'             => $data['title'],
                'slug'              => Str::slug($data['title']), // teknisi, helpdesk-noc, dll
                'location'          => $data['location'],
                'type'              => $data['type'],
                'short_description' => $data['short_description'],
                'description'       => null,
                'requirements'      => null,
                'is_open'           => true,
            ]);
        }
    }
}
