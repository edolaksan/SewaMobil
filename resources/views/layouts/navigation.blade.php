<nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('cars.index') }}" :active="request()->routeIs('cars.index')">
                        {{ __('Cars') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('rentals.index') }}" :active="request()->routeIs('rentals.index')">
                        {{ __('Rentals') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Logout') }}
                        </x-dropdown-link>
                    </form>
                @else
                    <x-nav-link href="{{ route('login') }}">
                        {{ __('Login') }}
                    </x-nav-link>
                @endauth
            </div>
        </div>
    </div>
</nav>
