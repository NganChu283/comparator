<x-guest-layout>
    <h2>Xác thực email</h2>
    <p class="muted">Vui lòng kiểm tra email và bấm liên kết xác thực tài khoản. Nếu chưa nhận được, bạn có thể gửi lại email xác thực.</p>

    @if (session('status') == 'verification-link-sent')
        <div class="notice">
            Email xác thực mới đã được gửi đến địa chỉ email của bạn.
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    Gửi lại email xác thực
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Đăng xuất
            </button>
        </form>
    </div>
</x-guest-layout>
