@php
use Illuminate\Support\Facades\Auth;
@endphp

<nav x-data="{ open: false }" class="bg-vet-light-card dark:bg-vet-dark-card border-b border-vet-light-border dark:border-vet-dark-border">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-vet-primary-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-vet-primary-600 dark:text-vet-primary-400">VetCare</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-3 sm:flex sm:items-center sm:ml-6">
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                            class="group flex items-center px-3 py-2 rounded-md transition-colors duration-150">
                            <svg class="w-5 h-5 mr-2 text-vet-primary-500 group-hover:text-vet-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            {{ __('Dashboard') }}
                        </x-nav-link>

                        <x-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')"
                            class="group flex items-center px-3 py-2 rounded-md transition-colors duration-150">
                            <svg class="w-5 h-5 mr-2 text-vet-primary-500 group-hover:text-vet-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ __('Clients') }}
                        </x-nav-link>

                        <x-nav-link :href="route('pets.index')" :active="request()->routeIs('pets.*')"
                            class="group flex items-center px-3 py-2 rounded-md transition-colors duration-150">
                            <svg class="w-5 h-5 mr-2 text-vet-primary-500 group-hover:text-vet-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                            </svg>
                            {{ __('Pets') }}
                        </x-nav-link>

                        <x-nav-link :href="route('appointments.index')" :active="request()->routeIs('appointments.*')"
                            class="group flex items-center px-3 py-2 rounded-md transition-colors duration-150">
                            <svg class="w-5 h-5 mr-2 text-vet-primary-500 group-hover:text-vet-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ __('Appointments') }}
                        </x-nav-link>

                        <x-nav-link :href="route('visits.index')" :active="request()->routeIs('visits.*')"
                            class="group flex items-center px-3 py-2 rounded-md transition-colors duration-150">
                            <svg class="w-5 h-5 mr-2 text-vet-primary-500 group-hover:text-vet-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            {{ __('Visits') }}
                        </x-nav-link>

                        <x-nav-link :href="route('medical_records.index')" :active="request()->routeIs('medical_records.*')"
                            class="group flex items-center px-3 py-2 rounded-md transition-colors duration-150">
                            <svg class="w-5 h-5 mr-2 text-vet-primary-500 group-hover:text-vet-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            {{ __('Records') }}
                        </x-nav-link>

                        <x-nav-link :href="route('invoices.index')" :active="request()->routeIs('invoices.*')"
                            class="group flex items-center px-3 py-2 rounded-md transition-colors duration-150">
                            <svg class="w-5 h-5 mr-2 text-vet-primary-500 group-hover:text-vet-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            {{ __('Invoices') }}
                        </x-nav-link>

                        <x-nav-link :href="route('activities.index')" :active="request()->routeIs('activities.*')"
                            class="group flex items-center px-3 py-2 rounded-md transition-colors duration-150">
                            <svg class="w-5 h-5 mr-2 text-vet-primary-500 group-hover:text-vet-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('Activity') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-4">
                <!-- Dark Mode Toggle -->
                <x-dark-mode-toggle />

                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-vet-light-text-primary dark:text-vet-dark-text-primary hover:text-vet-primary-500 dark:hover:text-vet-primary-400 focus:outline-none transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-vet-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="flex items-center text-red-600 hover:text-red-700">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <!-- <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-vet-light-text-secondary dark:text-vet-dark-text-secondary hover:text-vet-primary-500 dark:hover:text-vet-primary-400">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div> -->
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')">
                    {{ __('Clients') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('invoices.index')" :active="request()->routeIs('invoices.*')">
                    {{ __('Invoices') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('medical_records.index')" :active="request()->routeIs('medical_records.*')">
                    {{ __('Medical Records') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('payments.index')" :active="request()->routeIs('payments.*')">
                    {{ __('Payments') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pets.index')" :active="request()->routeIs('pets.*')">
                    {{ __('Pets') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('vaccinations.index')" :active="request()->routeIs('vaccinations.*')">
                    {{ __('Vaccinations') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('visits.index')" :active="request()->routeIs('visits.*')">
                    {{ __('Visits') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('appointments.index')" :active="request()->routeIs('appointments.*')">
                    {{ __('Appointments') }}
                </x-responsive-nav-link>
                <x-nav-link :href="route('activities.index')" :active="request()->routeIs('activities.index')">
                    {{ __('Activity Log') }}
                </x-nav-link>
            @endif
        </div>
    </div>
</nav>
