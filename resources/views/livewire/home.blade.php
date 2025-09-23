<div>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 via-purple-50 to-indigo-50 dark:from-gray-900 dark:via-purple-900/20 dark:to-indigo-900/20">
    <!-- Navigation -->


    <!-- Hero Section -->
    <div class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-600/10 to-purple-600/10 dark:from-indigo-600/20 dark:to-purple-600/20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full mb-8 shadow-2xl">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/>
                    </svg>
                </div>

                <h1 class="text-5xl md:text-7xl font-bold text-gray-900 dark:text-white mb-8 leading-tight">
                    Welcome to <br>
                    <span class="bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent animate-gradient">
                        Music Store
                    </span>
                </h1>

                <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 mb-12 max-w-4xl mx-auto leading-relaxed">
                    Discover the finest collection of musical instruments, equipment, and accessories.
                    From guitars to keyboards, we have everything you need to create beautiful music.
                </p>

                <!-- Search Bar -->
                <div class="max-w-2xl mx-auto mb-16">
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                            <svg class="h-6 w-6 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input
                            type="text"
                            wire:model.live="search"
                            placeholder="Search for instruments, brands, or categories..."
                            class="w-full pl-14 pr-6 py-5 text-lg text-gray-900 bg-white/80 backdrop-blur-sm border-2 border-gray-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 focus:outline-none dark:bg-gray-800/80 dark:text-white dark:border-gray-600 dark:focus:ring-indigo-400/20 dark:focus:border-indigo-400 transition-all duration-300 shadow-lg hover:shadow-xl"
                        >
                    </div>
                </div>

                <!-- Category Filter -->
                <div class="flex flex-wrap justify-center gap-3 mb-16">
                    <button
                        wire:click="$set('selectedCategory', '')"
                        class="px-6 py-3 rounded-full text-sm font-semibold transition-all duration-200 transform hover:scale-105 {{ $selectedCategory === '' ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg' : 'bg-white/80 text-gray-700 hover:bg-white hover:shadow-md dark:bg-gray-800/80 dark:text-gray-300 dark:hover:bg-gray-800' }}"
                    >
                        All Categories
                    </button>
                    @foreach($this->categories as $category)
                        <button
                            wire:click="$set('selectedCategory', '{{ $category }}')"
                            class="px-6 py-3 rounded-full text-sm font-semibold transition-all duration-200 transform hover:scale-105 {{ $selectedCategory === $category ? 'bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg' : 'bg-white/80 text-gray-700 hover:bg-white hover:shadow-md dark:bg-gray-800/80 dark:text-gray-300 dark:hover:bg-gray-800' }}"
                        >
                            {{ ucfirst($category) }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Products Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                Featured Products
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                Discover our handpicked selection of premium instruments and accessories
            </p>
        </div>

        @if($this->products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($this->products->take(6) as $product)
                    <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl overflow-hidden transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 dark:border-gray-700">
                        <div class="relative h-56 bg-gradient-to-br from-indigo-100 via-purple-50 to-indigo-100 dark:from-gray-700 dark:via-gray-600 dark:to-gray-700 flex items-center justify-center overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/10 to-purple-600/10 dark:from-indigo-600/20 dark:to-purple-600/20"></div>
                            <div class="relative text-8xl opacity-60 group-hover:scale-110 transition-transform duration-300">
                                🎵
                            </div>
                            <div class="absolute top-4 right-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                                {{ $product->category ?? 'Instrument' }}
                            </div>
                        </div>

                        <div class="p-8">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                {{ $product->name }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 text-base mb-6 line-clamp-3 leading-relaxed">
                                {{ $product->description ?? 'High-quality musical instrument perfect for musicians of all levels. Crafted with precision and attention to detail.' }}
                            </p>

                            <div class="flex justify-between items-center mb-6">
                                <div class="text-left">
                                    <span class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                        ${{ number_format($product->price, 2) }}
                                    </span>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        {{ $product->stock_quantity ?? 'In Stock' }} available
                                    </p>
                                </div>
                                <div class="text-right">
                                    <div class="flex items-center space-x-1 text-yellow-400 mb-2">
                                        @for($i = 0; $i < 5; $i++)
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">4.8 (120 reviews)</p>
                                </div>
                            </div>

                            <div class="flex space-x-3">
                                <button class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-6 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    Add to Cart
                                </button>
                                <button class="flex-1 border-2 border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-6 rounded-lg hover:border-indigo-500 dark:hover:border-indigo-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-200 font-semibold">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Load More Button -->
            @if($this->products->count() > 6)
                <div class="text-center mt-12">
                    <button class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-2 border-gray-200 dark:border-gray-600 py-4 px-8 rounded-lg hover:border-indigo-500 dark:hover:border-indigo-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl">
                        Load More Products
                    </button>
                </div>
            @endif
        @else
            <div class="text-center py-20">
                <div class="text-8xl mb-6 opacity-50">🎵</div>
                <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                    No products found
                </h3>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8">
                    {{ $search || $selectedCategory ? 'Try adjusting your search or filter criteria.' : 'Products will appear here once they are added to the system.' }}
                </p>
                @if($search || $selectedCategory)
                    <button
                        wire:click="$set('search', ''); $set('selectedCategory', '')"
                        class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-8 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-semibold shadow-lg hover:shadow-xl"
                    >
                        Clear Filters
                    </button>
                @endif
            </div>
        @endif
    </div>

    <!-- Features Section -->
    <div class="bg-white dark:bg-gray-800 py-20 border-t border-gray-100 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                    Why Choose Music Store?
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    We're committed to providing the best musical instruments and exceptional service
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="text-center group">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl w-20 h-20 flex items-center justify-center mx-auto mb-6 shadow-xl group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Quality Guaranteed</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-lg leading-relaxed">All our instruments come with comprehensive quality assurance and warranty coverage</p>
                </div>

                <div class="text-center group">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl w-20 h-20 flex items-center justify-center mx-auto mb-6 shadow-xl group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Fast Delivery</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-lg leading-relaxed">Quick and secure delivery to your doorstep with real-time tracking</p>
                </div>

                <div class="text-center group">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl w-20 h-20 flex items-center justify-center mx-auto mb-6 shadow-xl group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Expert Support</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-lg leading-relaxed">Get personalized help from our team of musical instrument experts</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    
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

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
}

@keyframes gradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
</style>

</div>
