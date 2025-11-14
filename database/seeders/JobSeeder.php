<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use Illuminate\Support\Str;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = [
            [
                'title'             => 'Staff Finance',
                'location'          => 'Denpasar',
                'type'              => 'Full-time',
                'short_description' => 'Mengelola laporan keuangan, administrasi, dan rekonsiliasi.',
            ],
            [
                'title'             => 'Network Engineer',
                'location'          => 'Denpasar',
                'type'              => 'Full-time',
                'short_description' => 'Installasi, konfigurasi, dan maintenance jaringan IBINET.',
            ],
            [
                'title'             => 'Customer Support',
                'location'          => 'Remote / Hybrid',
                'type'              => 'Full-time',
                'short_description' => 'Membantu pelanggan menyelesaikan kendala layanan internet.',
            ],
        ];

        foreach ($jobs as $data) {
            Job::create([
                'title'             => $data['title'],
                'slug'              => Str::slug($data['title']), // otomatis jadi staff-finance, dll
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
