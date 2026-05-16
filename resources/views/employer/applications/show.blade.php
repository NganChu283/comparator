<x-app-layout>
    <x-dashboard-shell title="Chi tiết hồ sơ ứng tuyển">
    <div class="grid grid-2">
        <div class="card">
            <h1>{{ $application->user->name }}</h1>
            <p>{{ $application->user->email }}</p>
            <p class="muted">Ứng tuyển: {{ $application->job->title }}</p>
            <h3>Thư giới thiệu</h3>
            <p>{!! nl2br(e($application->cover_letter)) !!}</p>
            <form class="form" method="POST" action="{{ route('employer.applications.status', $application) }}">
                @csrf @method('PATCH')
                <div class="field">
                    <label>Trạng thái</label>
                    <select name="status">
                        @foreach (['pending' => 'Chờ xử lý', 'viewed' => 'Đã xem', 'interview' => 'Mời phỏng vấn', 'accepted' => 'Phù hợp', 'rejected' => 'Từ chối'] as $status => $label)
                            <option value="{{ $status }}" @selected($application->status === $status)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="button" type="submit">Cập nhật</button>
            </form>
        </div>
        <div class="card">
            <h2>{{ $application->cv?->title ?? 'CV đã xóa' }}</h2>
            @if ($application->cv && $application->cv->type === 'pdf')
                <a class="button" href="{{ Storage::url($application->cv->file_path) }}" target="_blank">Xem PDF</a>
            @elseif ($application->cv)
                <p>{{ $application->cv->full_name }} - {{ $application->cv->email }}</p>
                @foreach (['education' => 'Học vấn', 'experience' => 'Kinh nghiệm', 'skills' => 'Kỹ năng', 'projects' => 'Dự án'] as $field => $label)
                    <h3>{{ $label }}</h3>
                    <ul>
                        @foreach ($application->cv->{$field} ?? [] as $line)
                            <li>{{ $line }}</li>
                        @endforeach
                    </ul>
                @endforeach
            @endif
        </div>
    </div>
    </x-dashboard-shell>
</x-app-layout>
