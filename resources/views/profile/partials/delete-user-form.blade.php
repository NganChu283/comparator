<section>
    <div class="section-heading compact">
        <p class="eyebrow">Vùng nguy hiểm</p>
        <h2>Xóa tài khoản</h2>
        <p>Khi tài khoản bị xóa, toàn bộ dữ liệu liên quan sẽ bị xóa vĩnh viễn. Hãy nhập mật khẩu để xác nhận thao tác này.</p>
    </div>

    <form method="post" action="{{ route('profile.destroy') }}" class="form-grid">
        @csrf
        @method('delete')

        <div class="field">
            <label for="delete_user_password">Mật khẩu xác nhận</label>
            <input id="delete_user_password" name="password" type="password" autocomplete="current-password" placeholder="Nhập mật khẩu hiện tại">
            <x-input-error :messages="$errors->userDeletion->get('password')" class="form-error" />
        </div>

        <div class="form-actions">
            <button class="button danger" type="submit">
                <span class="material-symbols-outlined">delete</span>
                Xóa tài khoản
            </button>
        </div>
    </form>
</section>
