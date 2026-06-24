<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Danh sách việc làm</h1>
        <form method="GET" action="{{ route('jobs.index') }}" class="flex gap-2">
            <input name="q" value="{{ request('q') }}" placeholder="Tìm việc, kỹ năng..." class="border rounded px-3 py-1" />
            <select name="category_id" class="border rounded px-2 py-1">
                <option value="">Tất cả ngành</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" @selected(request('category_id') == $c->id)>{{ $c->name }}</option>
                @endforeach
            </select>
            <input name="location" value="{{ request('location') }}" placeholder="Địa điểm" class="border rounded px-3 py-1" />
            <button class="bg-indigo-600 text-white px-3 py-1 rounded">Tìm</button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2">
            <div class="space-y-4">
                @forelse($jobs as $job)
                    <div class="p-4 border rounded hover:shadow">
                        <a href="{{ route('jobs.show', $job) }}" class="block">
                            <h3 class="text-lg font-medium">{{ $job->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $job->company->name ?? 'Công ty' }} • {{ $job->location }} • {{ $job->category->name ?? '' }}</p>
                            <p class="mt-2 text-gray-700 text-sm">{{ Str::limit($job->description, 180) }}</p>
                        </a>
                    </div>
                @empty
                    <div class="text-gray-600">Không tìm thấy kết quả.</div>
                @endforelse
            </div>

            <div class="mt-6">{{ $jobs->links() }}</div>
        </div>

        <aside>
            <div class="p-4 border rounded">
                <h4 class="font-semibold mb-2">Bộ lọc nhanh</h4>
                <p class="text-sm text-gray-600">Bạn có thể kết hợp tìm kiếm, ngành nghề và địa điểm.</p>
            </div>
        </aside>
    </div>
</div>
</x-app-layout>
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
