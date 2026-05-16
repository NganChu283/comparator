<x-app-layout>
    <x-dashboard-shell title="Bảng điều khiển ứng viên" subtitle="Theo dõi CV, việc làm đã lưu và trạng thái ứng tuyển.">
    <div class="stats">
        <div class="stat-card"><strong>{{ $cvCount }}</strong><span>CV</span></div>
        <div class="stat-card"><strong>{{ $applicationCount }}</strong><span>Hồ sơ đã ứng tuyển</span></div>
        <div class="stat-card"><strong>{{ $savedCount }}</strong><span>Việc đã lưu</span></div>
        <div class="stat-card"><strong><a href="{{ route('jobs.index') }}">Tìm</a></strong><span>Danh sách việc làm</span></div>
    </div>
    <div class="section-title"><h2>Hồ sơ gần đây</h2></div>
    <div class="table-wrap">
    <table class="table">
        <tr><th>Công việc</th><th>Công ty</th><th>Trạng thái</th></tr>
        @foreach ($applications as $application)
            <tr>
                <td><a href="{{ route('jobs.show', $application->job) }}">{{ $application->job->title }}</a></td>
                <td>{{ $application->job->company->name }}</td>
                <td><x-status-badge :status="$application->status" /></td>
            </tr>
        @endforeach
    </table>
    </div>
    </x-dashboard-shell>
</x-app-layout>
