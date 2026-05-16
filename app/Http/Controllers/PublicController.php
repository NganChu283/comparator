<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        return view('public.home', [
            'jobs' => Job::with(['company', 'category'])->where('status', 'active')->latest()->limit(6)->get(),
            'companies' => Company::withCount('jobs')->where('status', 'active')->latest()->limit(6)->get(),
            'categories' => Category::withCount('jobs')->orderBy('name')->get(),
        ]);
    }

    public function jobs(Request $request)
    {
        $jobs = Job::with(['company', 'category'])
            ->where('status', 'active')
            ->when($request->q, fn ($query, $q) => $query->where('title', 'like', "%{$q}%"))
            ->when($request->category_id, fn ($query, $id) => $query->where('category_id', $id))
            ->when($request->location, fn ($query, $location) => $query->where('location', 'like', "%{$location}%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('public.jobs.index', [
            'jobs' => $jobs,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function jobShow(Job $job)
    {
        abort_unless($job->status === 'active' || auth()->user()?->role === 'admin', 404);

        return view('public.jobs.show', [
            'job' => $job->load(['company.user', 'category']),
            'candidateCvs' => auth()->user()?->role === 'candidate'
                ? auth()->user()->cvs()->latest()->get()
                : collect(),
            'hasApplied' => auth()->user()?->role === 'candidate'
                ? $job->applications()->where('user_id', auth()->id())->exists()
                : false,
            'isSaved' => auth()->user()?->role === 'candidate'
                ? $job->savedJobs()->where('user_id', auth()->id())->exists()
                : false,
        ]);
    }

    public function companies()
    {
        return view('public.companies.index', [
            'companies' => Company::withCount('jobs')->where('status', 'active')->latest()->paginate(12),
        ]);
    }

    public function companyShow(Company $company)
    {
        abort_unless($company->status === 'active' || auth()->user()?->role === 'admin', 404);

        return view('public.companies.show', [
            'company' => $company->load(['jobs.category']),
        ]);
    }
}
