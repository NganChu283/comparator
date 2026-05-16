<x-app-layout>
    <x-dashboard-shell title="Tổng quan tuyển dụng" subtitle="Cập nhật số liệu tuyển dụng và hồ sơ mới nhất.">
    @unless ($company)
        <div class="errors">Bạn cần tạo thông tin công ty trước khi đăng tin tuyển dụng.</div>
        <a class="button" href="{{ route('employer.company.index') }}">Tạo công ty</a>
    @endunless
    <div class="stats">
        <div class="stat-card"><strong>{{ $jobCount }}</strong><span>Tin tuyển dụng</span></div>
        <div class="stat-card"><strong>{{ $applicationCount }}</strong><span>Hồ sơ ứng tuyển</span></div>
    </div>
    <div class="section-title"><h2>Hồ sơ mới</h2></div>
    <div class="table-wrap">
    <table class="table">
        <tr><th>Ứng viên</th><th>CV</th><th>Trạng thái</th></tr>
        @foreach ($recentApplications as $application)
            <tr>
                <td>{{ $application->user->name }}</td>
                <td><a href="{{ route('employer.applications.show', $application) }}">{{ $application->cv?->title ?? 'CV đã xóa' }}</a></td>
                <td><x-status-badge :status="$application->status" /></td>
            </tr>
        @endforeach
    </table>
    </div>
    </x-dashboard-shell>
</x-app-layout>
