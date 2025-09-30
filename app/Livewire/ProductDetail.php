<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Cart as CartModel;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProductDetail extends Component
{
    public $product;
    public $quantity = 1;
    public $relatedProducts = [];
    public $selectedCategory = null;
    public $sortBy = 'random';
    public $categories = [];

    public function mount($productId)
    {
        $this->product = Product::findOrFail($productId);
        $this->categories = Product::distinct('category')->pluck('category')->toArray();
        $this->loadRelatedProducts();
    }

    public function loadRelatedProducts()
    {
        $query = Product::where('is_active', true)
            ->where('id', '!=', $this->product->id);

        if ($this->selectedCategory && $this->selectedCategory !== 'all') {
            $query->where('category', $this->selectedCategory);
        } else {
            $query->where('category', $this->product->category);
        }

        if ($this->sortBy === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($this->sortBy === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->inRandomOrder();
        }

        $this->relatedProducts = $query->limit(8)->get();
    }

    public function incrementQuantity()
    {
        $this->quantity++;
    }

    public function setFilter($category)
    {
        $this->selectedCategory = $category;
        $this->loadRelatedProducts();
    }

    public function setSort($sortBy)
    {
        $this->sortBy = $sortBy;
        $this->loadRelatedProducts();
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

   public function addToCart()
{
    if (!Auth::check()) {
        session()->flash('error', 'Please login to add items to cart.');
        return;
    }

    try {
        $cartItem = CartModel::where('user_id', Auth::id())
            ->where('product_id', $this->product->id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $this->quantity);
        } else {
            CartModel::create([
                'user_id' => Auth::id(),
                'product_id' => $this->product->id,
                'quantity' => $this->quantity,
                'price' => $this->product->price,
            ]);
        }

        // sementara jangan dispatch dulu
        // $this->dispatch('cartUpdated');
        // $this->dispatch('refreshCart');

        session()->flash('message', 'Product added to cart successfully!');
        $this->quantity = 1;
    } catch (\Exception $e) {
        session()->flash('error', 'Failed to add product to cart. Please try again.');
    }
}


    public function addToWishlist()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Please login to add items to wishlist.');
            return;
        }

        // Add to wishlist logic here
        session()->flash('message', 'Product added to wishlist!');
    }

    public function render()
    {
        return view('livewire.product-detail', [
            'product' => $this->product,
            'relatedProducts' => $this->relatedProducts
        ]);
    }
}
