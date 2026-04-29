<nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-wrap items-center justify-between gap-4">

        <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800 hover:text-gray-600 transition no-underline">
            Доска объявлений
        </a>

        <div class="flex flex-wrap items-center gap-6 flex-grow">
            <div class="relative categories-dropdown group">
                <button class="bg-transparent border-none cursor-pointer text-gray-600 hover:text-gray-900 transition py-2">
                    Категории ▼
                </button>

                <div class="dropdown-menu invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-200 absolute top-full 
                left-0 bg-white border border-gray-200 rounded-xl shadow-lg z-50 min-w-[500px] max-h-[550px] overflow-y-auto mt-1 p-4">
                    @foreach($rootCategories as $category)
                    <x-navigation.category-item :category="$category" :level="0" />
                    @endforeach
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-4">
            @auth
            <a href="{{ route('advertisements.create') }}" class="text-gray-600 hover:text-gray-900 transition no-underline">
                Создать объявление
            </a>
            <a href="{{ route('advertisements.my') }}" class="text-gray-600 hover:text-gray-900 transition no-underline">
                Мои объявления
            </a>

            @if(!Auth::user()->isEmailVerified())
            <form method="POST" action="{{ route('verification.send') }}" class="inline">
                @csrf
                <button type="submit" class="bg-amber-100 text-amber-700 border border-amber-200 px-4 py-2 rounded-lg text-sm font-medium cursor-pointer hover:bg-amber-200 transition">
                    📧 Подтвердить email
                </button>
            </form>
            @else
            <span class="text-emerald-600 text-sm font-medium">✓ Email подтвержден</span>
            @endif

            @if(Auth::user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}" class="text-rose-600 hover:text-rose-900 transition no-underline font-medium">
                Админка
            </a>
            @endif

            <div class="pl-4 border-l border-gray-300">
                <span class="text-sm text-gray-500">Вы:</span>
                <span class="ml-1 text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="bg-transparent border-none cursor-pointer text-gray-600 hover:text-gray-900 transition">
                    Выйти
                </button>
            </form>

            @else
            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 transition no-underline">
                Войти
            </a>
            <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900 transition no-underline">
                Регистрация
            </a>
            @endauth
        </div>
    </div>
</nav>