<section>
    <div class="section-heading compact">
        <p class="eyebrow">Tài khoản</p>
        <h2>Thông tin cá nhân</h2>
        <p>Cập nhật họ tên và email dùng để đăng nhập CareerLink.</p>
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="form-grid">
        @csrf
        @method('patch')

        <div class="field">
            <label for="name">Họ và tên</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            <x-input-error :messages="$errors->get('name')" class="form-error" />
        </div>

        <div class="field">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="form-error" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert warning">
                    <span>Email của bạn chưa được xác thực.</span>
                    <button form="send-verification" class="link-button" type="submit">Gửi lại email xác thực</button>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <p class="success-text">Email xác thực mới đã được gửi.</p>
                @endif
            @endif
        </div>

        <div class="form-actions">
            <button class="button" type="submit">
                <span class="material-symbols-outlined">save</span>
                Lưu thay đổi
            </button>

            @if (session('status') === 'profile-updated')
                <span class="success-text">Đã lưu thông tin.</span>
            @endif
        </div>
    </form>
</section>
