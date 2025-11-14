<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    // Izinkan kolom ini untuk mass assignment (Job::create([...]))
    protected $fillable = [
        'title',
        'slug',
        'location',
        'type',
        'short_description',
        'description',
        'requirements',
        'is_open',
    ];
}
