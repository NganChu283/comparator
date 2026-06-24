<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('jobs.index') }}" class="text-indigo-600 hover:underline">&larr; Quay lại</a>
        </div>

        <article class="p-6 border rounded">
            <h1 class="text-2xl font-semibold">{{ $job->title }}</h1>
            <div class="text-sm text-gray-600 mt-1">{{ $job->company->name ?? 'Công ty' }} • {{ $job->location }} • {{ $job->category->name ?? '' }}</div>

            <section class="mt-4">
                <h3 class="font-medium">Mô tả công việc</h3>
                <div class="prose max-w-none">{!! nl2br(e($job->description)) !!}</div>
            </section>

            <section class="mt-4">
                <h3 class="font-medium">Yêu cầu</h3>
                <div class="text-sm text-gray-700">{!! nl2br(e($job->requirements)) !!}</div>
            </section>

            <div class="mt-6">
                @auth
                    @if(auth()->user()->role === 'candidate')
                        @if($hasApplied)
                            <div class="text-green-600 font-medium">Bạn đã ứng tuyển việc làm này.</div>
                        @else
                            <form method="POST" action="{{ route('candidate.jobs.apply', $job) }}">
                                @csrf
                                <label class="block mb-2 text-sm">Chọn CV</label>
                                <select name="cv_id" class="border rounded px-3 py-1 w-full md:w-1/2">
                                    @foreach($candidateCvs as $cv)
                                        <option value="{{ $cv->id }}">{{ $cv->title }}</option>
                                    @endforeach
                                </select>
                                <button class="mt-3 bg-indigo-600 text-white px-4 py-2 rounded">Ứng tuyển</button>
                            </form>
                        @endif
                    @else
                        <div class="text-sm text-gray-600">Chỉ ứng viên mới có thể ứng tuyển. <a href="{{ route('login') }}" class="text-indigo-600">Đăng nhập</a> hoặc <a href="{{ route('register') }}" class="text-indigo-600">Đăng ký</a>.</div>
                    @endif
                @else
                    <div class="text-center">
                        <p class="mb-3">Bạn cần <a href="{{ route('login') }}" class="text-indigo-600">đăng nhập</a> hoặc <a href="{{ route('register') }}" class="text-indigo-600">đăng ký</a> để ứng tuyển.</p>
                        <div class="flex justify-center gap-3">
                            <a href="{{ route('login') }}" class="px-4 py-2 border rounded">Đăng nhập</a>
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Đăng ký</a>
                        </div>
                    </div>
                @endauth
            </div>
        </article>
    </div>
</div>
</x-app-layout>
<x-app-layout>
    <nav class="breadcrumbs">
        <a href="{{ route('home') }}">Trang chủ</a>
        <span class="material-symbols-outlined">chevron_right</span>
        <a href="{{ route('jobs.index') }}">Việc làm</a>
        <span class="material-symbols-outlined">chevron_right</span>
        <span>{{ $job->title }}</span>
    </nav>
    <div class="detail-layout">
        <div class="card">
            <h1>{{ $job->title }}</h1>
            <p><a href="{{ route('companies.show', $job->company) }}">{{ $job->company->name }}</a></p>
            <div class="actions" style="margin-bottom: 20px;">
                <span class="badge primary"><span class="material-symbols-outlined" style="font-size:14px;">category</span>{{ $job->category->name }}</span>
                <x-status-badge :status="$job->working_type"><span class="material-symbols-outlined" style="font-size:14px;">schedule</span></x-status-badge>
                <span class="badge"><span class="material-symbols-outlined" style="font-size:14px;">location_on</span>{{ $job->location }}</span>
                <span class="badge warn">Hạn {{ $job->deadline->format('d/m/Y') }}</span>
            </div>
            <h3>Mô tả công việc</h3>
            <p>{!! nl2br(e($job->description)) !!}</p>
            <h3>Yêu cầu</h3>
            <p>{!! nl2br(e($job->requirements)) !!}</p>
            <h3>Quyền lợi</h3>
            <p>{!! nl2br(e($job->benefits)) !!}</p>
            <h3>Thông tin tuyển dụng</h3>
            <div class="grid grid-3">
                <div class="feature-card">
                    <span class="brand-mark"><span class="material-symbols-outlined">payments</span></span>
                    <div><strong>Mức lương</strong><p class="muted small">@if ($job->salary_min || $job->salary_max) {{ number_format($job->salary_min ?? 0) }} - {{ number_format($job->salary_max ?? 0) }} VND @else Thương lượng @endif</p></div>
                </div>
                <div class="feature-card">
                    <span class="brand-mark"><span class="material-symbols-outlined">workspace_premium</span></span>
                    <div><strong>Kinh nghiệm</strong><p class="muted small">{{ $job->experience_level ?: 'Không yêu cầu' }}</p></div>
                </div>
                <div class="feature-card">
                    <span class="brand-mark"><span class="material-symbols-outlined">event</span></span>
                    <div><strong>Hạn nộp hồ sơ</strong><p class="muted small">{{ $job->deadline->format('d/m/Y') }}</p></div>
                </div>
            </div>
        </div>
        <div class="card sticky-card">
            <div class="logo-box" style="width:64px;height:64px;margin-bottom:12px;"><span class="material-symbols-outlined">domain</span></div>
            <h2>Ứng tuyển</h2>
            <div class="detail-list" style="margin-bottom: 18px;">
                <div><strong>Mức lương</strong><span>@if ($job->salary_min || $job->salary_max) {{ number_format($job->salary_min ?? 0) }} - {{ number_format($job->salary_max ?? 0) }} VND @else Thương lượng @endif</span></div>
                <div><strong>Kinh nghiệm</strong><span>{{ $job->experience_level ?: 'Không yêu cầu' }}</span></div>
            </div>
            @auth
                @if (auth()->user()->role === 'candidate')
                    <form method="POST" action="{{ $isSaved ? route('candidate.jobs.unsave', $job) : route('candidate.jobs.save', $job) }}">
                        @csrf
                        @if ($isSaved)
                            @method('DELETE')
                        @endif
                        <button class="button secondary" type="submit"><span class="material-symbols-outlined">favorite</span>{{ $isSaved ? 'Bỏ lưu việc làm' : 'Lưu việc làm' }}</button>
                    </form>
                    <hr>
                    @if ($hasApplied)
                        <p class="notice">Bạn đã ứng tuyển công việc này.</p>
                    @elseif ($candidateCvs->isEmpty())
                        <p>Bạn cần tạo hoặc upload CV trước khi ứng tuyển.</p>
                        <a class="button" href="{{ route('candidate.cvs.create') }}">Tạo CV</a>
                    @else
                        <form class="form" method="POST" action="{{ route('candidate.jobs.apply', $job) }}">
                            @csrf
                            <div class="field">
                                <label>Chọn CV</label>
                                <select name="cv_id" required>
                                    @foreach ($candidateCvs as $cv)
                                        <option value="{{ $cv->id }}">{{ $cv->title }} ({{ $cv->type === 'pdf' ? 'CV PDF' : 'CV online' }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="field">
                                <label>Thư giới thiệu</label>
                                <textarea name="cover_letter"></textarea>
                            </div>
                            <button class="button bright" type="submit">Gửi hồ sơ</button>
                        </form>
                    @endif
                @else
                    <p>Chỉ tài khoản ứng viên mới có thể ứng tuyển.</p>
                @endif
            @else
                <p>Đăng nhập để ứng tuyển công việc này.</p>
                <a class="button" href="{{ route('login') }}">Đăng nhập</a>
            @endauth
        </div>
    </div>
    <div class="section-title">
        <h2>Về công ty tuyển dụng</h2>
    </div>
    <section class="card">
        <div class="feature-card">
            <span class="company-logo-large" style="width:80px;height:80px;"><span class="material-symbols-outlined">domain</span></span>
            <div>
                <h3><a href="{{ route('companies.show', $job->company) }}">{{ $job->company->name }}</a></h3>
                <p class="muted">{{ $job->company->address }} · {{ $job->company->size }}</p>
                <p>{{ $job->company->description }}</p>
            </div>
        </div>
    </section>
</x-app-layout>
