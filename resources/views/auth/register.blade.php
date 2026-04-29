<x-layout>
    <div class="max-w-md mx-auto mt-12 px-4">
        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-8">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Регистрация</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label class="block font-medium text-gray-700 mb-2">Имя:</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50">
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-gray-700 mb-2">Email:</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50">
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-gray-700 mb-2">Пароль:</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50">
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block font-medium text-gray-700 mb-2">Подтвердите пароль:</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50">
                </div>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg transition cursor-pointer">
                    Зарегистрироваться
                </button>
            </form>
        </div>
    </div>
</x-layout>