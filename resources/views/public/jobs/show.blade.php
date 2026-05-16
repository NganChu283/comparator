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
