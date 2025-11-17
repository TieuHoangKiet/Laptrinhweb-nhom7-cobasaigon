<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use App\Models\Product; // Đảm bảo đã use Model
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Đảm bảo đã use DB

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cartItems = $this->cartService->getItems();
        $totalPrice = $this->cartService->getTotalPrice();
        return view('cart.index', compact('cartItems', 'totalPrice'));
    }

    public function add(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1); // Lấy số lượng từ form, mặc định là 1

        $success = $this->cartService->add($product->id, $quantity);

        if (!$success) {
            return redirect()->back()->with('error', 'Không đủ hàng tồn kho cho sản phẩm này.');
        }

        return redirect()->route('cart.index')->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    public function update(Request $request, $productId)
    {
        $quantity = $request->input('quantity');

        $success = $this->cartService->update($productId, $quantity);

        if (!$success) {
            return redirect()->route('cart.index')->with('error', 'Không đủ hàng tồn kho để cập nhật số lượng.');
        }

        return redirect()->route('cart.index')->with('success', 'Đã cập nhật giỏ hàng.');
    }

    public function remove($productId)
    {
        $this->cartService->remove($productId);
        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    // HÀM BỊ LỖI LÀ HÀM NÀY
    public function checkout()
    {
        $cartItems = $this->cartService->getItems();
        $totalPrice = $this->cartService->getTotalPrice();

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        // Kiểm tra tồn kho cho toàn bộ giỏ hàng trước khi thanh toán
        foreach ($cartItems as $item) {
            // SỬA LỖI 1: Dùng 'product_id' thay vì 'id'
            $product = Product::find($item['product_id']); 
            
            // SỬA LỖI 2: Dùng 'stock' thay vì 'stock_quantity'
            if (!$product || $item['quantity'] > $product->stock) { 
                return redirect()->route('cart.index')->with('error', 'Sản phẩm "' . $item['name'] . '" không đủ số lượng. Vui lòng kiểm tra lại.');
            }
        }

        return view('cart.checkout', compact('cartItems', 'totalPrice'));
    }

    // HÀM NÀY CŨNG CÓ LỖI TƯƠNG TỰ, SỬA LUÔN
    public function processCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $cartItems = $this->cartService->getItems();

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $totalPrice = $this->cartService->getTotalPrice();

        // Bắt đầu transaction
        DB::beginTransaction();
        try {
            // 1. Tạo đơn hàng (Order)
            $order = Order::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'notes' => $request->notes,
                'total_price' => $totalPrice,
                'status' => 'pending', // Trạng thái chờ admin xác nhận
            ]);

            // 2. Tạo các mục đơn hàng (Order Items)
            foreach ($cartItems as $item) {
                // SỬA LỖI 1: Dùng 'product_id' thay vì 'id'
                $product = Product::find($item['product_id']); 
                
                // SỬA LỖI 2: Dùng 'stock' thay vì 'stock_quantity'
                if (!$product || $item['quantity'] > $product->stock) {
                    throw new \Exception('Sản phẩm ' . $item['name'] . ' không đủ hàng.');
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                // 3. Trừ tồn kho
                // SỬA LỖI 3: Dùng 'stock' thay vì 'stock_quantity'
                $product->stock -= $item['quantity'];
                $product->save();
            }

            // 4. Commit transaction
            DB::commit();

            // 5. Xóa giỏ hàng
            $this->cartService->clear();

            // 6. Chuyển hướng đến trang thành công
            return redirect()->route('cart.success', $order); // Gửi $order sang

        } catch (\Exception $e) {
            // 7. Rollback nếu có lỗi
            DB::rollBack();
            return redirect()->route('cart.checkout')->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
        }
    }

    // Hàm này dùng cho route 'cart.success'
    public function success(Order $order)
    {
        // Kiểm tra xem đúng là người dùng này sở hữu đơn hàng không
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('home');
        }
        return view('cart.success', compact('order'));
    }
}