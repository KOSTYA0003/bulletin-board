<x-layout>
    <div class="max-w-md mx-auto mt-12 px-4">
        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-8">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">{{ __('Login') }}</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block font-medium text-gray-700 mb-2">{{ __('Email Address') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50">
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block font-medium text-gray-700 mb-2">{{ __('Password') }}</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50">
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="text-sm text-gray-600">{{ __('Remember Me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:text-indigo-800 hover:underline">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                </div>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg transition cursor-pointer">
                    {{ __('Login') }}
                </button>
            </form>
        </div>
    </div>
</x-layout>