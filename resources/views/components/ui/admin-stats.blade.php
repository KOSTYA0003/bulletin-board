<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4 my-6">
    @foreach($stats as $key => $value)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 text-center hover:shadow-md transition">
        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">
            {{ ucfirst(str_replace('_', ' ', $key)) }}
        </h3>
        <p class="text-2xl font-bold text-gray-800">{{ $value }}</p>
    </div>
    @endforeach
</div>