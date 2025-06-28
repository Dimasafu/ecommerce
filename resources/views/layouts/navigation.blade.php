<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 relative z-50 sticky top-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="block h-10 w-auto" />
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden sm:flex items-center space-x-8">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-nav-link>

                <!-- Produk -->
                <div x-data="{ open: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="text-gray-700 hover:text-orange-500 transition font-medium">Produk</button>
                    <div x-show="open"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        class="absolute left-0 mt-2 w-40 bg-white rounded shadow-md z-50">
                        <a href="{{ route('product.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Semua Produk</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Favorit</a>
                    </div>
                </div>

                <!-- Event -->
                <div x-data="{ open: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="text-gray-700 hover:text-orange-500 transition font-medium">Event</button>
                    <div x-show="open"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        class="absolute left-0 mt-2 w-40 bg-white rounded shadow-md z-50">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Ulang Tahun</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Pernikahan</a>
                    </div>
                </div>

                <!-- Lokasi -->
                <div x-data="{ open: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="text-gray-700 hover:text-orange-500 transition font-medium">Lokasi</button>
                    <div x-show="open"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        class="absolute left-0 mt-2 w-40 bg-white rounded shadow-md z-50">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Semarang</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Jogja</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Surakarta</a>
                    </div>
                </div>

                <a href="#" class="text-gray-700 hover:text-orange-500 font-medium">Dekorasi</a>
            </div>

            <!-- Right Side -->
            <div class="hidden sm:flex items-center space-x-4">
                @auth
                    <a href="#" class="me-4 text-gray-600 hover:text-gray-800">
                        <i class="fas fa-shopping-cart text-lg"></i>
                    </a>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5.121 17.804A4 4 0 018 16h8a4 4 0 012.879 1.804M15 11a3 3 0 10-6 0 3 3 0 006 0z"/>
                                </svg>
                                <span>{{ Auth::user()->name }}</span>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profil</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <x-nav-link :href="route('login')">Login</x-nav-link>
                    <x-nav-link :href="route('register')">Register</x-nav-link>
                @endauth
            </div>

            <!-- Mobile Hamburger -->
            <div class="sm:hidden flex items-center">
                <button @click="open = true" class="text-gray-600 hover:text-orange-500 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Modal Menu -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-x-full"
         x-transition:enter-end="opacity-100 translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-x-0"
         x-transition:leave-end="opacity-0 translate-x-full"
         class="fixed inset-0 z-40 bg-black bg-opacity-50 sm:hidden">
        <div class="fixed top-0 right-0 w-64 h-full bg-white p-6 shadow-lg overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <img src="{{ asset('images/logo.png') }}" class="h-8" alt="Logo">
                <button @click="open = false" class="text-gray-600 hover:text-gray-900">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-orange-500 font-semibold">Home</a>

            <div class="py-2">
                <p class="text-gray-500 font-semibold mb-1">Produk</p>
                <a href="{{ route('product.index') }}" class="block text-sm text-gray-700 hover:text-orange-500">Semua Produk</a>
                <a href="#" class="block text-sm text-gray-700 hover:text-orange-500">Favorit</a>
            </div>

            <div class="py-2">
                <p class="text-gray-500 font-semibold mb-1">Event</p>
                <a href="#" class="block text-sm text-gray-700 hover:text-orange-500">Ulang Tahun</a>
                <a href="#" class="block text-sm text-gray-700 hover:text-orange-500">Pernikahan</a>
            </div>

            <div class="py-2">
                <p class="text-gray-500 font-semibold mb-1">Lokasi</p>
                <a href="#" class="block text-sm text-gray-700 hover:text-orange-500">Semarang</a>
                <a href="#" class="block text-sm text-gray-700 hover:text-orange-500">Jogja</a>
                <a href="#" class="block text-sm text-gray-700 hover:text-orange-500">Surakarta</a>
            </div>

            <a href="#" class="block py-2 text-gray-700 hover:text-orange-500 font-semibold">Dekorasi</a>

            <hr class="my-4">

            @auth
                <a href="#" class="block text-gray-700 py-2 hover:text-orange-500">
                    <i class="fas fa-shopping-cart mr-2"></i> Keranjang
                </a>
                <a href="{{ route('profile.edit') }}" class="block text-gray-700 py-2 hover:text-orange-500">Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left text-gray-700 py-2 hover:text-orange-500">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block py-2 text-gray-700 hover:text-orange-500">Login</a>
                <a href="{{ route('register') }}" class="block py-2 text-gray-700 hover:text-orange-500">Register</a>
            @endauth
        </div>
    </div>
</nav>
