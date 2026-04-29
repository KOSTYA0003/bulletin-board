<x-app-layout title="Создать объявление">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Создать новое объявление</h1>

    @if($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm mb-6">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('advertisements.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl shadow-md border border-gray-100 p-6 space-y-5">
        @csrf

        <div>
            <label class="block font-semibold text-gray-700 mb-2">Заголовок:</label>
            <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block font-semibold text-gray-700 mb-2">Описание:</label>
            <textarea name="description" required rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
            @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block font-semibold text-gray-700 mb-2">Цена (руб.):</label>
            <input type="number" name="price" value="{{ old('price') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            @error('price')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block font-semibold text-gray-700 mb-2">Категория:</label>
            <select name="category_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                <option value="">Выберите категорию</option>
                @foreach($categories as $category)
                <x-category-option :category="$category" :level="0" />
                @endforeach
            </select>
            @error('category_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block font-semibold text-gray-700 mb-2">Изображения:</label>
            <input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/jpg,image/gif" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
            <p class="text-xs text-gray-400 mt-1">Можно выбрать несколько файлов (максимум 2MB каждый)</p>
            @error('images.*')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-lg transition cursor-pointer">Создать объявление</button>
        </div>
    </form>
</x-app-layout>