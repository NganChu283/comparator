<x-app-layout>
    <div class="page-head">
        <div>
            <h1>Kết quả tìm kiếm việc làm</h1>
            <p class="muted">{{ $jobs->total() }} việc làm phù hợp</p>
        </div>
    </div>
    <form class="search-panel" method="GET" action="{{ route('jobs.index') }}" style="position: sticky; top: 82px; z-index: 10; margin-bottom: 20px;">
        <div class="search-field">
            <span class="material-symbols-outlined">search</span>
            <input name="q" value="{{ request('q') }}" placeholder="Tên công việc, kỹ năng, công ty...">
        </div>
        <div class="search-field">
            <span class="material-symbols-outlined">category</span>
                <select name="category_id">
                    <option value="">Tất cả ngành nghề</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
        </div>
        <div class="search-field">
            <span class="material-symbols-outlined">location_on</span>
            <input name="location" value="{{ request('location') }}" placeholder="Địa điểm">
        </div>
        <button class="button bright" type="submit">Tìm kiếm</button>
    </form>
    <div class="grid grid-2">
        @forelse ($jobs as $job)
            @include('partials.job-card', ['job' => $job])
        @empty
            <div class="empty-state">Không có việc làm phù hợp.</div>
        @endforelse
    </div>
    <div class="pagination">{{ $jobs->links() }}</div>
</x-app-layout>
