<style>
    .brandLogo {
        width: 32px;
        height: 32px;
    }

    .nav-container {
        background: linear-gradient(90deg, #4c6ef5, #15aabf);
        color: white;
    }

    .nav-link {
        color: white;
        padding: 0.5rem 1rem;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .nav-link:hover {
        color: #ffec99;
        transform: translateY(-2px);
    }

    .dropdown-trigger {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .dropdown-trigger:hover {
        background-color: rgba(255, 255, 255, 0.4);
    }

    .dropdown-menu {
        background-color: white;
        color: #4c6ef5;
        border-radius: 8px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .dropdown-link {
        padding: 0.5rem 1rem;
        transition: background-color 0.3s ease;
    }

    .dropdown-link:hover {
        background-color: #f8f9fa;
    }

    .hamburger-icon {
        color: white;
    }

    .responsive-menu {
        background-color: #4c6ef5;
        color: white;
        padding: 1rem;
        border-radius: 8px;
    }
</style>

<nav x-data="{ open: false }" class="nav-container border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <img src="https://i.ibb.co/DRCjqPB/556-5560757-vector-bison-logo-clipart.png" alt="logoByson" class="brandLogo me-3">
                    <span class="font-bold text-lg">Raivalaravel</span>
                </a>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        {{ __('Dashboard') }}
                    </a>
                </div>
            </div>

            <!-- Data Master Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div x-data="{ dropdownOpen: false }" class="relative">
                    <!-- Trigger Button -->
                    <button @click="dropdownOpen = !dropdownOpen" class="dropdown-trigger">
                        Data Master
                        <svg class="inline-block w-4 h-4 ms-1 transform transition-transform" 
                            :class="dropdownOpen ? 'rotate-180' : 'rotate-0'" 
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" 
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 
                                  01-1.414 0l-4-4a1 1 0 010-1.414z" 
                                  clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="dropdownOpen" 
                        x-transition:enter="transition ease-out duration-200 transform" 
                        x-transition:enter-start="opacity-0 scale-95" 
                        x-transition:enter-end="opacity-100 scale-100" 
                        x-transition:leave="transition ease-in duration-150 transform" 
                        x-transition:leave-start="opacity-100 scale-100" 
                        x-transition:leave-end="opacity-0 scale-95" 
                        @click.away="dropdownOpen = false" 
                        class="dropdown-menu absolute right-0 mt-2 w-48 origin-top-right">
                        <a href="{{ route('tambah-barang') }}" class="dropdown-link block">Product Master</a>
                        <a href="{{ route('tambah-supplier') }}" class="dropdown-link block">Supplier Master</a>
                        <a href="{{ route('product-index') }}" class="dropdown-link block">Product Index</a>
                        <a href="{{ route('supplier-index') }}" class="dropdown-link block">Supplier Index</a>
                    </div>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div x-data="{ dropdownOpen: false }" class="relative">
                    <button @click="dropdownOpen = !dropdownOpen" class="dropdown-trigger">
                        {{ Auth::user()->name }}
                    </button>

                    <div x-show="dropdownOpen" 
                         @click.away="dropdownOpen = false" 
                         class="dropdown-menu absolute right-0 mt-2 w-48">
                        <a href="{{ route('profile.edit') }}" class="dropdown-link block">{{ __('Profile') }}</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-link w-full text-left">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <button @click="open = ! open" class="flex items-center -me-2 sm:hidden hamburger-icon">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden responsive-menu">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="nav-link block">
                {{ __('Dashboard') }}
            </a>
        </div>
    </div>
</nav>

