<x-app-layout>
    @section('title', 'Your Order')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @yield('title')
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 flex flex-col">
                    @foreach ($order->items as $item)
                        <div class="flex flex-row items-center shadow-sm sm:rounded-lg border w-full">
                            <div class="flex flex-grow flex-col p-2 w-3/4">
                                <p class="font-semibold text-sm">{{ $item->product }}</p>
                                <p class="font-semibold text-sm">{{ $item->size }}</p>
                                <p class="font-semibold text-sm">{{ $item->colour }}</p>
                            </div>
                            <p class="text-right pr-4">{{ $item->price }}</p>
                            <p class="text-right pr-4">{{ $item->qty }}</p>
                            <p class="text-right pr-4">{{ $item->amount }}</p>
                        </div>
                    @endforeach
                    <div class="text-right text-lg border-t-4 border-indigo-500 mt-4">
                        {{ __('Total:') }} {{ $order->amount }}
                    </div>
                    @if ($order->status == 'UNPAID')
                        <form method="post" action="{{ route('order.update', ['id' => $order->id]) }}">
                            @csrf
                            @method('patch')
                            <div class="">
                                <p>{{ __('Shipping address:') }}</p>
                                <textarea required="true" name="shipment" class="w-full">{{ old('shipment') ?? $order->shipment }}</textarea>
                            </div>
                            <div class="text-right">
                                <button
                                    class="ml-2 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">{{ __('Checkout') }}</button>
                            </div>
                        </form>
                    @else
                        <div class="">
                            <p>{{ __('Shipping address:') }} {{ $order->shipment }}</p>
                        </div>
                        <div class="text-full text-center bg-green-200">{{ __('PAID IN FULL') }} </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</x-app-layout>
