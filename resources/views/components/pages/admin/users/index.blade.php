<x-app-layout title="Управление пользователями">

    <div class="mb-4">
        <a href="{{ route('admin.dashboard') }}" class="inline-block px-4 py-2 bg-transparent text-gray-700 border border-gray-400 rounded-lg text-sm font-medium no-underline transition duration-200 hover:bg-gray-50 hover:border-gray-500 hover:text-gray-900">
            ← Назад в админку
        </a>
    </div>

    <h1 class="text-2xl font-bold text-gray-800 mb-6">Управление пользователями</h1>

    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">ID</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Имя</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Email</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Роль</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Статус</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border-t border-gray-100 hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm">{{ $user->id }}</td>
                        <td class="px-4 py-3 text-sm font-medium">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-sm">{{ $user->email }}</td>
                        <td class="px-4 py-3 text-sm">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $user->isAdmin() ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-700' }}">
                                {{ $user->isAdmin() ? 'Админ' : 'Пользователь' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $user->isBanned() ? 'bg-red-100 text-red-800' : 'bg-emerald-100 text-emerald-800' }}">
                                {{ $user->isBanned() ? 'Забанен' : 'Активен' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex flex-col gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-gray-500 hover:text-gray-700 no-underline text-sm">
                                    ✏️ Редактировать
                                </a>

                                @if($user->id !== auth()->id())
                                @if($user->isBanned())
                                <form action="{{ route('admin.users.unban', $user) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-emerald-600 hover:text-emerald-700 cursor-pointer bg-transparent border-none text-sm text-left">
                                        🔓 Разбанить
                                    </button>
                                </form>
                                @else
                                <form action="{{ route('admin.users.ban', $user) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-700 cursor-pointer bg-transparent border-none text-sm text-left">
                                        🔒 Забанить
                                    </button>
                                </form>
                                @endif
                                @endif

                                @if($user->id !== auth()->id())
                                @if(!$user->isAdmin())
                                <form action="{{ route('admin.users.make-admin', $user) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-indigo-600 hover:text-indigo-700 cursor-pointer bg-transparent border-none text-sm text-left">
                                        👑 Сделать админом
                                    </button>
                                </form>
                                @else
                                <form action="{{ route('admin.users.make-user', $user) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-amber-600 hover:text-amber-700 cursor-pointer bg-transparent border-none text-sm text-left">
                                        👤 Сделать юзером
                                    </button>
                                </form>
                                @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>

    <div class="mt-8 p-5 bg-white rounded-xl shadow-md border border-gray-100">
        <h3 class="font-semibold text-gray-700 mb-3">Статистика:</h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
            <p>Всего пользователей: <strong>{{ $users->total() }}</strong></p>
            <p>Администраторов: <strong>{{ $users->where('role', 'admin')->count() }}</strong></p>
            <p>Забаненных: <strong>{{ $users->where('is_banned', true)->count() }}</strong></p>
        </div>
    </div>
</x-app-layout>