<section>
    <div class="section-heading compact">
        <p class="eyebrow">Bảo mật</p>
        <h2>Đổi mật khẩu</h2>
        <p>Sử dụng mật khẩu đủ dài và khó đoán để bảo vệ tài khoản.</p>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="form-grid">
        @csrf
        @method('put')

        <div class="field">
            <label for="update_password_current_password">Mật khẩu hiện tại</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="form-error" />
        </div>

        <div class="field">
            <label for="update_password_password">Mật khẩu mới</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="form-error" />
        </div>

        <div class="field">
            <label for="update_password_password_confirmation">Xác nhận mật khẩu mới</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="form-error" />
        </div>

        <div class="form-actions">
            <button class="button" type="submit">
                <span class="material-symbols-outlined">lock_reset</span>
                Cập nhật mật khẩu
            </button>

            @if (session('status') === 'password-updated')
                <span class="success-text">Đã cập nhật mật khẩu.</span>
            @endif
        </div>
    </form>
</section>
