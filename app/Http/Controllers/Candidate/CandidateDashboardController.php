<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class CandidateDashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        return view('candidate.dashboard', [
            'cvCount' => $user->cvs()->count(),
            'applicationCount' => $user->applications()->count(),
            'savedCount' => $user->savedJobs()->count(),
            'applications' => $user->applications()->with(['job.company'])->latest()->limit(5)->get(),
        ]);
    }
}
