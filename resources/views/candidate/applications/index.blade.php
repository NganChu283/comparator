<x-app-layout>
    <x-dashboard-shell title="Lịch sử ứng tuyển" subtitle="Theo dõi trạng thái xử lý hồ sơ từ nhà tuyển dụng.">
    <div class="table-wrap">
    <table class="table">
        <tr><th>Công việc</th><th>Công ty</th><th>CV</th><th>Trạng thái</th><th>Ngày ứng tuyển</th></tr>
        @foreach ($applications as $application)
            <tr>
                <td><a href="{{ route('jobs.show', $application->job) }}">{{ $application->job->title }}</a></td>
                <td>{{ $application->job->company->name }}</td>
                <td>{{ $application->cv?->title ?? 'CV đã xóa' }}</td>
                <td><x-status-badge :status="$application->status" /></td>
                <td>{{ $application->created_at->format('d/m/Y') }}</td>
            </tr>
        @endforeach
    </table>
    </div>
    <div class="pagination">{{ $applications->links() }}</div>
    </x-dashboard-shell>
</x-app-layout>
