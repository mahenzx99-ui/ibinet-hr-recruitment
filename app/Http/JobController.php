<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = [
            [
                'title'    => 'Staff Finance',
                'location' => 'Denpasar',
                'type'     => 'Full-time',
            ],
            [
                'title'    => 'Network Engineer',
                'location' => 'Denpasar',
                'type'     => 'Full-time',
            ],
        ];

        return view('careers', [
            'title' => 'Careers | IBINET',
            'jobs'  => $jobs,
        ]);
    }
}
