<?php

namespace App\Livewire;

use App\Models\Cart as CartModel;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Providers\MidtransServiceProvider;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\Snap;
use Midtrans\Config;

class Checkout extends Component
{
    public $cartItems = [];
    public $total = 0;
    public $snapToken;

    public $billing = [
        'first_name' => '',
        'last_name' => '',
        'email' => '',
        'phone' => '',
        'address' => '',
        'city' => '',
        'state' => '',
        'zip_code' => '',
        'country' => ''
    ];

    public $payment_method = '';
    public $accept_terms = false;
    public $showMidtransModal = false;

    public $card = [
        'number' => '',
        'expiry' => '',
        'cvv' => '',
        'name' => ''
    ];

    public $showSuccessModal = false;
    public $orderDetails = null;

    protected $listeners = ['paymentSuccess', 'paymentPending', 'paymentFailed', 'paymentClosed'];

    protected $rules = [
        'billing.first_name' => 'required|string|max:255',
        'billing.last_name' => 'required|string|max:255',
        'billing.email' => 'required|email|max:255',
        'billing.phone' => 'required|string|max:20',
        'billing.address' => 'required|string|max:500',
        'billing.city' => 'required|string|max:255',
        'billing.state' => 'required|string|max:255',
        'billing.zip_code' => 'required|string|max:10',
        'billing.country' => 'required|string|max:2',
        'payment_method' => 'required|in:credit_card,paypal,bank_transfer,midtrans',
        'accept_terms' => 'accepted',
    ];

    public function mount()
    {
        if (!Auth::check()) {
            return redirect('/signin');
        }

        $this->loadCart();

        if (Auth::user()) {
            $user = Auth::user();
            $this->billing['email'] = $user->email;
            $this->billing['first_name'] = $user->name ?? '';
        }
    }

    public function loadCart()
    {
        $selected = session('selected_cart_items', []);
        $query = CartModel::with('product')->whereHas('product')->where('user_id', Auth::id());
        if (!empty($selected))
            $query->whereIn('id', $selected);
        $this->cartItems = $query->get()->toArray();
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = collect($this->cartItems)->sum(fn($item) => $item['quantity'] * $item['product']['price']);
    }



    public function placeOrder()
    {
        $this->validate();

        if (empty($this->cartItems)) {
            session()->flash('error', 'Your cart is empty.');
            return redirect()->route('cart');
        }

        if ($this->payment_method === 'midtrans') {
            try {
                // Set curl options for longer timeouts
                Config::$curlOptions = [
                    CURLOPT_TIMEOUT => 60,
                    CURLOPT_CONNECTTIMEOUT => 10,
                ];

                $orderId = 'ORD-' . time() . '-' . Auth::id();

                $itemTotal = collect($this->cartItems)->sum(fn($item) => $item['quantity'] * $item['product']['price']);

                Log::info('Initiating Midtrans payment', [
                    'order_id' => $orderId,
                    'user_id' => Auth::id(),
                    'total' => $this->total,
                ]);

                $midtrans = new MidtransServiceProvider();
                $this->snapToken = $midtrans->createTransaction($orderId, $itemTotal);

                $this->dispatch('openMidtransModal', ['snapToken' => $this->snapToken]);

            } catch (\Exception $e) {
                Log::error('Midtrans payment initiation failed', [
                    'error' => $e->getMessage(),
                    'user_id' => Auth::id(),
                ]);
                $this->addError('payment', 'Payment gateway error: ' . $e->getMessage());
                return;
            }
        }

        $this->createOrder('pending');
    }

    public function paymentSuccess($result)
    {
        $this->createOrder('paid', $result);
    }

    public function paymentPending($result)
    {
        $this->createOrder('pending', $result);
    }

    public function paymentFailed($result)
    {
        $this->createOrder('failed', $result);
    }

    public function paymentClosed()
    {
        $this->showMidtransModal = false;
    }

    protected function createOrder($status, $midtransResult = null)
    {
        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => $midtransResult['order_id'] ?? ('ORD-' . time() . '-' . Auth::id()),
                'billing_first_name' => $this->billing['first_name'],
                'billing_last_name' => $this->billing['last_name'],
                'billing_email' => $this->billing['email'],
                'billing_phone' => $this->billing['phone'],
                'billing_address' => $this->billing['address'],
                'billing_city' => $this->billing['city'],
                'billing_state' => $this->billing['state'],
                'billing_zip_code' => $this->billing['zip_code'],
                'billing_country' => $this->billing['country'],
                'payment_method' => $this->payment_method,
                'subtotal' => $this->total,
                'tax' => $this->total * 0.1,
                'total' => $this->total * 1.1,
                'status' => $status,
            ]);

            foreach ($this->cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['product']['price'],
                    'total' => $item['quantity'] * $item['product']['price'],
                ]);

                Product::find($item['product']['id'])?->decrement('stock_quantity', $item['quantity']);
            }

            CartModel::where('user_id', Auth::id())->delete();
            session()->forget('selected_cart_items');

            DB::commit();

            $this->orderDetails = [
                'order_number' => $order->order_number,
                'total' => $order->total,
                'items_count' => $order->orderItems->count(),
            ];

            $this->showSuccessModal = true;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('general', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function closeSuccessModal()
    {
        $this->showSuccessModal = false;
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.checkout', [
            'cartItems' => $this->cartItems,
            'total' => $this->total
        ]);
    }
}
