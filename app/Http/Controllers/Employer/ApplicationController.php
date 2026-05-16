<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Job $job)
    {
        $this->authorizeJob($job);

        return view('employer.applications.index', [
            'job' => $job,
            'applications' => $job->applications()->with(['user', 'cv'])->latest()->paginate(10),
        ]);
    }

    public function show(Application $application)
    {
        $this->authorizeApplication($application);

        if ($application->status === 'pending') {
            $application->update(['status' => 'viewed']);
        }

        return view('employer.applications.show', [
            'application' => $application->load(['user', 'cv', 'job.company']),
        ]);
    }

    public function updateStatus(Request $request, Application $application)
    {
        $this->authorizeApplication($application);

        $data = $request->validate([
            'status' => ['required', 'in:pending,viewed,interview,accepted,rejected'],
        ]);

        $application->update($data);

        return back()->with('success', 'Đã cập nhật trạng thái hồ sơ.');
    }

    private function authorizeJob(Job $job): void
    {
        abort_unless(auth()->user()->company && $job->company_id === auth()->user()->company->id, 403);
    }

    private function authorizeApplication(Application $application): void
    {
        $application->loadMissing('job');
        $this->authorizeJob($application->job);
    }
}
