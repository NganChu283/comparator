<x-app-layout>
    <x-dashboard-shell title="Quản lý công ty" subtitle="Theo dõi hồ sơ công ty và trạng thái hoạt động.">
    <div class="table-wrap">
    <table class="table">
        <tr><th>Công ty</th><th>Nhà tuyển dụng</th><th>Trạng thái</th><th></th></tr>
        @foreach ($companies as $company)
            <tr>
                <td><a href="{{ route('companies.show', $company) }}">{{ $company->name }}</a></td>
                <td>{{ $company->user->email }}</td>
                <td><x-status-badge :status="$company->status" /></td>
                <td>
                    <form class="actions" method="POST" action="{{ route('admin.companies.status', $company) }}">
                        @csrf @method('PATCH')
                        <select name="status">
                            @foreach (['active' => 'Đang hoạt động', 'blocked' => 'Đã khóa'] as $status => $label)
                                <option value="{{ $status }}" @selected($company->status === $status)>{{ $label }}</option>
                            @endforeach
                        </select>
                        <button class="button secondary" type="submit">Lưu</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    </div>
    <div class="pagination">{{ $companies->links() }}</div>
    </x-dashboard-shell>
</x-app-layout>
