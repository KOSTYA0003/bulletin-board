<x-app-layout title="Просмотр объявления - Админка">
    <a href="{{ route('admin.advertisements.index') }}" class="inline-block px-4 py-2 bg-transparent mb-6 text-gray-700 border border-gray-400 rounded-lg text-sm font-medium no-underline transition duration-200 hover:bg-gray-50 hover:border-gray-500 hover:text-gray-900">
        ← Назад к списку
    </a>

    <h1 class="text-2xl font-bold text-gray-800 mb-6">Просмотр объявления (Админка)</h1>

    <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">{{ $advertisement->title }}</h2>

        @if($advertisement->images && count($advertisement->images) > 0)
        <div class="mb-6">
            <h3 class="font-semibold text-gray-700 mb-3">Изображения:</h3>
            <div class="flex gap-3 flex-wrap">
                @foreach($advertisement->images as $image)
                <img src="{{ Storage::url($image) }}" alt="Изображение объявления"
                    class="w-32 h-32 object-cover rounded-lg shadow-sm border border-gray-200">
                @endforeach
            </div>
        </div>
        @else
        <div class="mb-6">
            <p class="text-gray-400">Нет фото</p>
        </div>
        @endif

        <div class="space-y-3 text-gray-700">
            <p><strong class="font-semibold">Описание:</strong> {{ $advertisement->description }}</p>
            <p><strong class="font-semibold">Цена:</strong> {{ $advertisement->price ? number_format($advertisement->price, 0, '', ' ') . ' руб.' : 'Договорная' }}</p>
            <p><strong class="font-semibold">Категория:</strong> {{ $advertisement->category->name }}</p>
            <p><strong class="font-semibold">Автор:</strong> {{ $advertisement->user->name }} ({{ $advertisement->user->email }})</p>
            <p><strong class="font-semibold">Статус:</strong>
                @if($advertisement->status === 'approved')
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Одобрено</span>
                @elseif($advertisement->status === 'rejected')
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Отклонено</span>
                @else
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">На модерации</span>
                @endif
            </p>
            <p><strong class="font-semibold">Создано:</strong> {{ $advertisement->created_at->format('d.m.Y H:i') }}</p>
        </div>

        @auth
        @if(Auth::id() === $advertisement->user_id || Auth::user()->isAdmin())
        <div class="flex flex-wrap gap-3 mt-4">
            @if(Auth::user()->isAdmin() && $advertisement->status !== 'rejected')
            <form method="POST" action="{{ route('admin.advertisements.reject', $advertisement) }}" class="inline" onsubmit="return confirm('Вы уверены, что хотите отклонить объявление?');">
                @csrf
                <button type="submit" class="inline-block px-4 py-2 bg-transparent text-red-600 border border-red-300 rounded-lg text-sm font-medium transition duration-200 hover:bg-red-50 hover:border-red-400 hover:text-red-700 cursor-pointer">
                    Отклонить
                </button>
            </form>
            @endif

            @if(Auth::user()->isAdmin() && $advertisement->status !== 'approved')
            <form method="POST" action="{{ route('admin.advertisements.approve', $advertisement) }}" class="inline" onsubmit="return confirm('Вы уверены, что хотите одобрить объявление?');">
                @csrf
                <button type="submit" class="inline-block px-4 py-2 bg-transparent text-emerald-600 border border-emerald-300 rounded-lg text-sm font-medium transition duration-200 hover:bg-emerald-50 hover:border-emerald-400 hover:text-emerald-700 cursor-pointer">
                    Одобрить
                </button>
            </form>
            @endif

            @if(Auth::user()->isAdmin())
            <a href="{{ route('admin.advertisements.edit', $advertisement) }}" class="inline-block px-4 py-2 bg-transparent text-indigo-600 border border-indigo-300 rounded-lg text-sm font-medium no-underline transition duration-200 hover:bg-indigo-50 hover:border-indigo-400 hover:text-indigo-700">
                Редактировать
            </a>
            @endif

            @if(Auth::id() === $advertisement->user_id && Auth::user()->isUser())
            <a href="{{ route('advertisements.edit', $advertisement) }}" class="inline-block px-4 py-2 bg-transparent text-indigo-600 border border-indigo-300 rounded-lg text-sm font-medium no-underline transition duration-200 hover:bg-indigo-50 hover:border-indigo-400 hover:text-indigo-700">
                Редактировать
            </a>
            @endif

            @if((Auth::id() === $advertisement->user_id && Auth::user()->isUser()) || Auth::user()->isAdmin())
            <form method="POST" action="{{ route('advertisements.destroy', $advertisement) }}" class="inline" onsubmit="return confirm('Вы уверены, что хотите удалить объявление?');">
                @csrf @method('DELETE')
                <button type="submit" class="inline-block px-4 py-2 bg-transparent text-red-600 border border-red-300 rounded-lg text-sm font-medium transition duration-200 hover:bg-red-50 hover:border-red-400 hover:text-red-700 cursor-pointer">
                    Удалить
                </button>
            </form>
            @endif
        </div>

        @endif
        @endauth
    </div>



</x-app-layout>