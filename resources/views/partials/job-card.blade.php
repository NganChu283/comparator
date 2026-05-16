<div class="card job-card">
    <div class="job-card-head">
        <div class="logo-box">
            <span class="material-symbols-outlined">domain</span>
        </div>
        <span class="badge primary"><span class="material-symbols-outlined" style="font-size:14px;">bolt</span>Mới</span>
    </div>
    <div>
        <a class="job-title" href="{{ route('jobs.show', $job) }}">{{ $job->title }}</a>
        <div class="job-meta" style="margin-top:6px;">
            <span class="material-symbols-outlined" style="font-size:16px;">business</span>
            <span>{{ $job->company->name }}</span>
        </div>
    </div>
    <div class="actions">
        <span class="badge">{{ $job->category->name }}</span>
        <x-status-badge :status="$job->working_type"><span class="material-symbols-outlined" style="font-size:14px;">schedule</span></x-status-badge>
        <span class="badge"><span class="material-symbols-outlined" style="font-size:14px;">location_on</span>{{ $job->location }}</span>
    </div>
    <div class="job-footer">
        <strong>
            @if ($job->salary_min || $job->salary_max)
                {{ number_format($job->salary_min ?? 0) }} - {{ number_format($job->salary_max ?? 0) }} VND
            @else
                Thương lượng
            @endif
        </strong>
        <span class="muted small">Hạn {{ $job->deadline->format('d/m/Y') }}</span>
    </div>
</div>
