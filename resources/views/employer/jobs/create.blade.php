<x-app-layout>
    <x-dashboard-shell title="Đăng tin tuyển dụng">
    <form class="card form" method="POST" action="{{ route('employer.jobs.store') }}">
        @csrf
        @include('employer.jobs._form')
    </form>
    </x-dashboard-shell>
</x-app-layout>
