<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold mb-6">Danh sách công ty</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($companies as $company)
            <a href="{{ route('companies.show', $company) }}" class="block p-4 border rounded hover:shadow">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-gray-100 rounded overflow-hidden flex items-center justify-center">@if($company->logo)<img src="{{ asset('storage/'.$company->logo) }}" alt="" class="w-full h-full object-cover">@else<span class="material-symbols-outlined">apartment</span>@endif</div>
                    <div>
                        <div class="font-medium">{{ $company->name }}</div>
                        <div class="text-sm text-gray-600">{{ Str::limit($company->description, 80) }}</div>
                    </div>
                </div>
            </a>
        @empty
            <div class="text-gray-600">Chưa có công ty nào.</div>
        @endforelse
    </div>

    <div class="mt-6">{{ $companies->links() }}</div>
</div>
</x-app-layout>
<x-app-layout>
    <div class="page-head">
        <div>
            <h1>Danh sách công ty</h1>
            <p class="muted">Khám phá nhà tuyển dụng đang có tin tuyển dụng trên CareerLink.</p>
        </div>
    </div>
    <div class="grid grid-3">
        @foreach ($companies as $company)
            <div class="card">
                <div class="logo-box" style="margin-bottom: 12px;"><span class="material-symbols-outlined">domain</span></div>
                <h3><a href="{{ route('companies.show', $company) }}">{{ $company->name }}</a></h3>
                <p class="muted">{{ $company->address }}</p>
                <p><span class="badge primary">{{ $company->jobs_count }} tin tuyển dụng</span></p>
            </div>
        @endforeach
    </div>
    <div class="pagination">{{ $companies->links() }}</div>
</x-app-layout>
