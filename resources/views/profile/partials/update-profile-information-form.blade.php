<section>
    <header>
        <h2 class="h4 fw-semibold">
            {{ __('Thông tin Hồ sơ') }}
        </h2>
        <p class="text-muted">
            {{ __("Cập nhật thông tin hồ sơ và ảnh đại diện của bạn.") }}
        </p>
    </header>

    {{-- PHẢI CÓ: enctype="multipart/form-data" ĐỂ TẢI ẢNH --}}
    <form method="post" action="{{ route('profile.update') }}" class="mt-4" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="avatar" class="form-label fw-semibold">{{ __('Ảnh đại diện') }}</label>
            <div class="d-flex align-items-center">
                <img 
                    src="{{ $user->avatar ? Storage::url($user->avatar) : 'https://via.placeholder.com/150/e9ecef/6c757d?text=Avatar' }}" 
                    alt="Avatar" 
                    class="rounded-circle me-3" 
                    width="80" height="80"
                    style="object-fit: cover;">
                
                <input id="avatar" name="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror">
            </div>
            @error('avatar')
                <div class="invalid-feedback mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">{{ __('Tên') }}</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ $user->email }}" disabled readonly>
            <div class="form-text">
                {{ __('Email không thể thay đổi.') }}
            </div>
            
            {{-- ===== TOÀN BỘ PHẦN GÂY LỖI ĐÃ BỊ XÓA ===== --}}
            {{-- (Đã xóa logic @if ($user instanceof ...) và button 'send-verification') --}}
            
        </div>

        <div class="d-flex align-items-center gap-4">
            <button type="submit" class="btn btn-primary">{{ __('Lưu') }}</button>

            @if (session('status') === 'profile-updated')
                <span class="text-success">{{ __('Đã lưu.') }}</span>
            @endif
        </div>
    </form>
    
    {{-- ===== FORM ẨN GÂY LỖI ĐÃ BỊ XÓA ===== --}}
    {{-- (Đã xóa form id="send-verification") --}}
</section>