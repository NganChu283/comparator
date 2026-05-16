<x-app-layout>
    <x-dashboard-shell title="Ứng viên cho: {{ $job->title }}">
    <div class="table-wrap">
    <table class="table">
        <tr><th>Ứng viên</th><th>Email</th><th>CV</th><th>Trạng thái</th><th></th></tr>
        @foreach ($applications as $application)
            <tr>
                <td>{{ $application->user->name }}</td>
                <td>{{ $application->user->email }}</td>
                <td>{{ $application->cv?->title ?? 'CV đã xóa' }}</td>
                <td><x-status-badge :status="$application->status" /></td>
                <td><a href="{{ route('employer.applications.show', $application) }}">Xem</a></td>
            </tr>
        @endforeach
    </table>
    </div>
    <div class="pagination">{{ $applications->links() }}</div>
    </x-dashboard-shell>
</x-app-layout>
