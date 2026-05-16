<x-guest-layout>
    <h2>Xác nhận mật khẩu</h2>
    <p class="muted">Vui lòng xác nhận mật khẩu trước khi tiếp tục.</p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Mật khẩu" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                Xác nhận
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
