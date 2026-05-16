<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.jobs.index', [
            'jobs' => Job::with(['company', 'category'])
                ->when($request->q, fn ($query, $q) => $query->where('title', 'like', "%{$q}%"))
                ->when($request->status, fn ($query, $status) => $query->where('status', $status))
                ->when($request->category_id, fn ($query, $id) => $query->where('category_id', $id))
                ->latest()
                ->paginate(12)
                ->withQueryString(),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function updateStatus(Request $request, Job $job)
    {
        $data = $request->validate([
            'status' => ['required', 'in:active,hidden,rejected,expired'],
        ]);

        $job->update($data);

        return back()->with('success', 'Đã cập nhật trạng thái tin tuyển dụng.');
    }
}
