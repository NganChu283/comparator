<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\SavedJob;
use Illuminate\Http\Request;

class SavedJobController extends Controller
{
    public function index()
    {
        return view('candidate.saved-jobs.index', [
            'savedJobs' => auth()->user()->savedJobs()->with(['job.company', 'job.category'])->latest()->paginate(10),
        ]);
    }

    public function store(Job $job)
    {
        SavedJob::firstOrCreate([
            'user_id' => auth()->id(),
            'job_id' => $job->id,
        ]);

        return back()->with('success', 'Đã lưu việc làm.');
    }

    public function destroy(Job $job)
    {
        SavedJob::where('user_id', auth()->id())->where('job_id', $job->id)->delete();

        return back()->with('success', 'Đã bỏ lưu việc làm.');
    }
}
