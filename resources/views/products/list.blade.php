<x-app-layout>
    @section('title', 'Our Products')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @yield('title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 gap-2 grid sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5">
                    @foreach ($products as $product)
                        <a href="{{ route('details', $product->id) }}"
                            class="flex flex-row shadow-sm sm:rounded-lg border">
                            <div class="w-1/4 h-full shadow-sm sm:rounded-lg">
                                <img
                                    src="{{ $product->image ? '/build/assets/' . $product->image : '/build/assets/product.png' }}" />
                            </div>
                            <div class="flex flex-col p-2 w-3/4">
                                <h4 class="font-semibold flex-grow text-sm">{{ $product->name }}</h4>
                                <p class="text-right">&pound; {{ $product->priceString }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
