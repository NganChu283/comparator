<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <a href="{{ route('companies.index') }}" class="text-indigo-600 hover:underline">&larr; Quay lại</a>

        <header class="mt-4 mb-6 flex items-center gap-4">
            <div class="w-20 h-20 bg-gray-100 rounded overflow-hidden flex items-center justify-center">@if($company->logo)<img src="{{ asset('storage/'.$company->logo) }}" alt="" class="w-full h-full object-cover">@else<span class="material-symbols-outlined">apartment</span>@endif</div>
            <div>
                <h1 class="text-2xl font-semibold">{{ $company->name }}</h1>
                <div class="text-sm text-gray-600">{{ $company->address }}</div>
            </div>
        </header>

        <section class="mb-6">
            <h3 class="font-medium">Giới thiệu</h3>
            <div class="text-sm text-gray-700">{{ $company->description }}</div>
        </section>

        <section>
            <h3 class="font-medium mb-3">Tin tuyển dụng</h3>
            <div class="space-y-4">
                @forelse($company->jobs as $job)
                    <a href="{{ route('jobs.show', $job) }}" class="block p-4 border rounded hover:shadow">
                        <h4 class="font-medium">{{ $job->title }}</h4>
                        <div class="text-sm text-gray-600">{{ $job->location }} • {{ $job->category->name ?? '' }}</div>
                    </a>
                @empty
                    <div class="text-gray-600">Hiện chưa có tin tuyển dụng.</div>
                @endforelse
            </div>
        </section>
    </div>
</div>
</x-app-layout>
<x-app-layout>
    <section class="company-hero full-bleed">
        <img src="https://images.unsplash.com/photo-1497366811353-6870744d04b2?auto=format&fit=crop&w=1600&q=80" alt="Không gian làm việc hiện đại">
    </section>
    <section class="company-box full-bleed">
        <div class="company-profile">
            <div class="company-logo-large"><span class="material-symbols-outlined" style="font-size:64px;">domain</span></div>
            <div style="flex:1;">
                <h1>{{ $company->name }}</h1>
                @if ($company->website)
                    <p><a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></p>
                @endif
                <div class="actions">
                    <span class="badge"><span class="material-symbols-outlined" style="font-size:14px;">location_on</span>{{ $company->address }}</span>
                    <span class="badge"><span class="material-symbols-outlined" style="font-size:14px;">group</span>{{ $company->size }}</span>
                    <span class="badge primary">{{ $company->jobs->where('status', 'active')->count() }} việc đang mở</span>
                </div>
            </div>
        </div>
    </section>
    <div style="height: 36px;"></div>
    <section class="card">
        <h2>Giới thiệu</h2>
        <p>{!! nl2br(e($company->description)) !!}</p>
    </section>
    <div class="section-title">
        <h2>Tại sao chọn {{ $company->name }}?</h2>
    </div>
    <section class="feature-band">
        <div class="grid grid-3">
            <div class="feature-card">
                <span class="brand-mark"><span class="material-symbols-outlined">health_and_safety</span></span>
                <div>
                    <h3>Phúc lợi rõ ràng</h3>
                    <p class="muted">Quy trình tuyển dụng minh bạch, quyền lợi được mô tả rõ trong từng tin đăng.</p>
                </div>
            </div>
            <div class="feature-card">
                <span class="brand-mark"><span class="material-symbols-outlined">devices</span></span>
                <div>
                    <h3>Môi trường hiện đại</h3>
                    <p class="muted">Không gian làm việc chuyên nghiệp, phù hợp ứng viên muốn phát triển lâu dài.</p>
                </div>
            </div>
            <div class="feature-card">
                <span class="brand-mark"><span class="material-symbols-outlined">schedule</span></span>
                <div>
                    <h3>Quy trình nhanh</h3>
                    <p class="muted">Nhà tuyển dụng có thể xem CV và cập nhật trạng thái hồ sơ trực tiếp trên hệ thống.</p>
                </div>
            </div>
        </div>
    </section>
    <div class="section-title">
        <h2>Không gian làm việc</h2>
    </div>
    <div class="gallery-grid">
        <img src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=900&q=80" alt="Văn phòng mở">
        <img src="https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=900&q=80" alt="Đội ngũ làm việc">
        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=900&q=80" alt="Phòng họp hiện đại">
    </div>
    <div class="section-title">
        <h2>Việc làm đang tuyển</h2>
    </div>
    <div class="grid grid-2">
        @foreach ($company->jobs->where('status', 'active') as $job)
            @include('partials.job-card', ['job' => $job])
        @endforeach
    </div>
</x-app-layout>
