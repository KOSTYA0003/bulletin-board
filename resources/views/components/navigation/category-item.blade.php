<div class="relative">

    <div class="flex items-center justify-between py-2 px-3 border-b border-gray-100 hover:bg-gray-50 transition"
        style="{{ $level > 0 ? 'padding-left: ' . ($level * 16 + 12) . 'px' : '' }}">

        <a href="{{ route('categories.show', $category) }}"
            class="flex-grow text-gray-700 hover:text-indigo-600 transition no-underline {{ $level === 0 ? 'font-bold' : '' }}">
            {{ $category->name }}
        </a>

    </div>

    @if($category->has_children)
    <div class="border-l-2 border-gray-100 ml-3" style="margin-left: {{ $level * 16 + 12 }}px;">
        @foreach($category->children as $child)
        <x-navigation.category-item :category="$child" :level="$level + 1" />
        @endforeach
    </div>
    @endif

</div>