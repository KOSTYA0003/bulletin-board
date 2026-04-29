<x-app-layout title="Все объявления">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Все объявления</h1>

    @if($advertisements->count() > 0)
    <x-ui.advertisement-list :advertisements="$advertisements" />
    <div class="mt-6">
        {{ $advertisements->links() }}
    </div>
    @else
    <div class="text-center py-12 text-gray-400">Пока нет объявлений</div>
    @endif
</x-app-layout>