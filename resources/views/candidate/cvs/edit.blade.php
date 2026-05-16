<x-app-layout>
    <x-dashboard-shell title="Sửa CV">
    <form class="card form" method="POST" action="{{ route('candidate.cvs.update', $cv) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('candidate.cvs._form', ['cv' => $cv])
    </form>
    </x-dashboard-shell>
</x-app-layout>
