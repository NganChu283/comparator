<x-app-layout>
    <x-dashboard-shell title="Quản lý tin tuyển dụng" subtitle="Lọc và cập nhật trạng thái tin tuyển dụng.">
    <form class="card form" method="GET">
        <div class="grid grid-3">
            <div class="field"><label>Từ khóa</label><input name="q" value="{{ request('q') }}"></div>
            <div class="field">
                <label>Trạng thái</label>
                <select name="status">
                    <option value="">Tất cả</option>
                    @foreach (['active' => 'Đang hoạt động', 'hidden' => 'Đã ẩn', 'expired' => 'Hết hạn', 'rejected' => 'Từ chối'] as $status => $label)
                        <option value="{{ $status }}" @selected(request('status') === $status)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label>Ngành</label>
                <select name="category_id">
                    <option value="">Tất cả</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button class="button" type="submit">Lọc</button>
    </form>
    <div class="table-wrap" style="margin-top: 16px;">
    <table class="table">
        <tr><th>Tin</th><th>Công ty</th><th>Ngành</th><th>Trạng thái</th><th></th></tr>
        @foreach ($jobs as $job)
            <tr>
                <td><a href="{{ route('jobs.show', $job) }}">{{ $job->title }}</a></td>
                <td>{{ $job->company->name }}</td>
                <td>{{ $job->category->name }}</td>
                <td><x-status-badge :status="$job->status" /></td>
                <td>
                    <form class="actions" method="POST" action="{{ route('admin.jobs.status', $job) }}">
                        @csrf @method('PATCH')
                        <select name="status">
                            @foreach (['active' => 'Đang hoạt động', 'hidden' => 'Đã ẩn', 'expired' => 'Hết hạn', 'rejected' => 'Từ chối'] as $status => $label)
                                <option value="{{ $status }}" @selected($job->status === $status)>{{ $label }}</option>
                            @endforeach
                        </select>
                        <button class="button secondary" type="submit">Lưu</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    </div>
    <div class="pagination">{{ $jobs->links() }}</div>
    </x-dashboard-shell>
</x-app-layout>
