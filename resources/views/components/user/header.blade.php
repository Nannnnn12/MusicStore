<nav class="bg-white/90 backdrop-blur-lg shadow-sm border-b border-gray-200/50 dark:bg-gray-900/90 dark:border-gray-700/50 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center space-x-8">
                <div class="flex items-center space-x-3">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        Music Store
                    </h1>
                </div>

                <!-- Navigation Menu -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="/" class="text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 transition-all duration-200 font-medium relative group">
                        Home
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-200 group-hover:w-full"></span>
                    </a>
                    <a href="/products" class="text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 transition-all duration-200 font-medium relative group">
                        Products
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-200 group-hover:w-full"></span>
                    </a>
                    <a href="/categories" class="text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 transition-all duration-200 font-medium relative group">
                        Categories
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-200 group-hover:w-full"></span>
                    </a>
                    <a href="/about" class="text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 transition-all duration-200 font-medium relative group">
                        About
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-200 group-hover:w-full"></span>
                    </a>
                    <a href="/contact" class="text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 transition-all duration-200 font-medium relative group">
                        Contact
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-200 group-hover:w-full"></span>
                    </a>
                </div>
            </div>

            <!-- User Actions -->
            <div class="flex items-center space-x-4">
                <a href="/signin" class="text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 transition-all duration-200 font-medium relative group">
                    Sign In
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-200 group-hover:w-full"></span>
                </a>
                <a href="/signup" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2.5 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Sign Up
                </a>

                <!-- Mobile Menu Button -->
                <button class="lg:hidden p-2 rounded-lg text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu (Hidden by default) -->
        <div class="lg:hidden hidden pb-4">
            <div class="flex flex-col space-y-2">
                <a href="/" class="text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 transition-all duration-200 font-medium py-2 px-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800">
                    Home
                </a>
                <a href="/products" class="text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 transition-all duration-200 font-medium py-2 px-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800">
                    Products
                </a>
                <a href="/categories" class="text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 transition-all duration-200 font-medium py-2 px-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800">
                    Categories
                </a>
                <a href="/about" class="text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 transition-all duration-200 font-medium py-2 px-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800">
                    About
                </a>
                <a href="/contact" class="text-gray-600 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 transition-all duration-200 font-medium py-2 px-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800">
                    Contact
                </a>
            </div>
        </div>
    </div>
</nav>
