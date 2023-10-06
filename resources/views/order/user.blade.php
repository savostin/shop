<x-app-layout>
    @section('title', 'Your Orders')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @yield('title')
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 flex flex-col">
                    @foreach ($orders as $order)
                        <div class="flex flex-row items-center shadow-sm sm:rounded-lg border w-full">
                            <p class="text-left mr-4 ml-4">{{ $order->created_at }}</p>
                            <a href="{{ route('order.view', ['id' => $order->id]) }}"
                                class="flex flex-grow flex-col p-2 underline">
                                @foreach ($order->items as $item)
                                    <p class="font-semibold text-sm">{{ $item->product }}, {{ $item->size }},
                                        {{ $item->colour }}</p>
                                @endforeach
                            </a>
                            <p class="text-right mr-4">{{ $order->status }}</p>
                            <p class="text-right mr-4">{{ $order->amount }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
