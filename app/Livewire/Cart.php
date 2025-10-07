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
    public $selectedItems = [];
    public $selectAll = false;

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

        // Default to none selected if none selected
        if (empty($this->selectedItems)) {
            $this->selectedItems = [];
            $this->selectAll = false;
        } else {
            // Remove selected items that are no longer in cart
            $currentIds = collect($this->cartItems)->pluck('id')->toArray();
            $this->selectedItems = array_intersect($this->selectedItems, $currentIds);
            $this->selectAll = count($this->selectedItems) === count($this->cartItems);
        }

        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = collect($this->cartItems)->whereIn('id', $this->selectedItems)->sum(function ($item) {
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

    public function toggleSelectAll()
    {
        if ($this->selectAll) {
            $this->selectedItems = collect($this->cartItems)->pluck('id')->toArray();
        } else {
            $this->selectedItems = [];
        }
        $this->calculateTotal();
    }

    public function updatedSelectedItems()
    {
        $this->selectAll = count($this->selectedItems) === count($this->cartItems);
        $this->calculateTotal();
    }

    public function proceedToCheckout()
    {
        if (empty($this->selectedItems)) {
            session()->flash('error', 'Please select at least one item to checkout.');
            return;
        }

        session(['selected_cart_items' => $this->selectedItems]);
        return redirect()->route('checkout');
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
