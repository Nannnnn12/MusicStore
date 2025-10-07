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
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">My Orders</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">My Orders</h1>
                <p class="mt-2 text-gray-600 dark:text-gray-300">Track and manage your order history</p>
            </div>

            @if(count($orders) > 0)
                <!-- Orders List -->
                <div class="space-y-6">
                    @foreach($orders as $order)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Order #{{ $order['order_number'] }}
                                        </h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">
                                            Placed on {{ \Carbon\Carbon::parse($order['created_at'])->format('M d, Y \a\t H:i') }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $this->getStatusColor($order['status']) }}">
                                            {{ ucfirst($order['status']) }}
                                        </span>
                                        <p class="mt-1 text-lg font-bold text-gray-900 dark:text-white">
                                            Rp. {{ number_format($order['total'], 2) }}
                                        </p>
                                    </div>
                                </div>

                                <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div class="text-sm text-gray-600 dark:text-gray-300">
                                                {{ count($order['order_items']) }} item{{ count($order['order_items']) > 1 ? 's' : '' }}
                                            </div>
                                        </div>
                                        <button wire:click="viewOrder({{ $order['id'] }})"
                                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                            View Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-20">
                    <div class="text-8xl mb-6 opacity-50">📦</div>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                        No orders yet
                    </h3>
                    <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">
                        You haven't placed any orders yet. Start shopping to see your orders here!
                    </p>
                    <a href="{{ route('products') }}"
                        class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-8 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Order Details Modal -->
    @if($selectedOrder)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                            Order Details #{{ $selectedOrder['order_number'] }}
                        </h2>
                        <button wire:click="closeOrderDetails"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Order Status -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-semibold text-gray-900 dark:text-white">Status:</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $this->getStatusColor($selectedOrder['status']) }}">
                                {{ ucfirst($selectedOrder['status']) }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                            Ordered on {{ \Carbon\Carbon::parse($selectedOrder['created_at'])->format('M d, Y \a\t H:i') }}
                        </p>
                    </div>

                    <!-- Order Items -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Order Items</h3>
                        <div class="space-y-4">
                            @foreach($selectedOrder['order_items'] as $item)
                                <div class="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <div class="flex-shrink-0 w-16 h-16 bg-gradient-to-br from-indigo-100 via-purple-50 to-indigo-100 dark:from-gray-600 dark:via-gray-500 dark:to-gray-600 rounded-lg flex items-center justify-center">
                                        @if($item['product']['image'] ?? null)
                                            <img src="{{ asset('storage/' . $item['product']['image']) }}"
                                                alt="{{ $item['product']['name'] }}"
                                                class="w-full h-full object-cover rounded-lg">
                                        @else
                                            <div class="text-lg opacity-60">🎵</div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900 dark:text-white">{{ $item['product']['name'] }}</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">Quantity: {{ $item['quantity'] }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-semibold text-gray-900 dark:text-white">
                                            Rp. {{ number_format($item['total'], 2) }}
                                        </p>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">
                                            @ {{ number_format($item['price'], 2) }} each
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Order Summary</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Billing Information -->
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Billing Information</h4>
                                <div class="text-sm text-gray-600 dark:text-gray-300 space-y-1">
                                    <p>{{ $selectedOrder['billing_first_name'] }} {{ $selectedOrder['billing_last_name'] }}</p>
                                    <p>{{ $selectedOrder['billing_email'] }}</p>
                                    <p>{{ $selectedOrder['billing_phone'] }}</p>
                                    <p>{{ $selectedOrder['billing_address'] }}</p>
                                    <p>{{ $selectedOrder['billing_city'] }}, {{ $selectedOrder['billing_state'] }} {{ $selectedOrder['billing_zip_code'] }}</p>
                                    <p>{{ $selectedOrder['billing_country'] }}</p>
                                </div>
                            </div>

                            <!-- Shipping Information -->
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Shipping Information</h4>
                                <div class="text-sm text-gray-600 dark:text-gray-300 space-y-1">
                                    <p>{{ $selectedOrder['shipping_first_name'] }} {{ $selectedOrder['shipping_last_name'] }}</p>
                                    <p>{{ $selectedOrder['shipping_address'] }}</p>
                                    <p>{{ $selectedOrder['shipping_city'] }}, {{ $selectedOrder['shipping_state'] }} {{ $selectedOrder['shipping_zip_code'] }}</p>
                                    <p>{{ $selectedOrder['shipping_country'] }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Summary -->
                        <div class="mt-6 bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-300">Subtotal</span>
                                    <span class="font-semibold text-gray-900 dark:text-white">Rp. {{ number_format($selectedOrder['subtotal'], 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-300">Tax</span>
                                    <span class="font-semibold text-gray-900 dark:text-white">Rp. {{ number_format($selectedOrder['tax'], 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-300">Shipping</span>
                                    <span class="font-semibold text-gray-900 dark:text-white">Rp. {{ number_format($selectedOrder['shipping_cost'], 2) }}</span>
                                </div>
                                <hr class="border-gray-300 dark:border-gray-600">
                                <div class="flex justify-between text-lg font-bold">
                                    <span class="text-gray-900 dark:text-white">Total</span>
                                    <span class="text-indigo-600 dark:text-indigo-400">Rp. {{ number_format($selectedOrder['total'], 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
