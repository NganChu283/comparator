<x-app-layout>
    <x-dashboard-shell title="Việc làm đã lưu" subtitle="Danh sách công việc bạn quan tâm để ứng tuyển sau.">
    <div class="grid grid-2">
        @foreach ($savedJobs as $saved)
            @include('partials.job-card', ['job' => $saved->job])
        @endforeach
    </div>
    <div class="pagination">{{ $savedJobs->links() }}</div>
    </x-dashboard-shell>
</x-app-layout>
