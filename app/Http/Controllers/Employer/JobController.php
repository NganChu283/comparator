<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = auth()->user()->company;
        abort_unless($company, 403, 'Vui lòng tạo công ty trước.');

        return view('employer.jobs.index', [
            'jobs' => $company->jobs()->with('category')->latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(auth()->user()->company, 403, 'Vui lòng tạo công ty trước.');

        return view('employer.jobs.create', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $company = auth()->user()->company;
        abort_unless($company, 403, 'Vui lòng tạo công ty trước.');

        $data = $this->validatedData($request);
        $data['company_id'] = $company->id;
        $data['status'] = 'active';

        Job::create($data);

        return redirect()->route('employer.jobs.index')->with('success', 'Đã đăng tin tuyển dụng.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $this->authorizeJob($job);

        return view('employer.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        $this->authorizeJob($job);

        return view('employer.jobs.edit', [
            'job' => $job,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        $this->authorizeJob($job);

        $job->update($this->validatedData($request));

        return redirect()->route('employer.jobs.index')->with('success', 'Đã cập nhật tin tuyển dụng.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $this->authorizeJob($job);
        $job->update(['status' => 'hidden']);

        return redirect()->route('employer.jobs.index')->with('success', 'Đã ẩn tin tuyển dụng.');
    }

    private function authorizeJob(Job $job): void
    {
        abort_unless(auth()->user()->company && $job->company_id === auth()->user()->company->id, 403);
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['required', 'string'],
            'requirements' => ['required', 'string'],
            'benefits' => ['nullable', 'string'],
            'salary_min' => ['nullable', 'numeric', 'min:0'],
            'salary_max' => ['nullable', 'numeric', 'min:0', 'gte:salary_min'],
            'location' => ['required', 'string', 'max:255'],
            'working_type' => ['required', 'in:full-time,part-time,remote,internship'],
            'experience_level' => ['nullable', 'string', 'max:100'],
            'deadline' => ['required', 'date', 'after:today'],
        ]);
    }
}
