<x-app-layout title="{{ $advertisement->title }}">

    <a href="{{ route('home') }}" class="mb-8 inline-block px-4 py-2 bg-transparent text-gray-700 border border-gray-400 rounded-lg text-sm font-medium no-underline transition duration-200 hover:bg-gray-50 hover:border-gray-500 hover:text-gray-900">
        ← Назад к списку
    </a>

    <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ $advertisement->title }}</h1>

    <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 mb-6">
        <div class="space-y-4">
            <p><strong class="font-semibold text-gray-700">Описание:</strong> <span class="text-gray-600">{{ $advertisement->description }}</span></p>
            <p><strong class="font-semibold text-gray-700">Цена:</strong> <span class="text-gray-600">{{ $advertisement->price ? number_format($advertisement->price, 0, '', ' ') . ' руб.' : 'Договорная' }}</span></p>
            <p><strong class="font-semibold text-gray-700">Категория:</strong> <span class="text-gray-600">{{ $advertisement->category->name }}</span></p>
            <p><strong class="font-semibold text-gray-700">Автор:</strong> <span class="text-gray-600">{{ $advertisement->user->name }}</span></p>
            <p><strong class="font-semibold text-gray-700">Создано:</strong> <span class="text-gray-600">{{ $advertisement->created_at->format('d.m.Y H:i') }}</span></p>
        </div>

        @if($advertisement->images && count($advertisement->images) > 0)
        <div class="mt-6">
            <h3 class="font-semibold text-gray-700 mb-3">Изображения:</h3>
            <div class="flex gap-3 flex-wrap">
                @foreach($advertisement->images as $image)
                <img src="{{ Storage::url($image) }}" alt="Изображение объявления" class="w-40 h-40 object-cover rounded-lg shadow-sm border border-gray-200">
                @endforeach
            </div>
        </div>
        @else
        <div class="flex-shrink-0 w-24 h-24 mt-4 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 text-xs">
            Нет фото
        </div>
        @endif


        @auth
        @if(Auth::id() === $advertisement->user_id || Auth::user()->isAdmin())
        <div class="flex gap-3 mt-4 pt-4 border-t border-gray-100">

            @if(Auth::user()->isAdmin() && $advertisement->status !== 'rejected')
            <form method="POST" action="{{ route('admin.advertisements.reject', $advertisement) }}" class="inline" onsubmit="return confirm('Вы уверены, что хотите отклонить объявление?');">
                @csrf
                <button type="submit" class="inline-block px-4 py-2 bg-transparent text-red-600 border border-red-300 rounded-lg text-sm font-medium transition duration-200 hover:bg-red-50 hover:border-red-400 hover:text-red-700 cursor-pointer">
                    Отклонить
                </button>
            </form>
            @elseif(Auth::user()->isAdmin() && $advertisement->status !== 'approved')
            <form method="POST" action="{{ route('admin.advertisements.approve', $advertisement) }}" class="inline" onsubmit="return confirm('Вы уверены, что хотите одобрить объявление?');">
                @csrf
                <button type="submit" class="inline-block px-4 py-2 bg-transparent text-green-600 border border-green-300 rounded-lg text-sm font-medium transition duration-200 hover:bg-green-50 hover:border-green-400 hover:text-green-700 cursor-pointer">
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

            <form method="POST" action="{{ route('advertisements.destroy', $advertisement) }}" class="inline" onsubmit="return confirm('Вы уверены, что хотите удалить объявление?');">
                @csrf @method('DELETE')
                <button type="submit" class="inline-block px-4 py-2 bg-transparent text-red-600 border border-red-300 rounded-lg text-sm font-medium transition duration-200 hover:bg-red-50 hover:border-red-400 hover:text-red-700 cursor-pointer">
                    Удалить
                </button>
            </form>
            @endif

            @if(Auth::user()->isAdmin())
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