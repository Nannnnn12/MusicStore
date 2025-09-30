<div>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">

        <div class="min-h-screen" x-data="{ sidebarOpen: false }">
            <!-- Header with title and filter toggle -->
            <div
                class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 sm:px-6 lg:px-8 py-6 relative">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-2">
                            Our Products
                        </h1>
                        <p class="text-lg text-gray-600 dark:text-gray-300">
                            Discover our complete collection of premium musical instruments and accessories
                        </p>
                    </div>

                    <!-- Filter Toggle Button -->
                    <div class="relative">
                        <button @click="sidebarOpen = !sidebarOpen"
                            class="flex items-center space-x-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-4 py-2 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 font-medium"
                            x-text="sidebarOpen ? 'Hide Filters' : 'Show Filters'">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                </path>
                            </svg>
                            <span class="hidden sm:inline">Show Filters</span>
                        </button>

                        <!-- Filter Dropdown -->
                        <div class="absolute top-full right-0 mt-2 w-80 bg-white dark:bg-gray-800 shadow-2xl border border-gray-200 dark:border-gray-700 rounded-xl z-50 overflow-hidden"
                            x-show="sidebarOpen" x-transition:enter="transition-all duration-300 ease-out"
                            x-transition:enter-start="opacity-0 transform scale-95 translate-y-2"
                            x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                            x-transition:leave="transition-all duration-200 ease-in"
                            x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 transform scale-95 translate-y-2" x-cloak>
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-6">
                                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Filters</h2>
                                    <button @click="sidebarOpen = false"
                                        class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Category Filter -->
                                <div class="mb-6">
                                    <label
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Category</label>
                                    <select wire:model.live="selectedCategory"
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all duration-300">
                                        <option value="">All Categories</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category }}">{{ ucfirst($category) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Brand Filter -->
                                <div class="mb-6">
                                    <label
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Brand</label>
                                    <select wire:model.live="selectedBrand"
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all duration-300">
                                        <option value="">All Brands</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand }}">{{ $brand }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Stock Status -->
                                <div class="mb-6">
                                    <label
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Stock
                                        Status</label>
                                    <select wire:model.live="stockStatus"
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all duration-300">
                                        <option value="">All Products</option>
                                        <option value="in_stock">In Stock</option>
                                        <option value="low_stock">Low Stock</option>
                                        <option value="out_of_stock">Out of Stock</option>
                                    </select>
                                </div>

                                <!-- Sort Options -->
                                <div class="mb-6">
                                    <label
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Sort
                                        By</label>
                                    <div class="flex gap-3">
                                        <select wire:model.live="sortBy"
                                            class="flex-1 px-1 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all duration-300">
                                            <option value="name">Name</option>
                                            <option value="price">Price</option>
                                            <option value="created_at">Date Added</option>
                                        </select>
                                        <select wire:model.live="sortDirection"
                                            class="flex-1 py-3 rounded-xl border-2 border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all duration-300">
                                            <option value="asc">↑ Ascending</option>
                                            <option value="desc">↓ Descending</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Clear Filters -->
                                <div class="mt-8">
                                    <button wire:click="clearFilters"
                                        class="w-full px-8 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-xl font-semibold transition-all duration-200 shadow-lg hover:shadow-xl">
                                        Clear All Filters
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Section -->
                <div class="px-4 sm:px-6 lg:px-8 py-8">
                    <!-- Search Bar at Top -->
                    <div class="mb-8">
                        <div class="max-w-md mx-auto">
                            <div class="relative flex">
                                <input type="text" wire:model.defer="search" placeholder="Search products..."
                                    class="w-full px-4 py-3 pl-12 rounded-l-xl border-2 border-gray-200 dark:border-gray-600
               bg-white dark:bg-gray-700 text-gray-900 dark:text-white
               focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-400
               transition-all duration-300">
                                <button wire:click="searchProducts"
                                    class="px-6 bg-gradient-to-r from-indigo-600 to-purple-600 text-white
               rounded-r-xl hover:from-indigo-700 hover:to-purple-700
               transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                                    Search
                                </button>

                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>

                        </div>
                    </div>

                    @if ($products->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach ($products as $product)
                                <div
                                    class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl overflow-hidden transition-all duration-300 transform hover:-translate-y-2 border border-gray-200 dark:border-gray-700">
                                    <div
                                        class="relative h-56 bg-gradient-to-br from-indigo-100 via-purple-50 to-indigo-100 dark:from-gray-700 dark:via-gray-600 dark:to-gray-700 flex items-center justify-center overflow-hidden">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-br from-indigo-600/10 to-purple-600/10 dark:from-indigo-600/20 dark:to-purple-600/20">
                                        </div>
                                        <div
                                            class="relative text-8xl opacity-60 group-hover:scale-110 transition-transform duration-300">
                                            🎵
                                        </div>
                                        <div
                                            class="absolute top-4 right-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                                            {{ $product->category ?? 'Instrument' }}
                                        </div>
                                        @if ($product->brand)
                                            <div
                                                class="absolute top-4 left-4 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 px-2 py-1 rounded-full text-xs font-semibold shadow-lg">
                                                {{ $product->brand }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="p-8">
                                        <h3
                                            class="text-2xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                            {{ $product->name }}
                                        </h3>
                                        <p
                                            class="text-gray-600 dark:text-gray-300 text-base mb-6 line-clamp-3 leading-relaxed">
                                            {{ $product->description ?? 'High-quality musical instrument perfect for musicians of all levels. Crafted with precision and attention to detail.' }}
                                        </p>

                                        <div class="flex justify-between items-center mb-6">
                                            <div class="text-left">
                                                <span
                                                    class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                                    Rp. {{ number_format($product->price, 2) }}
                                                </span>
                                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                                    @if ($product->stock_quantity == 0)
                                                        Out of Stock
                                                    @elseif($product->stock_quantity <= 10)
                                                        Only {{ $product->stock_quantity }} left
                                                    @else
                                                        In Stock
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="text-right">
                                                <div class="flex items-center space-x-1 text-yellow-400 mb-2">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">4.8 (120 reviews)
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex space-x-3">
                                            <button
                                                class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-6 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                                Add to Cart
                                            </button>
                                            <a href="{{ route('product.detail', $product->id) }}"
                                                class="flex-1 border-2 border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-6 rounded-lg hover:border-indigo-500 dark:hover:border-indigo-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-200 font-semibold text-center block">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-12">
                            {{ $products->links() }}
                        </div>
                    @else
                        <div class="text-center py-20">
                            <div class="text-8xl mb-6 opacity-50">🎵</div>
                            <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                                No products found
                            </h3>
                            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">
                                {{ $search || $selectedCategory || $selectedBrand || $minPrice || $maxPrice || $stockStatus ? 'Try adjusting your search or filter criteria.' : 'Products will appear here once they are added to the system.' }}
                            </p>
                            @if ($search || $selectedCategory || $selectedBrand || $minPrice || $maxPrice || $stockStatus)
                                <button wire:click="clearFilters"
                                    class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-8 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                                    Clear Filters
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Footer -->
        @include('components.user.footer')
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</div>
