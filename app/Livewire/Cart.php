<?php

namespace App\Livewire;

use App\Models\Cart as CartModel;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Cart extends Component
{
    public $cartItems = [];
    public $total = 0;

    public function mount()
    {
        if (!Auth::check()) {
            return redirect('/signin');
        }

        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cartItems = CartModel::with('product')
            ->where('user_id', Auth::id())
            ->get()
            ->toArray(); // Convert to array to avoid type issues

        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = collect($this->cartItems)->sum(function ($item) {
            return $item['quantity'] * $item['product']['price'];
        });
    }

    public function updateQuantity($cartItemId, $quantity)
    {
        if ($quantity < 1) {
            $this->removeItem($cartItemId);
            return;
        }

        $cartItem = CartModel::find($cartItemId);
        if ($cartItem && $cartItem->user_id === Auth::id()) {
            $cartItem->update(['quantity' => $quantity]);
            $this->loadCart();
        }
    }

    public function removeItem($cartItemId)
    {
        $cartItem = CartModel::find($cartItemId);
        if ($cartItem && $cartItem->user_id === Auth::id()) {
            $cartItem->delete();
            $this->loadCart();
            session()->flash('message', 'Item removed from cart successfully!');
        }
    }

    public function clearCart()
    {
        CartModel::where('user_id', Auth::id())->delete();
        $this->loadCart();
        session()->flash('message', 'Cart cleared successfully!');
    }

    public function render()
    {
        return view('livewire.cart', [
            'cartItems' => $this->cartItems,
            'total' => $this->total
        ]);
    }
}
