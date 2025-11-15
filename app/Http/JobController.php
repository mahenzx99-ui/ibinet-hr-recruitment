<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Halaman daftar lowongan (Careers).
     */
    public function index()
    {
        $jobs = Job::orderBy('created_at', 'desc')->get();

        return view('careers', [
            'title' => 'Careers | IBINET',
            'jobs'  => $jobs,
        ]);
    }

    /**
     * Halaman detail satu job (public).
     * Sekarang mendukung tampilan "closed" jika lowongan sudah ditutup.
     */
    public function show(string $slug)
    {
        $job = Job::where('slug', $slug)->firstOrFail();

        // Jika lowongan sudah closed → tampilkan halaman khusus
        if (! $job->is_open) {
            return view('jobs.closed', compact('job'));
        }

        // Jika masih open → tampilkan detail biasa
        return view('jobs.show', compact('job'));
    }

    /**
     * Halaman daftar lowongan untuk ADMIN (kelola status is_open).
     * Route: admin.jobs.index
     */
    public function adminIndex()
    {
        $jobs = Job::orderBy('created_at', 'desc')->get();

        return view('admin.jobs', [
            'title' => 'Kelola Lowongan | IBINET',
            'jobs'  => $jobs,
        ]);
    }

    /**
     * Update status open/closed oleh ADMIN.
     * Route: admin.jobs.updateStatus
     */
    public function updateStatus(Request $request, Job $job)
    {
        // Validasi supaya benar-benar boolean
        $validated = $request->validate([
            'is_open' => ['required', 'boolean'],
        ]);

        $job->is_open = $validated['is_open'];
        $job->save();

        return back()->with('success', 'Status lowongan berhasil diperbarui!');
    }
}
