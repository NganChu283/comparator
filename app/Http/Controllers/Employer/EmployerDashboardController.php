<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class EmployerDashboardController extends Controller
{
    public function index(): View
    {
        $company = auth()->user()->company()->first();

        return view('employer.dashboard', [
            'company' => $company,
            'jobCount' => $company?->jobs()->count() ?? 0,
            'applicationCount' => $company?->jobs()->withCount('applications')->get()->sum('applications_count') ?? 0,
            'recentApplications' => $company
                ? $company->jobs()->with(['applications.user', 'applications.cv'])->get()->flatMap->applications->sortByDesc('created_at')->take(5)
                : collect(),
        ]);
    }
}
