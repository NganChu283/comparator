<x-app-layout>
    <x-dashboard-shell title="Hồ sơ tài khoản" subtitle="Cập nhật thông tin cá nhân, email đăng nhập và mật khẩu bảo mật.">
        <div class="section-grid two">
            <div class="card">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="card">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="card danger-zone">
            @include('profile.partials.delete-user-form')
        </div>
    </x-dashboard-shell>
</x-app-layout>
