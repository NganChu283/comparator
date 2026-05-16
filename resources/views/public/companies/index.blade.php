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
