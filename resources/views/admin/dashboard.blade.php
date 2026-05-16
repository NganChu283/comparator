<x-app-layout>
    <x-dashboard-shell title="Bảng điều khiển quản trị" subtitle="Tổng quan dữ liệu nền tảng CareerLink.">
    <div class="stats">
        <div class="stat-card"><strong>{{ $userCount }}</strong><span>Người dùng</span></div>
        <div class="stat-card"><strong>{{ $companyCount }}</strong><span>Công ty</span></div>
        <div class="stat-card"><strong>{{ $jobCount }}</strong><span>Tin tuyển dụng</span></div>
        <div class="stat-card"><strong>{{ $applicationCount }}</strong><span>Hồ sơ ứng tuyển</span></div>
    </div>
    </x-dashboard-shell>
</x-app-layout>
