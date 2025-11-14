<?php

namespace App\Exports;

use App\Models\Application;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApplicationsExport implements FromCollection, WithHeadings
{
    protected ?string $jobSlug;
    protected ?string $status;

    // kita kirim filter job & status dari controller
    public function __construct(?string $jobSlug = null, ?string $status = null)
    {
        $this->jobSlug = $jobSlug;
        $this->status  = $status;
    }

    /**
     * Data yang akan diexport ke Excel
     */
    public function collection()
    {
        $query = Application::with('job')
            ->orderBy('created_at', 'desc');

        // filter job (kalau ada)
        if ($this->jobSlug && $this->jobSlug !== 'all') {
            $query->whereHas('job', function ($q) {
                $q->where('slug', $this->jobSlug);
            });
        }

        // filter status (kalau ada)
        if ($this->status && $this->status !== 'all') {
            $query->where('status', $this->status);
        }

        // mapping kolom yang mau muncul di Excel
        return $query->get()->map(function ($app) {
            return [
                'Nama Pelamar'   => $app->name,
                'Email'          => $app->email,
                'No HP / WA'     => $app->phone,
                'Domisili'       => $app->city,
                'Posisi'         => $app->job?->title,
                'Lokasi'         => $app->job?->location,
                'Tipe'           => $app->job?->type,
                'Status'         => $app->status,
                'Tanggal Lamar'  => optional($app->created_at)->format('Y-m-d H:i'),
            ];
        });
    }

    /**
     * Header kolom di baris pertama Excel
     */
    public function headings(): array
    {
        return [
            'Nama Pelamar',
            'Email',
            'No HP / WA',
            'Domisili',
            'Posisi',
            'Lokasi',
            'Tipe',
            'Status',
            'Tanggal Lamar',
        ];
    }
}