<x-app-layout>
    <x-dashboard-shell title="CV của tôi" subtitle="Tạo CV online chi tiết hoặc upload CV PDF.">
    <x-slot name="actions"><a class="button" href="{{ route('candidate.cvs.create') }}"><span class="material-symbols-outlined">add</span>Tạo CV</a></x-slot>
    <div class="table-wrap">
    <table class="table">
        <tr><th>Tên CV</th><th>Loại</th><th>Ngày tạo</th><th></th></tr>
        @foreach ($cvs as $cv)
            <tr>
                <td><a href="{{ route('candidate.cvs.show', $cv) }}">{{ $cv->title }}</a></td>
                <td><x-status-badge :status="$cv->type" /></td>
                <td>{{ $cv->created_at->format('d/m/Y') }}</td>
                <td class="actions">
                    <a href="{{ route('candidate.cvs.edit', $cv) }}">Sửa</a>
                    <form method="POST" action="{{ route('candidate.cvs.destroy', $cv) }}">
                        @csrf @method('DELETE')
                        <button class="link-button" type="submit">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    </div>
    <div class="pagination">{{ $cvs->links() }}</div>
    </x-dashboard-shell>
</x-app-layout>
