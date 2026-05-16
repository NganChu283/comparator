<x-app-layout>
    <x-dashboard-shell title="Quản lý người dùng" subtitle="Tìm kiếm, lọc và khóa/mở tài khoản.">
    <form class="card form" method="GET">
        <div class="grid grid-2">
            <div class="field"><label>Tìm kiếm</label><input name="q" value="{{ request('q') }}"></div>
            <div class="field">
                <label>Vai trò</label>
                <select name="role">
                    <option value="">Tất cả</option>
                    @foreach (['candidate' => 'Ứng viên', 'employer' => 'Nhà tuyển dụng', 'admin' => 'Quản trị viên'] as $role => $label)
                        <option value="{{ $role }}" @selected(request('role') === $role)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button class="button" type="submit">Lọc</button>
    </form>
    <div class="table-wrap" style="margin-top: 16px;">
    <table class="table">
        <tr><th>Tên</th><th>Email</th><th>Vai trò</th><th>Trạng thái</th><th></th></tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><x-status-badge :status="$user->role" /></td>
                <td><x-status-badge :status="$user->status" /></td>
                <td>
                    @if ($user->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}">
                            @csrf @method('PATCH')
                            <button class="button secondary" type="submit">{{ $user->status === 'blocked' ? 'Mở khóa' : 'Khóa' }}</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    </div>
    <div class="pagination">{{ $users->links() }}</div>
    </x-dashboard-shell>
</x-app-layout>
