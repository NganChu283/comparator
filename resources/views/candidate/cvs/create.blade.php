<x-app-layout>
    <x-dashboard-shell title="Tạo CV">
    <form class="card form" method="POST" action="{{ route('candidate.cvs.store') }}" enctype="multipart/form-data">
        @csrf
        @include('candidate.cvs._form')
    </form>
    </x-dashboard-shell>
</x-app-layout>
