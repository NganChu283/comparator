<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        return view('candidate.applications.index', [
            'applications' => auth()->user()->applications()->with(['job.company', 'cv'])->latest()->paginate(10),
        ]);
    }

    public function store(Request $request, Job $job)
    {
        $request->validate([
            'cv_id' => ['required', 'exists:cvs,id'],
            'cover_letter' => ['nullable', 'string', 'max:5000'],
        ]);

        abort_unless($job->status === 'active', 404);

        if ($job->deadline->isPast()) {
            return back()->withErrors('Tin tuyển dụng đã hết hạn.');
        }

        $cv = auth()->user()->cvs()->whereKey($request->cv_id)->firstOrFail();

        $exists = Application::where('job_id', $job->id)->where('user_id', auth()->id())->exists();
        if ($exists) {
            return back()->withErrors('Bạn đã ứng tuyển công việc này.');
        }

        Application::create([
            'job_id' => $job->id,
            'user_id' => auth()->id(),
            'cv_id' => $cv->id,
            'cover_letter' => $request->cover_letter,
            'status' => 'pending',
        ]);

        return redirect()->route('candidate.applications.index')->with('success', 'Ứng tuyển thành công.');
    }
}
