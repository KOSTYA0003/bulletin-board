<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
    @foreach($categories as $category)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition">
        <h3 class="text-lg font-bold text-gray-800 mb-2">
            <a href="{{ route('categories.show', $category) }}" class="hover:text-indigo-600 transition no-underline text-gray-800">
                {{ $category->name }}
            </a>
        </h3>
        <p class="text-sm text-gray-500 mb-2">Объявлений: {{ $category->advertisements_count }}</p>
        @if($category->description)
        <p class="text-gray-600 text-sm">{{ $category->description }}</p>
        @endif
    </div>
    @endforeach
</div>