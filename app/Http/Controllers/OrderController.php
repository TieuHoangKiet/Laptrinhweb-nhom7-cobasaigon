<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- THÊM DÒNG NÀY

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách đơn hàng (cho cả admin và user).
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            // ADMIN: Lấy TẤT CẢ đơn hàng, mới nhất lên trên
            $orders = Order::with('user')->latest()->paginate(15);
            // Trả về view admin
            return view('admin.orders.index', compact('orders'));
        } else {
            // USER: Chỉ lấy đơn hàng của mình
            $orders = Auth::user()->orders()->with('items.product')->latest()->paginate(10);
            // Trả về view user
            return view('orders.index', compact('orders'));
        }
    }

    /**
     * Hiển thị chi tiết đơn hàng (cho cả admin và user).
     */
    public function show(Order $order)
    {
        // Kiểm tra bảo mật: Admin được xem mọi đơn, user chỉ được xem đơn của mình
        if (Auth::user()->role !== 'admin' && $order->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền xem đơn hàng này.');
        }

        // Tải thông tin chi tiết
        $order->load('items.product', 'user');

        if (Auth::user()->role === 'admin') {
            // Trả về view admin
            return view('admin.orders.show', compact('order'));
        } else {
            // Trả về view user
            return view('orders.show', compact('order'));
        }
    }
    
    // ... (Các hàm resource khác như create, store, edit, update, destroy
    // ... mà admin CÓ THỂ sẽ dùng. Bạn có thể thêm sau nếu cần)

    /**
     * Show the form for editing the specified resource.
     * (Chúng ta sẽ dùng hàm này để Admin "Xác nhận" đơn hàng)
     */
    public function edit(Order $order)
    {
        // Chỉ admin mới được edit
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
        
        // Tạm thời chỉ trả về view, logic update sẽ làm sau
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     * (Đây là nơi Admin thay đổi status từ 'pending' -> 'processing')
     */
    public function update(Request $request, Order $order)
    {
        // Chỉ admin mới được update
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'status' => 'required|string|in:pending,processing,shipped,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('admin.orders.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
    }
}