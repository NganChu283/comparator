<x-app-layout>
    <x-dashboard-shell title="{{ $job->title }}">
    <div class="card">
        <p><a class="button" href="{{ route('employer.jobs.applications', $job) }}">Xem danh sách ứng viên</a></p>
        <p>{!! nl2br(e($job->description)) !!}</p>
    </div>
    </x-dashboard-shell>
</x-app-layout>
