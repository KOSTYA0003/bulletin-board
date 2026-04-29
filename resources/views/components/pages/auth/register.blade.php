<x-app-layout title="Регистрация">
    <div class="max-w-md mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Регистрация</h1>

        @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}" class="bg-white rounded-xl shadow-md border border-gray-100 p-6 space-y-5">
            @csrf

            <div>
                <label class="block font-semibold text-gray-700 mb-2">Имя:</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-2">Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-2">Пароль:</label>
                <input type="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                @error('password')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-2">Подтверждение пароля:</label>
                <input type="password" name="password_confirmation" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="flex items-center">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <span class="text-sm text-gray-600">Запомнить меня</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 rounded-lg transition cursor-pointer">Зарегистрироваться</button>
        </form>

        <p class="text-center text-gray-600 mt-6">
            Уже есть аккаунт?
            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 hover:underline">Войти</a>
        </p>
    </div>
</x-app-layout>