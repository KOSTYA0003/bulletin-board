<x-app-layout title="Редактирование объявления">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Редактирование объявления: {{ $advertisement->title }}</h1>

    <div class="mb-4">
        <a href="{{ route('admin.advertisements.index') }}" class="inline-block px-4 py-2 bg-transparent text-gray-700 border border-gray-400 rounded-lg text-sm font-medium no-underline transition duration-200 hover:bg-gray-50 hover:border-gray-500 hover:text-gray-900">
            ← Назад к списку объявлений
        </a>
    </div>

    <form action="{{ route('admin.advertisements.update', $advertisement) }}" method="POST" class="bg-white rounded-xl shadow-md border border-gray-100 p-6 space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold text-gray-700 mb-2">Заголовок:</label>
            <input type="text" name="title" value="{{ old('title', $advertisement->title) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block font-semibold text-gray-700 mb-2">Описание:</label>
            <textarea name="description" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $advertisement->description) }}</textarea>
            @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block font-semibold text-gray-700 mb-2">Цена:</label>
            <input type="number" name="price" value="{{ old('price', $advertisement->price) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            @error('price')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block font-semibold text-gray-700 mb-2">Категория:</label>
            <select name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                <option value="">Выберите категорию</option>
                @foreach($categories as $category)
                <x-category-option :category="$category" :level="0" :selectedCategoryId="$advertisement->category_id" />
                @endforeach
            </select>
            @error('category_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block font-semibold text-gray-700 mb-2">Статус:</label>
            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                <option value="pending" {{ $advertisement->status == 'pending' ? 'selected' : '' }}>На модерации</option>
                <option value="approved" {{ $advertisement->status == 'approved' ? 'selected' : '' }}>Одобрено</option>
                <option value="rejected" {{ $advertisement->status == 'rejected' ? 'selected' : '' }}>Отклонено</option>
            </select>
            @error('status')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-lg transition cursor-pointer">Сохранить изменения</button>
            <a href="{{ route('admin.advertisements.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2.5 rounded-lg transition text-center no-underline">Отмена</a>
        </div>
    </form>
</x-app-layout>