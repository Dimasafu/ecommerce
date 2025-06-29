<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto">
                </a>
            </div>

            <!-- Center Menu -->
            <div class="hidden sm:flex space-x-6">
                @auth
                    @if (Auth::user()->role === 'admin')
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-nav-link>
                        <x-nav-link :href="route('products')" :active="request()->routeIs('products')">Product</x-nav-link>
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">Admin Dashboard</x-nav-link>
                    @else
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-nav-link>
                        <x-nav-link :href="route('products')" :active="request()->routeIs('products')">Product</x-nav-link>
                        <x-nav-link :href="route('decoration')" :active="request()->routeIs('decoration')">Decoration</x-nav-link>
                        <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">Contact</x-nav-link>
                    @endif
                @else
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-nav-link>
                    <x-nav-link :href="route('products')" :active="request()->routeIs('products')">Product</x-nav-link>
                    <x-nav-link :href="route('decoration')" :active="request()->routeIs('decoration')">Decoration</x-nav-link>
                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">Contact</x-nav-link>
                @endauth
            </div>

            <!-- Right Menu -->
            <div class="hidden sm:flex items-center space-x-4">
                @auth
                    @if (Auth::user()->role === 'user')
                        <a href="#" class="text-gray-600 hover:text-gray-800">
                            <i class="fas fa-shopping-cart text-lg"></i>
                        </a>
                    @endif

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center space-x-2 text-gray-700 hover:text-orange-500">
                                <i class="fas fa-user-circle text-lg"></i>
                                <span>hi,{{ Auth::user()->name }}</span>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Edit Profil</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="text-gray-700 hover:text-orange-500">
                                <i class="fas fa-user-circle text-xl"></i>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('login')">Login</x-dropdown-link>
                            <x-dropdown-link :href="route('register')">Register</x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="sm:hidden flex items-center">
                <button @click="open = true" class="text-gray-600 hover:text-orange-500">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Modal -->
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

            @auth
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-orange-500 font-semibold">Home</a>
                    <a href="{{ route('admin.dashboard') }}" class="block py-2 text-gray-700 hover:text-orange-500 font-semibold">Admin Dashboard</a>
                @else
                    <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-orange-500 font-semibold">Home</a>
                    <a href="{{ route('products') }}" class="block py-2 text-gray-700 hover:text-orange-500 font-semibold">Product</a>
                    <a href="{{ route('decoration') }}" class="block py-2 text-gray-700 hover:text-orange-500 font-semibold">Decoration</a>
                    <a href="{{ route('contact') }}" class="block py-2 text-gray-700 hover:text-orange-500 font-semibold">Contact</a>
                    <hr class="my-2">
                    <a href="#" class="block py-2 text-gray-700 hover:text-orange-500">
                        <i class="fas fa-shopping-cart mr-2"></i>Keranjang
                    </a>
                    <a href="{{ route('profile.edit') }}" class="block py-2 text-gray-700 hover:text-orange-500">Profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left py-2 text-gray-700 hover:text-orange-500">Logout</button>
                    </form>
                @endif
            @else
                <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-orange-500 font-semibold">Home</a>
                <a href="{{ route('products') }}" class="block py-2 text-gray-700 hover:text-orange-500 font-semibold">Product</a>
                <a href="{{ route('decoration') }}" class="block py-2 text-gray-700 hover:text-orange-500 font-semibold">Decoration</a>
                <a href="{{ route('contact') }}" class="block py-2 text-gray-700 hover:text-orange-500 font-semibold">Contact</a>
                <hr class="my-2">
                <a href="{{ route('login') }}" class="block py-2 text-gray-700 hover:text-orange-500">Login</a>
                <a href="{{ route('register') }}" class="block py-2 text-gray-700 hover:text-orange-500">Register</a>
            @endauth
        </div>
    </div>
</nav>
