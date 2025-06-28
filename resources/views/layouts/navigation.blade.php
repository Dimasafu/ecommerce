<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Responsive Mobile Menu -->
            <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-nav-link>
                    <x-nav-link :href="route('product.index')" :active="request()->routeIs('product.index')">Produk</x-nav-link>
                    <x-nav-link href="#">Event</x-nav-link>
                    <x-nav-link href="#">Lokasi</x-nav-link>
                    <x-nav-link href="#">Dekorasi</x-nav-link>
                </div>

                <div class="pt-4 pb-1 border-t border-gray-200">
                    @auth
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        </div>
                        <div class="mt-3 space-y-1">
                            <x-dropdown-link :href="route('profile.edit')">Profil</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </x-dropdown-link>
                            </form>
                        </div>
                    @else
                        <div class="mt-3 space-y-1 px-4">
                            <x-dropdown-link :href="route('login')">Login</x-dropdown-link>
                            <x-dropdown-link :href="route('register')">Register</x-dropdown-link>
                        </div>
                    @endauth
                </div>
            </div>
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="block h-12 w-auto" />
                    </a>
                </div>
                <!-- Mobile Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-orange-500 focus:outline-none">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Navigation Links -->
                <div class="hidden sm:flex space-x-4 sm:ms-10">
                    @auth
                        @if (Auth::user()->role === 'admin')
                            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                                Home
                            </x-nav-link>
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                Admin Dashboard
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                                Home
                            </x-nav-link>
                            <div class="hidden sm:flex space-x-8 sm:ms-10 sm:items-center">
                                <div x-data="{ open: false }" class="relative" @mouseenter="open = true"
                                    @mouseleave="open = false">
                                    <button
                                        class="text-gray-700 hover:text-orange-500 transition font-medium">Produk</button>
                                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 translate-y-2"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 translate-y-0"
                                        x-transition:leave-end="opacity-0 translate-y-2"
                                        class="absolute z-50 left-0 mt-2 w-40 bg-white rounded shadow-md">
                                        <a href="{{ route('product.index') }}"
                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Semua Produk</a>
                                        <a href="#"
                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Favorit</a>
                                    </div>
                                </div>


                                <div x-data="{ open: false }" class="relative" @mouseenter="open = true"
                                    @mouseleave="open = false">
                                    <button
                                        class="text-gray-700 hover:text-orange-500 transition font-medium">Event</button>
                                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 translate-y-2"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 translate-y-0"
                                        x-transition:leave-end="opacity-0 translate-y-2"
                                        class="absolute z-50 left-0 mt-2 w-40 bg-white rounded shadow-md">
                                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Ulang
                                            Tahun</a>
                                        <a href="#"
                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Pernikahan</a>
                                    </div>
                                </div>

                                <div x-data="{ open: false }" class="relative" @mouseenter="open = true"
                                    @mouseleave="open = false">
                                    <button
                                        class="text-gray-700 hover:text-orange-500 transition font-medium">Lokasi</button>
                                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 translate-y-2"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 translate-y-0"
                                        x-transition:leave-end="opacity-0 translate-y-2"
                                        class="absolute z-50 left-0 mt-2 w-40 bg-white rounded shadow-md">
                                        <a href="#"
                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Semarang</a>
                                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Jogja</a>
                                        <a href="#"
                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Surakarta</a>
                                    </div>
                                </div>

                                <a href="#"
                                    class="text-gray-700 hover:text-orange-500 font-medium transition">Dekorasi</a>
                            </div>
                        @endif
                    @else
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                            Home
                        </x-nav-link>
                        <div class="hidden sm:flex space-x-8 sm:ms-10 sm:items-center">
                            <div x-data="{ open: false }" class="relative" @mouseenter="open = true"
                                @mouseleave="open = false">
                                <button class="text-gray-700 hover:text-orange-500 transition font-medium">Produk</button>
                                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 translate-y-2"
                                    class="absolute z-50 left-0 mt-2 w-40 bg-white rounded shadow-md">
                                    <a href="{{ route('product.index') }}"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Semua Produk</a>
                                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Favorit</a>
                                </div>
                            </div>


                            <div x-data="{ open: false }" class="relative" @mouseenter="open = true"
                                @mouseleave="open = false">
                                <button class="text-gray-700 hover:text-orange-500 transition font-medium">Event</button>
                                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 translate-y-2"
                                    class="absolute z-50 left-0 mt-2 w-40 bg-white rounded shadow-md">
                                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Ulang
                                        Tahun</a>
                                    <a href="#"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Pernikahan</a>
                                </div>
                            </div>

                            <div x-data="{ open: false }" class="relative" @mouseenter="open = true"
                                @mouseleave="open = false">
                                <button class="text-gray-700 hover:text-orange-500 transition font-medium">Lokasi</button>
                                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 translate-y-2"
                                    class="absolute z-50 left-0 mt-2 w-40 bg-white rounded shadow-md">
                                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Semarang</a>
                                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Jogja</a>
                                    <a href="#"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Surakarta</a>
                                </div>
                            </div>

                            <a href="#"
                                class="text-gray-700 hover:text-orange-500 font-medium transition">Dekorasi</a>
                        </div>
                    @endauth
                </div>
            </div>

            <!-- Auth Section -->
            <div class="hidden sm:flex items-center space-x-4">
                @auth <a href="#" class="me-4 text-gray-600 hover:text-gray-800">
                        <i class="fas fa-shopping-cart text-m"></i>
                    </a>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A4 4 0 018 16h8a4 4 0 012.879 1.804M15 11a3 3 0 10-6 0 3 3 0 006 0z" />
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
                    <div x-data="{ open: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                        <button class="text-gray-700 hover:text-orange-500 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A4 4 0 018 16h8a4 4 0 012.879 1.804M15 11a3 3 0 10-6 0 3 3 0 006 0z" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute right-0 mt-2 w-40 bg-white rounded shadow-md z-50">
                            <x-dropdown-link :href="route('login')">Login</x-dropdown-link>
                            <x-dropdown-link :href="route('register')">Register</x-dropdown-link>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
