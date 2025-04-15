@php
use Illuminate\Support\Facades\Route;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data
      :class="{ 'dark': localStorage.theme === 'dark' }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'VetCare') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-vet-light-bg dark:bg-vet-dark-bg">
        <!-- Navigation -->
        <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm border-b border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-gradient-to-br from-vet-primary-500 to-vet-primary-600 rounded-lg shadow-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            <div class="space-x-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-sm text-vet-primary-600 dark:text-vet-primary-400 hover:text-vet-primary-500">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-300 hover:text-vet-primary-500">Log in</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="ml-4 inline-flex items-center px-4 py-2 bg-gradient-to-r from-vet-primary-500 to-vet-primary-600 text-sm text-white rounded-lg hover:from-vet-primary-600 hover:to-vet-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-vet-primary-500 transition-all duration-150">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative min-h-screen flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-vet-light-text-primary dark:text-white leading-tight">
                            Highland Vets<br>Animal Clinic
                        </h1>
                        <p class="mt-4 text-xl text-vet-light-text-secondary dark:text-gray-300">
                            Providing comprehensive veterinary care with compassion and expertise
                        </p>
                        <div class="mt-8 flex gap-4">
                            <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-vet-primary-500 to-vet-primary-600 text-base text-white font-medium rounded-lg hover:from-vet-primary-600 hover:to-vet-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-vet-primary-500 transition-all duration-150 transform hover:scale-105">
                                Get Started
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                            <a href="#features" class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-600 text-base font-medium rounded-lg text-vet-light-text-primary dark:text-white hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-vet-primary-500 transition-all duration-150">
                                Learn More
                            </a>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-vet-primary-500 to-vet-primary-600 rounded-2xl transform rotate-3"></div>
                        <img src="{{ asset('images/hero.jpg') }}" alt="Veterinary Care" class="relative rounded-2xl shadow-xl">
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div id="features" class="py-24 bg-gray-50 dark:bg-gray-800/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-vet-light-text-primary dark:text-white">
                        Everything You Need
                    </h2>
                    <p class="mt-4 text-xl text-vet-light-text-secondary dark:text-gray-300">
                        Comprehensive tools for modern veterinary practices
                    </p>
                </div>

                <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach([
                        ['title' => 'Patient Management', 'icon' => 'M12 14l9-5-9-5-9 5 9 5z'],
                        ['title' => 'Appointment Scheduling', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                        ['title' => 'Medical Records', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                        ['title' => 'Billing & Invoicing', 'icon' => 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z'],
                        ['title' => 'Inventory Control', 'icon' => 'M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4'],
                        ['title' => 'Analytics & Reports', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z']
                    ] as $feature)
                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-r from-vet-primary-500 to-vet-primary-600 rounded-xl transform rotate-2 group-hover:rotate-1 transition-transform"></div>
                            <div class="relative p-8 bg-white dark:bg-gray-900 rounded-xl shadow-lg">
                                <div class="flex items-center justify-center w-12 h-12 bg-vet-primary-500/10 rounded-xl mb-4">
                                    <svg class="w-6 h-6 text-vet-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $feature['icon'] }}"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-vet-light-text-primary dark:text-white">
                                    {{ $feature['title'] }}
                                </h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="text-center text-gray-500 dark:text-gray-400 text-sm">
                    &copy; {{ date('Y') }} Highland Veterinary Animal Clinic. All rights reserved.
                </div>
            </div>
        </footer>
    </body>
</html>
