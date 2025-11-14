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
     * Halaman detail satu job.
     */
    public function show(string $slug)
    {
        $job = Job::where('slug', $slug)->firstOrFail();

        return view('job-detail', [
            'title' => $job->title . ' | IBINET',
            'job'   => $job,
        ]);
    }
}
