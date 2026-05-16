@props(['title' => '', 'subtitle' => '', 'role' => auth()->user()?->role])

@php
    $groups = [
        'candidate' => [
            ['candidate.dashboard', 'dashboard', 'Bảng điều khiển'],
            ['candidate.cvs.index', 'description', 'CV của tôi'],
            ['candidate.applications.index', 'send', 'Đã ứng tuyển'],
            ['candidate.saved-jobs.index', 'favorite', 'Việc đã lưu'],
        ],
        'employer' => [
            ['employer.dashboard', 'dashboard', 'Tổng quan'],
            ['employer.company.index', 'domain', 'Thông tin công ty'],
            ['employer.jobs.index', 'work', 'Tin tuyển dụng'],
        ],
        'admin' => [
            ['admin.dashboard', 'dashboard', 'Tổng quan'],
            ['admin.users.index', 'group', 'Người dùng'],
            ['admin.companies.index', 'domain', 'Công ty'],
            ['admin.jobs.index', 'work', 'Tin tuyển dụng'],
            ['admin.categories.index', 'category', 'Ngành nghề'],
        ],
    ];
    $links = $groups[$role] ?? [];
    $roleLabels = [
        'candidate' => 'Cổng ứng viên',
        'employer' => 'Cổng nhà tuyển dụng',
        'admin' => 'Cổng quản trị',
    ];
@endphp

<div class="dashboard-shell full-bleed">
    <aside class="side-panel">
        <div style="display:flex; gap:10px; align-items:center; margin-bottom:24px;">
            <span class="brand-mark"><span class="material-symbols-outlined">work</span></span>
            <div>
                <div class="side-title">TopCV Mini</div>
                <div class="muted small">{{ $roleLabels[$role] ?? 'Bảng điều khiển' }}</div>
            </div>
        </div>
        @if ($role === 'employer')
            <a class="button" style="width:100%; margin-bottom:16px;" href="{{ route('employer.jobs.create') }}"><span class="material-symbols-outlined">add</span>Đăng tin</a>
        @endif
        @foreach ($links as [$route, $icon, $label])
            <a class="side-link {{ request()->routeIs(str_replace('.index', '.*', $route)) || request()->routeIs($route) ? 'active' : '' }}" href="{{ route($route) }}">
                <span class="material-symbols-outlined">{{ $icon }}</span>{{ $label }}
            </a>
        @endforeach
    </aside>
    <section class="dashboard-content">
        @if ($title)
            <div class="page-head">
                <div>
                    <h1>{{ $title }}</h1>
                    @if ($subtitle)
                        <p class="muted">{{ $subtitle }}</p>
                    @endif
                </div>
                {{ $actions ?? '' }}
            </div>
        @endif
        {{ $slot }}
    </section>
</div>
