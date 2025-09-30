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
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="/products"
                                class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Products</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span
                                class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">{{ $product->name }}</span>
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

            <!-- Error Message -->
            @if (session()->has('error'))
                <div
                    class="mb-6 bg-red-100 dark:bg-red-900/30 border border-red-400 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
                <!-- Product Image -->
                <div class="space-y-4">
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                        <div
                            class="aspect-square bg-gradient-to-br from-indigo-100 via-purple-50 to-indigo-100 dark:from-gray-700 dark:via-gray-600 dark:to-gray-700 flex items-center justify-center">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="text-9xl opacity-60">🎵</div>
                            @endif
                        </div>
                    </div>

                    <!-- Thumbnail Images (if available) -->
                    @if ($product->image)
                        <div class="grid grid-cols-4 gap-4">
                            <div
                                class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border-2 border-indigo-500 cursor-pointer">
                                <div
                                    class="aspect-square bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover">
                                </div>
                            </div>
                            <!-- Add more thumbnails if available -->
                            <div
                                class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-700 cursor-pointer opacity-60 hover:opacity-100 transition-opacity">
                                <div
                                    class="aspect-square bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center">
                                    <div class="text-4xl">🎵</div>
                                </div>
                            </div>
                            <div
                                class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-700 cursor-pointer opacity-60 hover:opacity-100 transition-opacity">
                                <div
                                    class="aspect-square bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center">
                                    <div class="text-4xl">🎸</div>
                                </div>
                            </div>
                            <div
                                class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-700 cursor-pointer opacity-60 hover:opacity-100 transition-opacity">
                                <div
                                    class="aspect-square bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center">
                                    <div class="text-4xl">🥁</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Product Information -->
                <div class="space-y-8">
                    <!-- Product Title and Basic Info -->
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <span
                                class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                {{ ucfirst($product->category ?? 'Instrument') }}
                            </span>
                            @if ($product->brand)
                                <span
                                    class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 px-3 py-1 rounded-full text-sm font-semibold border border-gray-200 dark:border-gray-600">
                                    {{ $product->brand }}
                                </span>
                            @endif
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                SKU: {{ $product->sku ?? 'N/A' }}
                            </span>
                        </div>

                        <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                            {{ $product->name }}
                        </h1>

                        <div class="flex items-center gap-4 mb-6">
                            <span
                                class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                {{ $product->formatted_price ?? 'N/A' }}
                            </span>
                            <div class="flex items-center space-x-1">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">(4.8 - 120 reviews)</span>
                            </div>
                        </div>

                        <!-- Stock Status -->
                        <div class="mb-6">
                            @if ($product->stock_quantity == 0)
                                <span
                                    class="bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 px-4 py-2 rounded-lg text-sm font-semibold">
                                    Out of Stock
                                </span>
                            @elseif(($product->stock_quantity ?? 0) <= 10)
                                <span
                                    class="bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300 px-4 py-2 rounded-lg text-sm font-semibold">
                                    Only {{ $product->stock_quantity ?? 0 }} left in stock
                                </span>
                            @else
                                <span
                                    class="bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 px-4 py-2 rounded-lg text-sm font-semibold">
                                    In Stock ({{ $product->stock_quantity ?? 0 }} available)
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Description</h3>
                        <div class="prose prose-gray dark:prose-invert max-w-none">
                            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                                {{ $product->description ?? 'High-quality musical instrument perfect for musicians of all levels. Crafted with precision and attention to detail, this instrument delivers exceptional sound quality and playability.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Add to Cart Section -->
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                        <div class="flex items-center gap-4 mb-6">
                            <label for="quantity"
                                class="text-sm font-medium text-gray-700 dark:text-gray-300">Quantity:</label>
                            <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-lg">
                                <button type="button" wire:click="decrementQuantity"
                                    class="px-3 py-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 12H4"></path>
                                    </svg>
                                </button>
                                <span
                                    class="w-16 text-center py-2 text-lg font-semibold text-gray-900 dark:text-white">{{ $quantity }}</span>
                                <button type="button" wire:click="incrementQuantity"
                                    class="px-3 py-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                ({{ $product->stock_quantity ?? 0 }} available)
                            </span>
                        </div>

                        <div class="flex gap-4">
                            <button wire:click="addToCart"
                                class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 px-8 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                Add to Cart
                            </button>
                            <button wire:click="addToWishlist"
                                class="flex-1 border-2 border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-4 px-8 rounded-lg hover:border-indigo-500 dark:hover:border-indigo-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-200 font-semibold">
                                Add to Wishlist
                            </button>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-200 dark:border-gray-700">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Product Details</h4>
                            <dl class="space-y-3">
                                <div class="flex justify-between">
                                    <dt class="text-gray-600 dark:text-gray-400">Category:</dt>
                                    <dd class="text-gray-900 dark:text-white font-medium">
                                        {{ ucfirst($product->category ?? 'Instrument') }}</dd>
                                </div>
                                @if ($product->brand)
                                    <div class="flex justify-between">
                                        <dt class="text-gray-600 dark:text-gray-400">Brand:</dt>
                                        <dd class="text-gray-900 dark:text-white font-medium">{{ $product->brand }}
                                        </dd>
                                    </div>
                                @endif
                                @if ($product->sku)
                                    <div class="flex justify-between">
                                        <dt class="text-gray-600 dark:text-gray-400">SKU:</dt>
                                        <dd class="text-gray-900 dark:text-white font-medium">{{ $product->sku }}</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>

                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 border border-gray-200 dark:border-gray-700">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Shipping & Returns
                            </h4>
                            <dl class="space-y-3">
                                <div class="flex justify-between">
                                    <dt class="text-gray-600 dark:text-gray-400">Shipping:</dt>
                                    <dd class="text-gray-900 dark:text-white font-medium">Free shipping</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-gray-600 dark:text-gray-400">Returns:</dt>
                                    <dd class="text-gray-900 dark:text-white font-medium">30-day returns</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-gray-600 dark:text-gray-400">Warranty:</dt>
                                    <dd class="text-gray-900 dark:text-white font-medium">1 year warranty</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if ($relatedProducts->count() > 0)
                <div class="mt-16">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4 text-center">Related Products</h2>

                    <!-- Filters -->
                    <div class="flex flex-wrap justify-center gap-4 mb-8">
                        <div>
                            <span class="font-semibold mr-2 text-gray-700 dark:text-gray-300">Category:</span>
                            <button wire:click="setFilter('all')"
                                class="px-3 py-1 rounded-full border {{ $selectedCategory === 'all' || $selectedCategory === null ? 'bg-indigo-600 text-white border-indigo-600' : 'border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300' }}">
                                All
                            </button>
                            @foreach ($categories as $category)
                                <button wire:click="setFilter('{{ $category }}')"
                                    class="px-3 py-1 rounded-full border {{ $selectedCategory === $category ? 'bg-indigo-600 text-white border-indigo-600' : 'border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300' }}">
                                    {{ ucfirst($category) }}
                                </button>
                            @endforeach
                        </div>

                        <div>
                            <span class="font-semibold mr-2 text-gray-700 dark:text-gray-300">Sort by:</span>
                            <button wire:click="setSort('random')"
                                class="px-3 py-1 rounded-full border {{ $sortBy === 'random' ? 'bg-indigo-600 text-white border-indigo-600' : 'border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300' }}">
                                Random
                            </button>
                            <button wire:click="setSort('price_asc')"
                                class="px-3 py-1 rounded-full border {{ $sortBy === 'price_asc' ? 'bg-indigo-600 text-white border-indigo-600' : 'border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300' }}">
                                Price Low to High
                            </button>
                            <button wire:click="setSort('price_desc')"
                                class="px-3 py-1 rounded-full border {{ $sortBy === 'price_desc' ? 'bg-indigo-600 text-white border-indigo-600' : 'border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300' }}">
                                Price High to Low
                            </button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach ($relatedProducts as $relatedProduct)
                            <div
                                class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl overflow-hidden transition-all duration-300 transform hover:-translate-y-2 border border-gray-200 dark:border-gray-700">
                                <div
                                    class="relative h-48 bg-gradient-to-br from-indigo-100 via-purple-50 to-indigo-100 dark:from-gray-700 dark:via-gray-600 dark:to-gray-700 flex items-center justify-center overflow-hidden">
                                    @if ($relatedProduct->image)
                                        <img src="{{ asset('storage/' . $relatedProduct->image) }}"
                                            alt="{{ $relatedProduct->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div
                                            class="text-6xl opacity-60 group-hover:scale-110 transition-transform duration-300">
                                            🎵</div>
                                    @endif
                                    <div
                                        class="absolute top-3 right-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                        {{ $relatedProduct->category ?? 'Instrument' }}
                                    </div>
                                </div>

                                <div class="p-6">
                                    <h3
                                        class="text-lg font-bold text-gray-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                        {{ $relatedProduct->name }}
                                    </h3>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-2">
                                        {{ $relatedProduct->description ?? 'High-quality musical instrument perfect for musicians of all levels.' }}
                                    </p>

                                    <div class="flex justify-between items-center mb-4">
                                        <span
                                            class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                            ${{ number_format($relatedProduct->price, 2) }}
                                        </span>
                                        <span class="text-sm text-green-600 dark:text-green-400">
                                            @if ($relatedProduct->stock_quantity > 0)
                                                In Stock
                                            @else
                                                Out of Stock
                                            @endif
                                        </span>
                                    </div>

                                    <a href="{{ route('product.detail', $relatedProduct->id) }}"
                                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-2 px-4 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 text-center block">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

    </div>
</div>
