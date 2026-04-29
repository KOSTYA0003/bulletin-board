<x-app-layout title="Редактирование пользователя">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Редактирование пользователя: {{ $user->name }}</h1>

    @if(session('success'))
    <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-lg shadow-sm mb-4">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm mb-4">❌ {{ session('error') }}</div>
    @endif

    <div class="mb-4">
        <a href="{{ route('admin.users.index') }}" class="text-indigo-600 hover:text-indigo-800 hover:underline inline-flex items-center gap-1">
            ← Назад к списку пользователей
        </a>
    </div>

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="bg-white rounded-xl shadow-md border border-gray-100 p-6 space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold text-gray-700 mb-2">Имя:</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block font-semibold text-gray-700 mb-2">Email:</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block font-semibold text-gray-700 mb-2">Телефон:</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            @error('phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="bg-gray-50 p-4 rounded-lg space-y-2 text-sm">
            <h3 class="font-semibold text-gray-700 mb-2">Информация о пользователе:</h3>
            <p><strong>Роль:</strong> <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $user->isAdmin() ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-700' }}">{{ $user->isAdmin() ? 'Админ' : 'Пользователь' }}</span></p>
            <p><strong>Статус:</strong> <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $user->isBanned() ? 'bg-red-100 text-red-800' : 'bg-emerald-100 text-emerald-800' }}">{{ $user->isBanned() ? 'Забанен' : 'Активен' }}</span></p>
            <p><strong>ID:</strong> {{ $user->id }}</p>
            <p><strong>Зарегистрирован:</strong> {{ $user->created_at->format('d.m.Y H:i') }}</p>
            <p><strong>Обновлен:</strong> {{ $user->updated_at->format('d.m.Y H:i') }}</p>
            @if($user->email_verified_at)
            <p><strong>Email подтвержден:</strong> {{ $user->email_verified_at->format('d.m.Y H:i') }}</p>
            @else
            <p><strong>Email подтвержден:</strong> <span class="text-red-600">Нет</span></p>
            @endif
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-lg transition cursor-pointer">Сохранить изменения</button>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2.5 rounded-lg transition text-center no-underline">Отмена</a>
        </div>
    </form>
</x-app-layout>