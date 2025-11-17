<?php

namespace App\View\Components;

use App\Models\Product; // Đảm bảo import Model Product
use Illuminate\View\Component;

class ProductCard extends Component
{
    /**
     * The product instance.
     *
     * @var \App\Models\Product
     */
    public $product;

    /**
     * Create the component instance.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product-card');
    }
}