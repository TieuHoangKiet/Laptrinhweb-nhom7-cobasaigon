@props(['product'])

<div class="group relative bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden transition-shadow hover:shadow-lg">
    <a href="{{ route('products.show', $product) }}" class="block">
        <div class="w-full h-64 bg-gray-200 overflow-hidden">
              <img src="{{ $product->image ? asset('images/' . $product->image) : ($product->image_url ? asset('images/' . $product->image_url) : 'https://via.placeholder.com/300x400?text=Co+Ba+Sai+Gon') }}"
                  alt="{{ $product->name }}"
                  class="w-full h-full object-cover object-center transition-transform duration-300 group-hover:scale-105">
        </div>
    </a>
    <div class="p-4">
        @if($product->category)
            <p class="text-sm text-gray-500 mb-1">{{ $product->category->name }}</p>
        @endif
        
        <h3 class="text-md font-semibold text-gray-800 truncate">
            <a href="{{ route('products.show', $product) }}">
                {{ $product->name }}
            </a>
        </h3>
        
        <p class="text-lg font-bold text-red-600 mt-2">
            {{ number_format($product->price, 0, ',', '.') }} VND
        </p>
        
        <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="w-full btn-pink text-sm py-2">
                <i class="bi bi-cart-plus"></i> Thêm vào giỏ
            </button>
        </form>
    </div>
</div>