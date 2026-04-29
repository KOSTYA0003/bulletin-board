<div class="space-y-4">
    @forelse($advertisements as $advertisement)

    <div class="relative flex flex-col bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition group min-h-[200px]">

        <div class="flex gap-4">
            <div class="flex-1 flex flex-col">
                <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $advertisement->title }}</h3>
                <p class="text-gray-600 mb-3">{{ Str::limit($advertisement->description, 100) }}</p>

                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-gray-700 mb-4">
                    <p><strong>Цена:</strong> {{ $advertisement->price ? number_format($advertisement->price, 0, '', ' ') . ' руб.' : 'Договорная' }}</p>
                    <p><strong>Категория:</strong> {{ $advertisement->category->name }}</p>
                </div>

                <div class="mt-auto">
                    <a href="{{ route('advertisements.show', $advertisement) }}"
                        class="inline-block px-4 py-2 bg-transparent text-slate-600 border border-slate-300 rounded-lg text-sm font-medium no-underline transition duration-200 
                          hover:bg-slate-50 hover:border-slate-400 hover:text-slate-800">
                        Подробнее →
                    </a>
                </div>
            </div>

            @if($advertisement->images && count($advertisement->images) > 0)
            <div class="flex-shrink-0 flex gap-2 items-center">
                @foreach(array_slice($advertisement->images, 0, 3) as $image)
                <img src="{{ Storage::url($image) }}" alt="{{ $advertisement->title }}"
                    class="w-24 h-24 object-cover rounded-lg border border-gray-200">
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

        @auth
        @if(Auth::id() === $advertisement->user_id || Auth::user()->isAdmin())
        <div class="flex gap-3 mt-6 pt-4 border-t border-gray-100">

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

    @empty

    <p class="text-center text-gray-400 py-12">Объявлений пока нет</p>

    @endforelse

    @if(method_exists($advertisements, 'hasPages') && $advertisements->hasPages())
    <div class="mt-6">
        {{ $advertisements->links() }}
    </div>
    @endif
</div>