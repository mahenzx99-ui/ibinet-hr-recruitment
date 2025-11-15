<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use App\Exports\ApplicationsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ApplicationController extends Controller
{
    /**
     * Menampilkan daftar semua pelamar (halaman admin)
     * + filter berdasarkan job (slug) dan status dari query string
     *
     * Contoh:
     * /admin/applications?job=network-engineer&status_filter=submitted
     */
    public function index(Request $request)
    {
        // Ambil list semua job untuk dropdown filter
        $jobs = Job::orderBy('title')->get();

        // Ambil filter dari query string
        $selectedJobSlug = $request->query('job');            // ?job=network-engineer
        $selectedStatus  = $request->query('status_filter');  // ?status_filter=submitted

        // Base query applications + relasi job
        $query = Application::with('job')
            ->orderBy('created_at', 'desc');

        // FILTER BERDASARKAN JOB (kalau ada dan bukan 'all')
        if ($selectedJobSlug && $selectedJobSlug !== 'all') {
            $query->whereHas('job', function ($q) use ($selectedJobSlug) {
                $q->where('slug', $selectedJobSlug);
            });
        }

        // FILTER BERDASARKAN STATUS (kalau ada dan bukan 'all')
        if ($selectedStatus && $selectedStatus !== 'all') {
            $query->where('status', $selectedStatus);
        }

        $applications = $query->get();

        return view('admin.applications', [
            'title'           => 'Daftar Pelamar | IBINET',
            'applications'    => $applications,
            'jobs'            => $jobs,
            'selectedJobSlug' => $selectedJobSlug,
            'selectedStatus'  => $selectedStatus,
        ]);
    }

    /**
     * HALAMAN FORM LAMARAN berdasarkan slug job
     */
    public function create(string $slug)
    {
        // Cari job berdasarkan slug dan yang masih open
        $job = Job::where('slug', $slug)
            ->where('is_open', true)
            ->firstOrFail();

        return view('jobs.apply', [
            'title' => 'Lamar ' . $job->title . ' - IBINET',
            'job'   => $job,
        ]);
    }

    /**
     * Menyimpan lamaran baru berdasarkan slug job
     */
    public function store(Request $request, string $slug)
    {
        // Cari job berdasarkan slug
        $job = Job::where('slug', $slug)->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'city'  => ['nullable', 'string', 'max:100'],
            'cv'    => ['required', 'file', 'mimes:pdf', 'max:2048'], // max 2MB
        ]);

        // Simpan file CV ke storage/app/public/cv
        $cvPath = $request->file('cv')->store('cv', 'public');

        // Simpan data ke tabel applications
        Application::create([
            'job_id'  => $job->id,
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'phone'   => $validated['phone'],
            'city'    => $validated['city'] ?? null,
            'cv_path' => $cvPath,
            'status'  => 'submitted',
            'notes'   => null,
        ]);

        // Redirect kembali ke halaman form apply + flash message sukses
        return redirect()
            ->route('jobs.apply.form', $job->slug)
            ->with('success', 'Lamaran kamu sudah terkirim ke tim HR IBINET.');
    }

    /**
     * Mengupdate status pelamar (submitted / reviewed / accepted / rejected)
     */
    public function updateStatus(Request $request, Application $application)
    {
        // Daftar status yang diperbolehkan
        $allowedStatuses = ['submitted', 'reviewed', 'accepted', 'rejected'];

        // Validasi status yang dikirim
        $validated = $request->validate([
            'status' => ['required', 'in:' . implode(',', $allowedStatuses)],
        ]);

        // Update di database
        $application->update([
            'status' => $validated['status'],
        ]);

        // Bawa lagi query ?job=... dan ?status_filter=... kalau sebelumnya pakai filter
        return redirect()
            ->route('admin.applications.index', $request->only('job', 'status_filter'))
            ->with('success', 'Status pelamar berhasil diperbarui.');
    }

    /**
     * Halaman detail satu pelamar.
     */
    public function show(Application $application)
    {
        // pastikan relasi job ikut di-load
        $application->load('job');

        return view('admin.application-show', [
            'title'       => 'Detail Pelamar | ' . $application->name,
            'application' => $application,
        ]);
    }

    /**
     * Update catatan HR untuk pelamar.
     */
    public function updateNotes(Request $request, Application $application)
    {
        $validated = $request->validate([
            'notes' => ['nullable', 'string', 'max:5000'],
        ]);

        $application->update([
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->route('admin.applications.show', $application->id)
            ->with('success', 'Catatan HR berhasil disimpan.');
    }

    /**
     * Export data pelamar ke Excel (ikut filter job & status kalau ada).
     */
    public function export(Request $request)
    {
        $jobSlug      = $request->query('job');           // ?job=network-engineer
        $statusFilter = $request->query('status_filter'); // ?status_filter=submitted

        $fileName = 'applications_' . now()->format('Y-m-d_H-i') . '.xlsx';

        return Excel::download(
            new ApplicationsExport($jobSlug, $statusFilter),
            $fileName
        );
    }
}