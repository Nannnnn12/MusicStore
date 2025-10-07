<div>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V17a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-6.586a1 1 0 0 0-.293-.707Z" />
                            </svg>
                            Home
                        </a>
                    </li>
                    <li class="inline-flex items-center">
                        <a href="{{ route('cart') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-white">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            Shopping Cart
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span
                                class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Checkout</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Success/Error Messages -->
            @if (session()->has('message'))
                <div
                    class="mb-6 bg-green-100 dark:bg-green-900/30 border border-green-400 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg">
                    {{ session('message') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div
                    class="mb-6 bg-red-100 dark:bg-red-900/30 border border-red-400 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            @if (count($cartItems) > 0)
                <form wire:submit.prevent="placeOrder" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Customer Information & Payment -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Billing Information -->
                        <div
                            class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">
                            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Billing Information</h2>
                            </div>

                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                            First Name *
                                        </label>
                                        <input type="text" wire:model="billing.first_name" required
                                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all duration-300">
                                        @error('billing.first_name')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                            Last Name *
                                        </label>
                                        <input type="text" wire:model="billing.last_name" required
                                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all duration-300">
                                        @error('billing.last_name')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Email Address *
                                    </label>
                                    <input type="email" wire:model="billing.email" required
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all duration-300">
                                    @error('billing.email')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Phone Number *
                                    </label>
                                    <input type="tel" wire:model="billing.phone" required
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all duration-300">
                                    @error('billing.phone')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Address *
                                    </label>
                                    <textarea wire:model="billing.address" rows="3" required
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all duration-300"></textarea>
                                    @error('billing.address')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                            City *
                                        </label>
                                        <input type="text" wire:model="billing.city" required
                                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all duration-300">
                                        @error('billing.city')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                            State/Province *
                                        </label>
                                        <input type="text" wire:model="billing.state" required
                                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all duration-300">
                                        @error('billing.state')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                            ZIP/Postal Code *
                                        </label>
                                        <input type="text" wire:model="billing.zip_code" required
                                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all duration-300">
                                        @error('billing.zip_code')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Country *
                                    </label>
                                    <select wire:model="billing.country" required
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all duration-300">
                                        <option value="">Select Country</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="US">United States</option>
                                        <option value="GB">United Kingdom</option>
                                        <option value="CA">Canada</option>
                                        <option value="AU">Australia</option>
                                    </select>
                                    @error('billing.country')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>



                        <!-- Payment Method -->
                        <div
                            class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">
                            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Payment Method</h2>
                            </div>

                            <div class="p-6 space-y-4">
                                <div class="space-y-3">
                                    <label
                                        class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl cursor-pointer hover:border-indigo-500 dark:hover:border-indigo-400 transition-colors">
                                        <input type="radio" wire:model="payment_method" value="credit_card"
                                            class="text-indigo-600 focus:ring-indigo-500">
                                        <div class="ml-4 flex items-center">
                                            <div class="text-2xl mr-3">💳</div>
                                            <div>
                                                <div class="font-semibold text-gray-900 dark:text-white">Credit/Debit
                                                    Card</div>
                                                <div class="text-sm text-gray-600 dark:text-gray-300">Visa, MasterCard,
                                                    American Express</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label
                                        class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl cursor-pointer hover:border-indigo-500 dark:hover:border-indigo-400 transition-colors">
                                        <input type="radio" wire:model="payment_method" value="paypal"
                                            class="text-indigo-600 focus:ring-indigo-500">
                                        <div class="ml-4 flex items-center">
                                            <div class="text-2xl mr-3">🅿️</div>
                                            <div>
                                                <div class="font-semibold text-gray-900 dark:text-white">PayPal</div>
                                                <div class="text-sm text-gray-600 dark:text-gray-300">Pay with your
                                                    PayPal account</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label
                                        class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl cursor-pointer hover:border-indigo-500 dark:hover:border-indigo-400 transition-colors">
                                        <input type="radio" wire:model.live="payment_method" value="bank_transfer"
                                            class="text-indigo-600 focus:ring-indigo-500">
                                        <div class="ml-4 flex items-center">
                                            <div class="text-2xl mr-3">🏦</div>
                                            <div>
                                                <div class="font-semibold text-gray-900 dark:text-white">Bank Transfer
                                                </div>
                                                <div class="text-sm text-gray-600 dark:text-gray-300">Direct bank
                                                    transfer</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label
                                        class="flex items-center p-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl cursor-pointer hover:border-indigo-500 dark:hover:border-indigo-400 transition-colors">
                                        <input type="radio" wire:model.live="payment_method" value="midtrans"
                                            class="text-indigo-600 focus:ring-indigo-500">
                                        <div class="ml-4 flex items-center">
                                            <div class="text-2xl mr-3">💳</div>
                                            <div>
                                                <div class="font-semibold text-gray-900 dark:text-white">Midtrans</div>
                                                <div class="text-sm text-gray-600 dark:text-gray-300">Pay with Midtrans
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>

                                @error('payment_method')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror

                                <!-- Credit Card Form -->
                                <div x-show="$wire.payment_method === 'credit_card'" x-transition
                                    class="space-y-4 mt-6">
                                    <div>
                                        <label
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                            Card Number *
                                        </label>
                                        <input type="text" wire:model="card.number"
                                            placeholder="1234 5678 9012 3456"
                                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all duration-300">
                                        @error('card.number')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                                Expiry Date *
                                            </label>
                                            <input type="text" wire:model="card.expiry" placeholder="MM/YY"
                                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all duration-300">
                                            @error('card.expiry')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label
                                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                                CVV *
                                            </label>
                                            <input type="text" wire:model="card.cvv" placeholder="123"
                                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all duration-300">
                                            @error('card.cvv')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <label
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                            Cardholder Name *
                                        </label>
                                        <input type="text" wire:model="card.name" placeholder="John Doe"
                                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all duration-300">
                                        @error('card.name')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div
                            class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">
                            <div class="p-6">
                                <label class="flex items-start">
                                    <input type="checkbox" wire:model="accept_terms" required
                                        class="mt-1 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <span class="ml-3 text-sm text-gray-600 dark:text-gray-300">
                                        I agree to the <a href="#"
                                            class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">Terms
                                            and Conditions</a> and <a href="#"
                                            class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">Privacy
                                            Policy</a>
                                    </span>
                                </label>
                                @error('accept_terms')
                                    <span class="text-red-500 text-sm block mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div
                            class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 sticky top-8">
                            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Order Summary</h2>
                            </div>

                            <div class="p-6 space-y-4">
                                <!-- Order Items -->
                                <div class="space-y-4 max-h-64 overflow-y-auto">
                                    @foreach ($cartItems as $item)
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-indigo-100 via-purple-50 to-indigo-100 dark:from-gray-700 dark:via-gray-600 dark:to-gray-700 rounded-lg flex items-center justify-center">
                                                @if ($item['product']['image'] ?? null)
                                                    <img src="{{ asset('storage/' . $item['product']['image']) }}"
                                                        alt="{{ $item['product']['name'] }}"
                                                        class="w-full h-full object-cover rounded-lg">
                                                @else
                                                    <div class="text-lg opacity-60">🎵</div>
                                                @endif
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4
                                                    class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                                    {{ $item['product']['name'] }}
                                                </h4>
                                                <p class="text-xs text-gray-600 dark:text-gray-300">
                                                    Qty: {{ $item['quantity'] }}
                                                </p>
                                            </div>
                                            <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                                Rp.
                                                {{ number_format($item['quantity'] * $item['product']['price'], 2) }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <hr class="border-gray-200 dark:border-gray-700">

                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-300">Subtotal
                                            ({{ array_sum(array_column($cartItems, 'quantity')) }} items)</span>
                                        <span class="font-semibold text-gray-900 dark:text-white">Rp.
                                            {{ number_format($total, 2) }}</span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-300">Shipping</span>
                                        <span class="font-semibold text-green-600 dark:text-green-400">Free</span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span class="text-gray-600 dark:text-gray-300">Tax</span>
                                        <span class="font-semibold text-gray-900 dark:text-white">Rp.
                                            {{ number_format($total * 0.1, 2) }}</span>
                                    </div>

                                    <hr class="border-gray-200 dark:border-gray-700">

                                    <div class="flex justify-between text-lg font-bold">
                                        <span class="text-gray-900 dark:text-white">Total</span>
                                        <span class="text-indigo-600 dark:text-indigo-400">Rp.
                                            {{ number_format($total * 1.1, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 pt-0">
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 px-6 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                                    wire:loading.attr="disabled" wire:loading.class="opacity-50">
                                    <span
                                        wire:loading.remove>{{ $payment_method === 'midtrans' ? 'Pay Now' : 'Place Order' }}</span>
                                    <span wire:loading>Processing...</span>
                                </button>

                                <a href="{{ route('cart') }}"
                                    class="w-full mt-3 border-2 border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-6 rounded-lg hover:border-indigo-500 dark:hover:border-indigo-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-200 font-semibold text-center block">
                                    Back to Cart
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            @else
                <!-- Empty Cart -->
                <div class="text-center py-20">
                    <div class="text-8xl mb-6 opacity-50">🛒</div>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                        Your cart is empty
                    </h3>
                    <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">
                        Add some products to your cart before proceeding to checkout!
                    </p>
                    <a href="{{ route('products') }}"
                        class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-8 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Continue Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Midtrans Payment Modal -->
    @if ($showMidtransModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-4xl w-full mx-4 max-h-screen overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Complete Payment</h3>
                        <button wire:click="$set('showMidtransModal', false)"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div id="midtrans-payment" class="min-h-400"></div>
                </div>
            </div>
        </div>
    @endif

    <!-- Success Modal -->
    @if ($showSuccessModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full mx-4">
                <div class="p-6 text-center">
                    <!-- Success Icon -->
                    <div
                        class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>

                    <!-- Title -->
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                        Order Placed Successfully!
                    </h3>

                    <!-- Order Details -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 mb-6">
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-300">Order Number:</span>
                                <span
                                    class="font-semibold text-gray-900 dark:text-white">{{ $orderDetails['order_number'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-300">Items Ordered:</span>
                                <span
                                    class="font-semibold text-gray-900 dark:text-white">{{ $orderDetails['items_count'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-300">Total Amount:</span>
                                <span class="font-semibold text-indigo-600 dark:text-indigo-400">Rp.
                                    {{ number_format($orderDetails['total'], 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Message -->
                    <p class="text-gray-600 dark:text-gray-300 mb-6">
                        Thank you for your purchase! You will receive an email confirmation shortly with your order
                        details.
                    </p>

                    <!-- Action Buttons -->
                    <div class="flex space-x-3">
                        <a href="{{ route('orders', ['order' => $orderDetails['order_number']]) }}"
                            class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-6 rounded-lg transition-all duration-200 font-semibold shadow-lg hover:shadow-xl text-center">
                            View Order Details
                        </a>
                        <button wire:click="closeSuccessModal"
                            class="flex-1 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-6 rounded-lg hover:border-indigo-500 dark:hover:border-indigo-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-200 font-semibold">
                            Continue Shopping
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @push('scripts')
        <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.client_key') }}"></script>
        <script>
            Livewire.on('openMidtrans', function({snapToken}) {
                snap.pay(snapToken, {
                    onSuccess: function(result) {
                        console.log('success', result);
                        Livewire.dispatch('paymentSuccess', result);
                    },
                    onPending: function(result) {
                        console.log('pending', result);
                        Livewire.dispatch('paymentPending', result);
                    },
                    onError: function(result) {
                        console.log('error', result);
                        Livewire.dispatch('paymentFailed', result);
                    },
                    onClose: function() {
                        console.log('payment closed');
                        Livewire.dispatch('paymentClosed');
                    }
                });
            });
        </script>
    @endpush
</div>
