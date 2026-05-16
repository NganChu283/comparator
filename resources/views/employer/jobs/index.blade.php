<x-app-layout>
    <x-dashboard-shell title="Tin tuyển dụng" subtitle="Quản lý các tin đang hiển thị trên hệ thống.">
    <x-slot name="actions"><a class="button" href="{{ route('employer.jobs.create') }}"><span class="material-symbols-outlined">add</span>Đăng tin</a></x-slot>
    <div class="table-wrap">
    <table class="table">
        <tr><th>Tiêu đề</th><th>Ngành</th><th>Trạng thái</th><th>Hồ sơ</th><th></th></tr>
        @foreach ($jobs as $job)
            <tr>
                <td><a href="{{ route('employer.jobs.show', $job) }}">{{ $job->title }}</a></td>
                <td>{{ $job->category->name }}</td>
                <td><x-status-badge :status="$job->status" /></td>
                <td><a href="{{ route('employer.jobs.applications', $job) }}">{{ $job->applications()->count() }}</a></td>
                <td class="actions">
                    <a href="{{ route('employer.jobs.edit', $job) }}">Sửa</a>
                    <form method="POST" action="{{ route('employer.jobs.destroy', $job) }}">
                        @csrf @method('DELETE')
                        <button class="link-button" type="submit">Ẩn</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    </div>
    <div class="pagination">{{ $jobs->links() }}</div>
    </x-dashboard-shell>
</x-app-layout>
