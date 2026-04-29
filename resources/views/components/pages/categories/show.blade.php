<x-app-layout title="{{ $category->name }}">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Объявления в категории: {{ $category->name }}</h1>

    <nav class="flex items-center flex-wrap text-sm text-slate-600 mb-8 bg-slate-50 p-3 rounded-lg border border-slate-100">
        @foreach($category->ancestors() as $ancestor)
        <div class="flex items-center">
            <a href="{{ route('categories.show', $ancestor) }}"
                class="hover:text-indigo-600 transition-colors duration-200">
                {{ $ancestor->name }}
            </a>
            <svg class="w-4 h-4 mx-2 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </div>
        @endforeach
        <span class="text-slate-600 font-medium">{{ $category->name }}</span>
    </nav>


    <x-ui.advertisement-list :advertisements="$advertisements" />
</x-app-layout>