<section>
    <header>
        <h2 class="h4 fw-semibold text-danger">
            {{ __('Xóa Tài khoản') }}
        </h2>
        <p class="text-muted">
            {{ __('Một khi tài khoản của bạn bị xóa, tất cả tài nguyên và dữ liệu của nó sẽ bị xóa vĩnh viễn. Vui lòng cân nhắc kỹ.') }}
        </p>
    </header>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        {{ __('Xóa Tài khoản') }}
    </button>

    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">{{ __('Bạn có chắc chắn muốn xóa tài khoản?') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted">
                            {{ __('Một khi tài khoản của bạn bị xóa, tất cả tài nguyên và dữ liệu của nó sẽ bị xóa vĩnh viễn. Vui lòng nhập mật khẩu của bạn để xác nhận bạn muốn xóa vĩnh viễn tài khoản của mình.') }}
                        </p>

                        <div class="mb-3">
                            <label for="password_delete" class="form-label fw-semibold">{{ __('Mật khẩu') }}</label>
                            <input 
                                id="password_delete" 
                                name="password" 
                                type="password" 
                                class="form-control" 
                                placeholder="{{ __('Mật khẩu') }}"
                                autocomplete="current-password">
                            @error('password', 'deleteUser')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Hủy bỏ') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('Xóa Tài khoản') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

{{-- Kích hoạt modal nếu có lỗi (để người dùng thấy lỗi) --}}
@if($errors->userDeletion->isNotEmpty())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('confirmUserDeletionModal'));
            myModal.show();
        });
    </script>
@endif