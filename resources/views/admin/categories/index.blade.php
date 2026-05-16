<x-app-layout>
    <x-dashboard-shell title="Quản lý ngành nghề" subtitle="Danh mục dùng khi nhà tuyển dụng đăng tin.">
    <x-slot name="actions"><a class="button" href="{{ route('admin.categories.create') }}"><span class="material-symbols-outlined">add</span>Thêm ngành</a></x-slot>
    <div class="table-wrap">
    <table class="table">
        <tr><th>Tên</th><th>Slug</th><th>Số job</th><th></th></tr>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->jobs_count }}</td>
                <td class="actions">
                    <a href="{{ route('admin.categories.edit', $category) }}">Sửa</a>
                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                        @csrf @method('DELETE')
                        <button class="link-button" type="submit">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    </div>
    <div class="pagination">{{ $categories->links() }}</div>
    </x-dashboard-shell>
</x-app-layout>
