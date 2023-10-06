<x-app-layout>
    @section('title', 'Shopping Cart')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @yield('title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 flex flex-col">
                    @if (count($cart->items))
                        @foreach ($cart->items as $item)
                            <div class="grid items-center gap-2 shadow-sm sm:rounded-lg border w-full"
                                style="grid-template-columns: 1fr 9fr 1fr 1fr 1fr">
                                <div class="w-16 h-full shadow-sm sm:rounded-lg">
                                    <a href="{{ route('details', $item->variation->product) }}">
                                        <img
                                            src="{{ $item->variation->image ? '/build/assets/' . $item->variation->image : ($item->variation->product->image ? '/build/assets/' . $item->variation->product->image : '/build/assets/product.png') }}" />
                                    </a>
                                </div>
                                <div class="flex flex-grow flex-col p-2 w-3/4">
                                    <a href="{{ route('details', $item->variation->product) }}"
                                        class="font-semibold flex-grow text-sm">{{ $item->variation->product->name }}</a>
                                    <p class="font-semibold text-sm">{{ $item->variation->size }}</p>
                                    <p class="font-semibold text-sm">{{ $item->variation->colour }}</p>
                                </div>
                                <p class="text-right pr-4">{{ $item->variation->priceString }}</p>
                                <input type="number" class="text-right mr-4 w-12" disabled value="{{ $item->qty }}">
                                <p class="text-right mr-4">{{ $item->amountString }}</p>
                            </div>
                        @endforeach
                        <div class="text-right text-lg border-t-4 border-indigo-500 mt-4">
                            {{ __('Total:') }} {{ $cart->amountString }}
                        </div>
                        <div class="text-right">
                            <a href="{{ route('checkout') }}"
                                class="ml-2 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">{{ __('Checkout') }}</a>
                        </div>
                    @else
                        {{ __('Your shopping cart is empty.') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
