<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class OrderTracking extends Component
{
    public $orders = [];
    public $selectedOrder = null;

    public function mount()
    {
        if (!Auth::check()) {
            return redirect('/signin');
        }

        $this->loadOrders();
    }

    public function loadOrders()
    {
        $this->orders = Order::with(['orderItems.product'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get()
            ->toArray();
    }

    public function viewOrder($orderId)
    {
        $this->selectedOrder = Order::with(['orderItems.product'])
            ->where('id', $orderId)
            ->where('user_id', Auth::id())
            ->first()
            ->toArray();
    }

    public function closeOrderDetails()
    {
        $this->selectedOrder = null;
    }

    public function getStatusColor($status)
    {
        return match($status) {
            'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300',
            'processing' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300',
            'shipped' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300',
            'delivered' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300',
            'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
            default => 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-300',
        };
    }

    public function render()
    {
        return view('livewire.order-tracking');
    }
}
