<x-app-layout title="Модерация объявлений">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Модерация объявлений</h1>

    <div class="mb-4">
        <a href="{{ route('admin.dashboard') }}" class="inline-block px-4 py-2 bg-transparent text-gray-700 border border-gray-400 rounded-lg text-sm font-medium no-underline transition duration-200 hover:bg-gray-50 hover:border-gray-500 hover:text-gray-900">
            ← Назад в админку
        </a>
    </div>

    <div class="space-y-4">
        @forelse($advertisements as $advertisement)
        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-5">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $advertisement->title }}</h3>
                    <p class="text-gray-600 mb-3">{{ Str::limit($advertisement->description, 150) }}</p>

                    <div class="flex flex-wrap gap-4 text-sm text-gray-500 mb-4">
                        <span><strong class="font-semibold">Цена:</strong> {{ $advertisement->price ? number_format($advertisement->price, 0, '', ' ') . ' руб.' : 'Договорная' }}</span>
                        <span><strong class="font-semibold">Категория:</strong> {{ $advertisement->category->name }}</span>
                        <span><strong class="font-semibold">Автор:</strong> {{ $advertisement->user->name }}</span>
                        <span><strong class="font-semibold">Статус:</strong>
                            @if($advertisement->status === 'approved')
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Одобрено</span>
                            @elseif($advertisement->status === 'rejected')
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Отклонено</span>
                            @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">На модерации</span>
                            @endif
                        </span>
                    </div>

                    <a href="{{ route('admin.advertisements.show', $advertisement) }}" class="inline-block px-4 py-2 bg-transparent text-slate-600 border border-slate-300 rounded-lg text-sm font-medium no-underline transition duration-200 hover:bg-slate-50 hover:border-slate-400 hover:text-slate-800">
                        Подробнее →
                    </a>
                </div>

                @if($advertisement->images && count($advertisement->images) > 0)
                <div class="flex-shrink-0 flex gap-2 items-center">
                    @foreach(array_slice($advertisement->images, 0, 3) as $image)
                    <img src="{{ Storage::url($image) }}" alt="{{ $advertisement->title }}" class="w-24 h-24 object-cover rounded-lg border border-gray-200">
                    @endforeach
                    @if(count($advertisement->images) > 3)
                    <div class="w-24 h-24 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center text-gray-500 text-sm font-medium">
                        +{{ count($advertisement->images) - 3 }}
                    </div>
                    @endif
                </div>
                @else
                <div class="flex-shrink-0 w-24 h-24 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 text-xs">
                    Нет фото
                </div>
                @endif
            </div>

            <div class="flex flex-wrap gap-3 mt-4 pt-3 border-t border-gray-100">
                @auth
                @if(Auth::user()->isAdmin())
                @if($advertisement->status !== 'approved')
                <form method="POST" action="{{ route('admin.advertisements.approve', $advertisement) }}" class="inline" onsubmit="return confirm('Одобрить объявление?');">
                    @csrf
                    <button type="submit" class="inline-block px-4 py-2 bg-transparent text-emerald-600 border border-emerald-300 rounded-lg text-sm font-medium transition duration-200 hover:bg-emerald-50 hover:border-emerald-400 hover:text-emerald-700 cursor-pointer">
                        Одобрить
                    </button>
                </form>
                @endif

                @if($advertisement->status !== 'rejected')
                <form method="POST" action="{{ route('admin.advertisements.reject', $advertisement) }}" class="inline" onsubmit="return confirm('Отклонить объявление?');">
                    @csrf
                    <button type="submit" class="inline-block px-4 py-2 bg-transparent text-red-600 border border-red-300 rounded-lg text-sm font-medium transition duration-200 hover:bg-red-50 hover:border-red-400 hover:text-red-700 cursor-pointer">
                        Отклонить
                    </button>
                </form>
                @endif

                <a href="{{ route('admin.advertisements.edit', $advertisement) }}" class="inline-block px-4 py-2 bg-transparent text-indigo-600 border border-indigo-300 rounded-lg text-sm font-medium no-underline transition duration-200 hover:bg-indigo-50 hover:border-indigo-400 hover:text-indigo-700">
                    Редактировать
                </a>

                <form method="POST" action="{{ route('advertisements.destroy', $advertisement) }}" class="inline" onsubmit="return confirm('Удалить объявление?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="inline-block px-4 py-2 bg-transparent text-red-600 border border-red-300 rounded-lg text-sm font-medium transition duration-200 hover:bg-red-50 hover:border-red-400 hover:text-red-700 cursor-pointer">
                        Удалить
                    </button>
                </form>

                @elseif(Auth::id() === $advertisement->user_id && Auth::user()->isUser())
                <a href="{{ route('advertisements.edit', $advertisement) }}" class="inline-block px-4 py-2 bg-transparent text-indigo-600 border border-indigo-300 rounded-lg text-sm font-medium no-underline transition duration-200 hover:bg-indigo-50 hover:border-indigo-400 hover:text-indigo-700">
                    Редактировать
                </a>

                <form method="POST" action="{{ route('advertisements.destroy', $advertisement) }}" class="inline" onsubmit="return confirm('Удалить объявление?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="inline-block px-4 py-2 bg-transparent text-red-600 border border-red-300 rounded-lg text-sm font-medium transition duration-200 hover:bg-red-50 hover:border-red-400 hover:text-red-700 cursor-pointer">
                        Удалить
                    </button>
                </form>
                @endif
                @endauth
            </div>
        </div>
        @empty
        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-12 text-center">
            <p class="text-gray-400">Объявлений пока нет</p>
        </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $advertisements->links() }}
    </div>
</x-app-layout>