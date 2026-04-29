<x-app-layout title="Админка">

    <h1 class="text-2xl font-bold text-gray-800 mb-6">Дашборд админки</h1>

    <nav class="mb-8 p-5 bg-gray-50 rounded-xl border border-gray-200 shadow-sm">
        <h2 class="text-lg font-semibold text-gray-700 mb-3">Управление</h2>
        <div class="flex flex-wrap gap-3">

            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-1 px-4 py-2 bg-emerald-50 text-emerald-700 rounded-lg hover:bg-emerald-100 transition no-underline text-sm font-medium">
                👥 Пользователи
            </a>
            <a href="{{ route('admin.advertisements.index') }}" class="inline-flex items-center gap-1 px-4 py-2 bg-amber-50 text-amber-700 rounded-lg hover:bg-amber-100 transition no-underline text-sm font-medium">
                📢 Объявления
            </a>
        </div>
    </nav>

    <x-ui.admin-stats :stats="$stats" />

    <div class="mt-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Последние объявления</h2>
        <x-ui.advertisement-list :advertisements="$recentAds" />
    </div>

</x-app-layout>