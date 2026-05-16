<x-app-layout>
    <x-dashboard-shell title="Sửa ngành nghề">
    <form class="card form" method="POST" action="{{ route('admin.categories.update', $category) }}">
        @csrf @method('PUT')
        @include('admin.categories.form', ['category' => $category])
    </form>
    </x-dashboard-shell>
</x-app-layout>
