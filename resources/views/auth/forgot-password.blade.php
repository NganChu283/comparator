<x-guest-layout>
    <h2>Quên mật khẩu</h2>
    <p class="muted">Nhập email tài khoản, hệ thống sẽ gửi liên kết đặt lại mật khẩu.</p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                Gửi liên kết đặt lại mật khẩu
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
