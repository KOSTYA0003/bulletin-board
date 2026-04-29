<x-app-layout title="Мои объявления">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Мои объявления</h1>

    @if($advertisements->count() > 0)
    <x-ui.advertisement-list :advertisements="$advertisements" />
    @else
    <div class="text-center py-12">
        <p class="text-gray-400 mb-4">У вас пока нет объявлений</p>
        <a href="{{ route('advertisements.create') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-lg transition no-underline">Создать первое объявление</a>
    </div>
    @endif
</x-app-layout>