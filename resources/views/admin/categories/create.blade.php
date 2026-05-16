<x-app-layout>
    <x-dashboard-shell title="Thêm ngành nghề">
    <form class="card form" method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        @include('admin.categories.form')
    </form>
    </x-dashboard-shell>
</x-app-layout>
