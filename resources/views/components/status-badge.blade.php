@props(['status'])

@php
    $labels = [
        'active' => 'Đang hoạt động',
        'blocked' => 'Đã khóa',
        'pending' => 'Chờ xử lý',
        'viewed' => 'Đã xem',
        'interview' => 'Mời phỏng vấn',
        'accepted' => 'Phù hợp',
        'rejected' => 'Từ chối',
        'hidden' => 'Đã ẩn',
        'expired' => 'Hết hạn',
        'draft' => 'Bản nháp',
        'online' => 'CV online',
        'pdf' => 'CV PDF',
        'full-time' => 'Toàn thời gian',
        'part-time' => 'Bán thời gian',
        'remote' => 'Từ xa',
        'internship' => 'Thực tập',
        'candidate' => 'Ứng viên',
        'employer' => 'Nhà tuyển dụng',
        'admin' => 'Quản trị viên',
    ];
    $danger = in_array($status, ['blocked', 'rejected', 'expired'], true);
    $warn = in_array($status, ['pending', 'hidden', 'interview'], true);
@endphp

<span {{ $attributes->class(['badge', 'danger' => $danger, 'warn' => $warn, 'primary' => ! $danger && ! $warn]) }}>
    {{ $slot }}
    {{ $labels[$status] ?? $status }}
</span>
