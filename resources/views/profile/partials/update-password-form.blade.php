<section>
    <header>
        <h2 class="h4 fw-semibold">
            {{ __('Cập nhật Mật khẩu') }}
        </h2>
        <p class="text-muted">
            {{ __('Đảm bảo tài khoản của bạn sử dụng mật khẩu dài, ngẫu nhiên để giữ an toàn.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="current_password" class="form-label fw-semibold">{{ __('Mật khẩu hiện tại') }}</label>
            <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">{{ __('Mật khẩu mới') }}</label>
            <input id="password" name="password" type="password" class="form-control" autocomplete="new-password">
            @error('password', 'updatePassword')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label fw-semibold">{{ __('Xác nhận Mật khẩu mới') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="btn btn-primary">{{ __('Lưu') }}</button>

            @if (session('status') === 'password-updated')
                <span class="text-success">{{ __('Đã lưu.') }}</span>
            @endif
        </div>
    </form>
</section>