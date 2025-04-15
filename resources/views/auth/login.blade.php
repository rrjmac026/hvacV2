@php
use Illuminate\Support\Facades\Route;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Highland Vets</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-vet-primary-50 to-white dark:from-gray-900 dark:to-gray-800 flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white dark:bg-gray-900 rounded-xl shadow-lg p-8">
        <!-- Logo -->
        <div class="text-center mb-8">
            <img src="{{ asset('images/hero.jpg') }}" class="mx-auto h-20 w-20 rounded-lg shadow" alt="HVAC Logo">
            <h1 class="text-3xl font-bold text-vet-primary-600 dark:text-white mt-4">Highland Vets</h1>
            <p class="text-gray-500 dark:text-gray-300 mt-1">Welcome back! Please sign in.</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                <input type="email" name="email" id="email" required autofocus value="{{ old('email') }}"
                    class="mt-1 block w-full px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-vet-primary-500">
                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                <input type="password" name="password" id="password" required
                    class="mt-1 block w-full px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-vet-primary-500">
                @error('password')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me & Forgot -->
            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                    <input type="checkbox" name="remember" class="mr-2 rounded text-vet-primary-600 border-gray-300 dark:border-gray-600">
                    Remember me
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-vet-primary-600 hover:underline dark:text-vet-primary-400">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Submit -->
            <div>
                <button type="submit"
                    class="w-full bg-vet-primary-600 hover:bg-vet-primary-700 text-white font-semibold py-3 px-4 rounded-lg shadow-md transition duration-200 ease-in-out">
                    Sign in
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600 dark:text-gray-300">Don't have an account?
                <a href="{{ route('register') }}" class="font-semibold text-vet-primary-600 hover:underline dark:text-vet-primary-400">Register now</a>
            </p>
        </div>
    </div>

</body>
</html>
