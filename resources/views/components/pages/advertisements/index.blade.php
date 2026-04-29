<x-app-layout title="Главная">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Последние объявления</h1>
    <x-ui.advertisement-list :advertisements="$advertisements" />
</x-app-layout>