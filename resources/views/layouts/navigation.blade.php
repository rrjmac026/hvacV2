@php
use Illuminate\Support\Facades\Auth;
@endphp

<nav class="bg-gradient-to-r from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 border-b border-gray-200/80 dark:border-gray-700/80 backdrop-blur-lg z-30 fixed top-0 left-0 right-0 h-16">
    <div class="px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
        <div class="flex items-center gap-4">
            <!-- Sidebar Toggle -->
            <button @click="$store.sidebar.toggle()" 
                class="p-2 rounded-lg text-gray-500 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-800 transition-all duration-200">
                <i class="fas fa-bars text-lg"></i>
            </button>
            
            <!-- Logo -->
            <div class="flex items-center">
                <div class="w-8 h-8 bg-gradient-to-br from-vet-primary-500 to-vet-primary-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-paw text-white"></i>
                </div>
                <span class="ml-3 text-xl font-bold text-vet-primary-600 dark:text-vet-primary-400">HVAC</span>
            </div>
        </div>

        <!-- Profile Dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" 
                class="flex items-center gap-2 p-2 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all duration-200">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-vet-primary-500 to-vet-primary-600 flex items-center justify-center text-white font-semibold text-sm">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </div>
                <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
            </button>

            <div x-show="open" @click.away="open = false" x-cloak
                class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200/80 dark:border-gray-700/80 overflow-hidden"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95">
                
                <a href="{{ route('profile.edit') }}" 
                    class="flex items-center gap-2 px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 border-b border-gray-200/80 dark:border-gray-700/80">
                    <i class="fas fa-user-circle text-vet-primary-500"></i>
                    Profile Settings
                </a>

                <!-- Dark Mode Toggle -->
                <button x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }"
                    @click="darkMode = !darkMode;
                    localStorage.theme = darkMode ? 'dark' : 'light';
                    document.documentElement.classList.toggle('dark')"
                    class="w-full flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                    <template x-if="darkMode">
                        <i class="fas fa-sun mr-2"></i>
                    </template>
                    <template x-if="!darkMode">
                        <i class="fas fa-moon mr-2"></i>
                    </template>
                    <span x-text="darkMode ? 'Light Mode' : 'Dark Mode'"></span>
                </button>

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" 
                        class="flex items-center gap-2 w-full px-4 py-3 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                        <i class="fas fa-sign-out-alt"></i>
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
