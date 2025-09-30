<?php

namespace App\Livewire;

use App\Models\Cart as CartModel;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Checkout extends Component
{
    public $cartItems = [];
    public $total = 0;

    // Billing Information
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

    // Shipping Information
    public $shipping = [
        'first_name' => '',
        'last_name' => '',
        'address' => '',
        'city' => '',
        'state' => '',
        'zip_code' => '',
        'country' => ''
    ];

    public $sameAsBilling = true;
    public $payment_method = '';
    public $accept_terms = false;

    // Credit Card Information
    public $card = [
        'number' => '',
        'expiry' => '',
        'cvv' => '',
        'name' => ''
    ];

    public $showSuccessModal = false;
    public $orderDetails = null;

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

        'shipping.first_name' => 'required_if:sameAsBilling,false|string|max:255',
        'shipping.last_name' => 'required_if:sameAsBilling,false|string|max:255',
        'shipping.address' => 'required_if:sameAsBilling,false|string|max:500',
        'shipping.city' => 'required_if:sameAsBilling,false|string|max:255',
        'shipping.state' => 'required_if:sameAsBilling,false|string|max:255',
        'shipping.zip_code' => 'required_if:sameAsBilling,false|string|max:10',
        'shipping.country' => 'required_if:sameAsBilling,false|string|max:2',

        'payment_method' => 'required|in:credit_card,paypal,bank_transfer',
        'accept_terms' => 'accepted',

        'card.number' => 'required_if:payment_method,credit_card|string|max:19',
        'card.expiry' => 'required_if:payment_method,credit_card|string|max:5',
        'card.cvv' => 'required_if:payment_method,credit_card|string|max:4',
        'card.name' => 'required_if:payment_method,credit_card|string|max:255',
    ];

    protected $messages = [
        'billing.first_name.required' => 'First name is required',
        'billing.last_name.required' => 'Last name is required',
        'billing.email.required' => 'Email is required',
        'billing.email.email' => 'Please enter a valid email address',
        'billing.phone.required' => 'Phone number is required',
        'billing.address.required' => 'Address is required',
        'billing.city.required' => 'City is required',
        'billing.state.required' => 'State/Province is required',
        'billing.zip_code.required' => 'ZIP/Postal code is required',
        'billing.country.required' => 'Country is required',

        'shipping.first_name.required_if' => 'Shipping first name is required',
        'shipping.last_name.required_if' => 'Shipping last name is required',
        'shipping.address.required_if' => 'Shipping address is required',
        'shipping.city.required_if' => 'Shipping city is required',
        'shipping.state.required_if' => 'Shipping state/province is required',
        'shipping.zip_code.required_if' => 'Shipping ZIP/postal code is required',
        'shipping.country.required_if' => 'Shipping country is required',

        'payment_method.required' => 'Please select a payment method',
        'payment_method.in' => 'Invalid payment method selected',
        'accept_terms.accepted' => 'You must accept the terms and conditions',

        'card.number.required_if' => 'Card number is required',
        'card.expiry.required_if' => 'Card expiry date is required',
        'card.cvv.required_if' => 'Card CVV is required',
        'card.name.required_if' => 'Cardholder name is required',
    ];

    public function mount()
    {
        if (!Auth::check()) {
            return redirect('/signin');
        }

        $this->loadCart();

        // Pre-fill billing information with user data if available
        if (Auth::user()) {
            $user = Auth::user();
            $this->billing['email'] = $user->email;
            $this->billing['first_name'] = $user->name ?? '';
        }
    }

    public function loadCart()
    {
        $this->cartItems = CartModel::with('product')
            ->where('user_id', Auth::id())
            ->get()
            ->toArray();

        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = collect($this->cartItems)->sum(function ($item) {
            return $item['quantity'] * $item['product']['price'];
        });
    }

    public function updatedSameAsBilling()
    {
        if ($this->sameAsBilling) {
            $this->shipping = [
                'first_name' => '',
                'last_name' => '',
                'address' => '',
                'city' => '',
                'state' => '',
                'zip_code' => '',
                'country' => ''
            ];
        }
    }

    public function placeOrder()
    {
        $this->validate();

        // Check if cart is empty
        if (empty($this->cartItems)) {
            session()->flash('error', 'Your cart is empty. Please add items before checkout.');
            return redirect()->route('cart');
        }

        DB::beginTransaction();
        try {
            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . time() . '-' . Auth::id(),
                'billing_first_name' => $this->billing['first_name'],
                'billing_last_name' => $this->billing['last_name'],
                'billing_email' => $this->billing['email'],
                'billing_phone' => $this->billing['phone'],
                'billing_address' => $this->billing['address'],
                'billing_city' => $this->billing['city'],
                'billing_state' => $this->billing['state'],
                'billing_zip_code' => $this->billing['zip_code'],
                'billing_country' => $this->billing['country'],
                'shipping_first_name' => $this->sameAsBilling ? $this->billing['first_name'] : $this->shipping['first_name'],
                'shipping_last_name' => $this->sameAsBilling ? $this->billing['last_name'] : $this->shipping['last_name'],
                'shipping_address' => $this->sameAsBilling ? $this->billing['address'] : $this->shipping['address'],
                'shipping_city' => $this->sameAsBilling ? $this->billing['city'] : $this->shipping['city'],
                'shipping_state' => $this->sameAsBilling ? $this->billing['state'] : $this->shipping['state'],
                'shipping_zip_code' => $this->sameAsBilling ? $this->billing['zip_code'] : $this->shipping['zip_code'],
                'shipping_country' => $this->sameAsBilling ? $this->billing['country'] : $this->shipping['country'],
                'payment_method' => $this->payment_method,
                'subtotal' => $this->total,
                'tax' => $this->total * 0.1,
                'shipping_cost' => 0,
                'total' => $this->total * 1.1,
                'status' => 'pending',
            ]);

            // Create order items
            foreach ($this->cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem['product']['id'],
                    'quantity' => $cartItem['quantity'],
                    'price' => $cartItem['product']['price'],
                    'total' => $cartItem['quantity'] * $cartItem['product']['price'],
                ]);

                // Update product stock
                $product = Product::find($cartItem['product']['id']);
                if ($product) {
                    $product->decrement('stock_quantity', $cartItem['quantity']);
                }
            }

            // Clear cart
            CartModel::where('user_id', Auth::id())->delete();

            DB::commit();

            $this->orderDetails = [
                'order_number' => $order->order_number,
                'total' => $order->total,
                'items_count' => $order->orderItems->count(),
            ];

            $this->showSuccessModal = true;

        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', 'Failed to place order. Please try again.');
            $this->addError('general', 'An error occurred while processing your order.');
        }
    }

    public function closeSuccessModal()
    {
        $this->showSuccessModal = false;
        $this->orderDetails = null;
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
