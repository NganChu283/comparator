<x-app-layout>
    <x-dashboard-shell title="Sửa tin tuyển dụng">
    <form class="card form" method="POST" action="{{ route('employer.jobs.update', $job) }}">
        @csrf @method('PUT')
        @include('employer.jobs._form', ['job' => $job])
    </form>
    </x-dashboard-shell>
</x-app-layout>
