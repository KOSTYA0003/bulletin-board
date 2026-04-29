@if($category->isLeaf() && $level > 0)

<option value="{{ $category->id }}"
    {{ (isset($selectedCategoryId) && $selectedCategoryId == $category->id) ? 'selected' : (old('category_id') == $category->id ? 'selected' : '') }}
    class="py-2 px-3">
    @for($i = 0; $i < $level; $i++)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@endfor{{ $category->name }}
        </option>

        @else

<option disabled class="font-bold text-gray-800 bg-gray-200 py-2 px-3">
    @for($i = 0; $i < $level; $i++)
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        @endfor
        {{ $category->name }}
        </option>

        @foreach($category->children as $child)
        <x-category-option
            :category="$child"
            :level="$level + 1"
            :selectedCategoryId="$selectedCategoryId ?? null" />
        @endforeach

        @endif