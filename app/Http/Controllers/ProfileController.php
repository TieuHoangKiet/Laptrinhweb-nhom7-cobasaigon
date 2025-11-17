<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    // Lấy dữ liệu đã validate (chỉ có 'name' và 'avatar')
    $validatedData = $request->validated();
    
    // Cập nhật tên
    $request->user()->fill(['name' => $validatedData['name']]);

    // BỎ CẬP NHẬT EMAIL (Theo yêu cầu)
    // if ($request->user()->isDirty('email')) {
    //     $request->user()->email_verified_at = null;
    // }

    // XỬ LÝ AVATAR (Logic mới)
    if ($request->hasFile('avatar')) {
        // 1. Xóa ảnh cũ (nếu có)
        if ($request->user()->avatar) {
            Storage::disk('public')->delete($request->user()->avatar);
        }
        
        // 2. Lưu ảnh mới vào thư mục 'storage/app/public/avatars'
        $path = $request->file('avatar')->store('avatars', 'public');
        
        // 3. Cập nhật đường dẫn vào database
        $request->user()->avatar = $path;
    }

    // Lưu tất cả thay đổi (name và avatar)
    $request->user()->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
