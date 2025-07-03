@php
    $role = Auth::check() ? Auth::user()->role : null;
@endphp

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    @if ($role === 'admin')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            Admin Panel
                        </x-nav-link>
                        <x-nav-link :href="route('admin.kriteria.index')" :active="request()->routeIs('admin.kriteria.*')">
                            Data Kriteria
                        </x-nav-link>
                        <x-nav-link :href="route('admin.perhitungan')" :active="request()->routeIs('admin.perhitungan')">
                            Perhitungan
                        </x-nav-link>
                    @elseif ($role === 'hrd')
                        <x-nav-link :href="route('hrd.dashboard')" :active="request()->routeIs('hrd.dashboard')">
                            HRD Panel
                        </x-nav-link>
                        <x-nav-link :href="route('hrd.alternatif.index')" :active="request()->routeIs('hrd.alternatif.*')">
                            Data Alternatif
                        </x-nav-link>
                        <x-nav-link :href="route('hrd.nilai.index')" :active="request()->routeIs('hrd.nilai.*')">
                            Input Nilai
                        </x-nav-link>
                        <x-nav-link :href="route('hrd.perhitungan')" :active="request()->routeIs('hrd.perhitungan')">
                            Perhitungan
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700">
                            {{ Auth::user()->name }} ({{ $role }})
                            <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profil
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Keluar
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            @if ($role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    Admin Panel
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.kriteria.index')" :active="request()->routeIs('admin.kriteria.*')">
                    Data Kriteria
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.perhitungan')" :active="request()->routeIs('admin.perhitungan')">
                    Perhitungan
                </x-responsive-nav-link>
            @elseif ($role === 'hrd')
                <x-responsive-nav-link :href="route('hrd.dashboard')" :active="request()->routeIs('hrd.dashboard')">
                    HRD Panel
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('hrd.alternatif.index')" :active="request()->routeIs('hrd.alternatif.*')">
                    Data Alternatif
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('hrd.nilai.index')" :active="request()->routeIs('hrd.nilai.*')">
                    Input Nilai
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('hrd.perhitungan')" :active="request()->routeIs('hrd.perhitungan')">
                    Perhitungan
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- User Info -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                <div class="text-sm text-gray-500">{{ $role }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profil
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Keluar
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
