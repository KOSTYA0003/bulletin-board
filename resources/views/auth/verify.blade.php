<x-layout>
    <div class="max-w-md mx-auto mt-12 px-4">
        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-8 text-center">
            <div class="text-5xl mb-4">📧</div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ __('Verify Your Email Address') }}</h2>

            @if (session('resent'))
            <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-lg mb-6">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
            @endif

            <p class="text-gray-600 mb-4">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
            <p class="text-gray-600 mb-6">{{ __('If you did not receive the email') }},</p>

            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="text-indigo-600 hover:text-indigo-800 font-medium hover:underline">
                    {{ __('click here to request another') }}
                </button>
            </form>
        </div>
    </div>
</x-layout>