<x-app-layout>
    <x-dashboard-shell title="{{ $cv->title }}">
    <div class="card">
        @if ($cv->type === 'pdf')
            <p><a class="button" href="{{ Storage::url($cv->file_path) }}" target="_blank">Xem CV PDF</a></p>
        @else
            <div class="detail-list">
                <div><strong>Họ tên</strong><span>{{ $cv->full_name }}</span></div>
                <div><strong>Email</strong><span>{{ $cv->email }}</span></div>
                <div><strong>Số điện thoại</strong><span>{{ $cv->phone }}</span></div>
                <div><strong>Địa chỉ</strong><span>{{ $cv->address }}</span></div>
                <div><strong>Mục tiêu</strong><span>{{ $cv->objective }}</span></div>
            </div>
            @foreach (['education' => 'Học vấn', 'experience' => 'Kinh nghiệm', 'skills' => 'Kỹ năng', 'projects' => 'Dự án'] as $field => $label)
                <h3>{{ $label }}</h3>
                <ul>
                    @foreach ($cv->{$field} ?? [] as $line)
                        <li>{{ $line }}</li>
                    @endforeach
                </ul>
            @endforeach
        @endif
    </div>
    </x-dashboard-shell>
</x-app-layout>
