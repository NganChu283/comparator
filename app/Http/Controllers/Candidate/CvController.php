<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Cv;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class CvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('candidate.cvs.index', [
            'cvs' => auth()->user()->cvs()->latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('candidate.cvs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['user_id'] = auth()->id();

        if ($request->input('type') === 'pdf') {
            $request->validate([
                'file' => ['required', 'file', 'mimes:pdf', 'max:5120'],
            ]);

            $data['file_path'] = $request->file('file')->store('cvs', 'public');
            $data['type'] = 'pdf';
            $data = Arr::only($data, ['user_id', 'title', 'type', 'file_path']);
        }

        Cv::create($data);

        return redirect()->route('candidate.cvs.index')->with('success', 'Đã tạo CV thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cv $cv)
    {
        abort_unless($cv->user_id === auth()->id(), 403);

        return view('candidate.cvs.show', compact('cv'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cv $cv)
    {
        abort_unless($cv->user_id === auth()->id(), 403);

        return view('candidate.cvs.edit', compact('cv'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cv $cv)
    {
        abort_unless($cv->user_id === auth()->id(), 403);

        $data = $this->validatedData($request);

        if ($request->input('type') === 'pdf') {
            $rules = ['file' => ['nullable', 'file', 'mimes:pdf', 'max:5120']];
            $request->validate($rules);

            $data = Arr::only($data, ['title']);
            $data['type'] = 'pdf';

            if ($request->hasFile('file')) {
                if ($cv->file_path) {
                    Storage::disk('public')->delete($cv->file_path);
                }
                $data['file_path'] = $request->file('file')->store('cvs', 'public');
            }
        } else {
            $data['type'] = 'online';
            $data['file_path'] = null;
        }

        $cv->update($data);

        return redirect()->route('candidate.cvs.index')->with('success', 'Đã cập nhật CV.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cv $cv)
    {
        abort_unless($cv->user_id === auth()->id(), 403);

        if ($cv->file_path) {
            Storage::disk('public')->delete($cv->file_path);
        }

        $cv->delete();

        return redirect()->route('candidate.cvs.index')->with('success', 'Đã xóa CV.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:online,pdf'],
            'full_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
            'objective' => ['nullable', 'string'],
            'education' => ['nullable', 'string'],
            'experience' => ['nullable', 'string'],
            'skills' => ['nullable', 'string'],
            'projects' => ['nullable', 'string'],
        ]);

        foreach (['education', 'experience', 'skills', 'projects'] as $field) {
            $data[$field] = collect(preg_split('/\r\n|\r|\n/', $data[$field] ?? ''))
                ->map(fn ($line) => trim($line))
                ->filter()
                ->values()
                ->all();
        }

        return $data;
    }
}
