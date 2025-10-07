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
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Shopping
                                Cart</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Success Message -->
            @if (session()->has('message'))
                <div
                    class="mb-6 bg-green-100 dark:bg-green-900/30 border border-green-400 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg">
                    {{ session('message') }}
                </div>
            @endif

            @if (count($cartItems) > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2">
                        <div
                            class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">
                            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Shopping Cart</h1>
                                <p class="text-gray-600 dark:text-gray-300 mt-1">{{ count($cartItems) }} item(s) in your
                                    cart</p>
                                <div class="mt-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model.live="selectAll" wire:click="toggleSelectAll" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <span class="ml-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Select All Items</span>
                                    </label>
                                </div>
                            </div>

                            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($cartItems as $item)
                                    <div class="p-6">
                                        <div class="flex items-center space-x-4">
                                            <!-- Checkbox -->
                                            <div class="flex items-center">
                                                <input type="checkbox" wire:model.live="selectedItems" value="{{ $item['id'] }}" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            </div>

                                            <!-- Product Image -->
                                            <div
                                                class="flex-shrink-0 w-24 h-24 bg-gradient-to-br from-indigo-100 via-purple-50 to-indigo-100 dark:from-gray-700 dark:via-gray-600 dark:to-gray-700 rounded-lg flex items-center justify-center">
                                                @if ($item['product']['image'] ?? null)
                                                    <img src="{{ asset('storage/' . $item['product']['image']) }}"
                                                        alt="{{ $item['product']['name'] }}"
                                                        class="w-full h-full object-cover rounded-lg">
                                                @else
                                                    <div class="text-3xl opacity-60">🎵</div>
                                                @endif
                                            </div>

                                            <!-- Product Details -->
                                            <div class="flex-1 min-w-0">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">
                                                    {{ $item['product']['name'] }}
                                                </h3>
                                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">
                                                    {{ $item['product']['category'] ?? 'Instrument' }}
                                                </p>
                                                <p class="text-lg font-bold text-indigo-600 dark:text-indigo-400">
                                                    Rp. {{ number_format($item['product']['price'], 2) }}
                                                </p>
                                            </div>

                                            <!-- Quantity Controls -->
                                            <div class="flex items-center space-x-3">
                                                <button
                                                    wire:click="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] - 1 }})"
                                                    class="p-1 rounded-full bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-500 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M20 12H4"></path>
                                                    </svg>
                                                </button>
                                                <span
                                                    class="w-12 text-center text-lg font-semibold text-white">{{ $item['quantity'] }}</span>
                                                <button
                                                    wire:click="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] + 1 }})"
                                                    class="p-1 rounded-full bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-500 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Item Total -->
                                            <div class="text-right">
                                                <p class="text-lg font-bold text-gray-900 dark:text-white">
                                                    Rp. {{ number_format($item['quantity'] * $item['product']['price'], 2) }}
                                                </p>
                                                <button wire:click="removeItem({{ $item['id'] }})"
                                                    class="text-sm text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Clear Cart Button -->
                            <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                                <button wire:click="clearCart"
                                    class="w-full bg-red-600 text-white py-3 px-6 rounded-lg hover:bg-red-700 transition-colors font-semibold">
                                    Clear Cart
                                </button>
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
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-300">Subtotal
                                        ({{ count($selectedItems) }} items)</span>
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white">Rp. {{ number_format($total, 2) }}</span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-300">Shipping</span>
                                    <span class="font-semibold text-green-600 dark:text-green-400">Free</span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-300">Tax</span>
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white">Rp. {{ number_format($total * 0.1, 2) }}</span>
                                </div>

                                <hr class="border-gray-200 dark:border-gray-700">

                                <div class="flex justify-between text-lg font-bold">
                                    <span class="text-gray-900 dark:text-white">Total</span>
                                    <span
                                        class="text-indigo-600 dark:text-indigo-400">Rp. {{ number_format($total * 1.1, 2) }}</span>
                                </div>
                            </div>

                            <div class="p-6 pt-0">
                                <button wire:click="proceedToCheckout"
                                    class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 px-6 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                                    wire:loading.attr="disabled" wire:loading.class="opacity-50">
                                    <span wire:loading.remove>Proceed to Checkout</span>
                                    <span wire:loading>Processing...</span>
                                </button>

                                <button
                                    class="w-full mt-3 border-2 border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-6 rounded-lg hover:border-indigo-500 dark:hover:border-indigo-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-200 font-semibold">
                                    Continue Shopping
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart -->
                <div class="text-center py-20">
                    <div class="text-8xl mb-6 opacity-50">🛒</div>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                        Your cart is empty
                    </h3>
                    <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">
                        Add some products to your cart to get started!
                    </p>
                    <a href="/products"
                        class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-8 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Continue Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
