<?php
// App/Services/CartService.php

namespace App\Services;

use App\Models\Product; // Import Model Product
use Illuminate\Support\Facades\Session;

class CartService
{
    protected $cartKey = 'cart';

    public function __construct()
    {
        // Khởi tạo giỏ hàng trong session nếu chưa có
        if (!Session::has($this->cartKey)) {
            Session::put($this->cartKey, []);
        }
    }

    public function add($productId, $quantity = 1)
    {
        $cart = Session::get($this->cartKey);
        $product = Product::find($productId);

        if (!$product) {
            // Sản phẩm không tồn tại
            return false;
        }

        if ($quantity <= 0) {
            // Số lượng không hợp lệ
            return false;
        }

        // SỬA LỖI: Dùng 'stock'
        if ($quantity > $product->stock) {
            // Số lượng yêu cầu vượt quá tồn kho
            return false;
        }

        $productId = (string) $productId; // Đảm bảo key là string

        if (isset($cart[$productId])) {
            $newQuantity = $cart[$productId]['quantity'] + $quantity;
            // Kiểm tra lại tồn kho khi cộng dồn
            // SỬA LỖI: Dùng 'stock'
            if ($newQuantity > $product->stock) {
                return false;
            }
            $cart[$productId]['quantity'] = $newQuantity;
        } else {
            $cart[$productId] = [
                'product_id' => $product->id, // Thêm product_id để dễ dàng update/remove
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                // SỬA LỖI: Dùng 'image_url'
                'image_url' => $product->image_url, 
                // SỬA LỖI: Dùng 'stock'
                'stock' => $product->stock, 
            ];
        }

        Session::put($this->cartKey, $cart);
        return true;
    }

    public function update($productId, $quantity)
    {
        $cart = Session::get($this->cartKey);
        $productId = (string) $productId;

        if (isset($cart[$productId])) {
            $product = Product::find($productId);
            if ($product) {
                if ($quantity <= 0) {
                    // Nếu số lượng <= 0, xóa sản phẩm khỏi giỏ
                    $this->remove($productId);
                    return true;
                }

                // SỬA LỖI: Dùng 'stock'
                if ($quantity > $product->stock) {
                    // Không thể cập nhật nếu vượt quá tồn kho
                    return false;
                }

                $cart[$productId]['quantity'] = $quantity;
                Session::put($this->cartKey, $cart); 
                return true;
            }
        }
        return false; // Không tìm thấy sản phẩm hoặc sản phẩm không tồn tại
    }

    public function remove($productId)
    {
        $cart = Session::get($this->cartKey);
        $productId = (string) $productId;

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put($this->cartKey, $cart);
        }
    }

    public function getItems()
    {
        // Đảm bảo trả về mảng, ngay cả khi session không có gì
        return Session::get($this->cartKey, []);
    }

    public function getTotalQuantity()
    {
        $items = $this->getItems();
        return array_sum(array_column($items, 'quantity'));
    }

    public function getTotalPrice()
    {
        $items = $this->getItems();
        $total = 0;
        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    // <-- NOZOMI ĐÃ XÓA CHỮ "S" BỊ LẠC Ở ĐÂY -->

    public function clear()
    {
        Session::forget($this->cartKey);
    }
    
    public function getCount(): int
    {
        // SỬA LỖI CHÍNH: Dùng getItems()
        $cart = $this->getItems(); 
        return count($cart);
    }
}