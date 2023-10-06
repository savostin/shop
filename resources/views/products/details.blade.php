<x-app-layout>
    @section('title',$product->name)
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @yield('title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="flex flex-row shadow-sm sm:rounded-lg border">
                    <div class="w-1/4 h-full shadow-sm sm:rounded-lg">
                        <img
                            id="photo" src="{{ $product->image ? '/build/assets/'.$product->image : '/build/assets/product.png' }}" />
                    </div>
                    <form action="{{ route('cart.add') }}" method="POST" class="flex flex-col p-2 w-3/4">
                        @csrf
                        @method('patch')
                        <p class="font-semibold flex-grow">{{ $product->description }}</p>
                        <div class="flex flex-row items-center justify-between gap-2">
                            <div>
                                {{ __('Size: ') }}
                                <select onChange="setVariants(this)" id="size">
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size }}">{{ $size }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                {{ __('Colour: ') }}
                                <select onChange="setPriceAndImage()" id="colour">
                                    @foreach ($colours as $colour)
                                        <option value="{{ $colour }}">{{ $colour }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span id="price"></span>
                            <input type="hidden" name="product" value="{{ $product->id }}" />
                            <input type="hidden" name="variation" id="variation" value="" />
                            <label class="ml-4" for="qty">{{ __('Qty:') }}</label> <input type="number"
                                id="qty" min="1" name="qty" value="1" class="w-16" />
                            <button id="add"
                                class="ml-2 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">{{ __('Add to cart') }}</button>
                            @if (session('status') === 'item-added')
                                <p x-data="{ show: true }" x-show="show" class="fixed top-0 right-0 bg-green-500 p-4"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    x-init="setTimeout(() => show = false, 2000)">{{ __('Item added to you cart') }}</p>
                            @endif

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const variants = {{ Js::from($product->variationsJSON) }};
        const $sizes = document.getElementById('size');
        const $colours = document.getElementById('colour');
        const $price = document.getElementById('price');
        const $photo = document.getElementById('photo');
        const $variation = document.getElementById('variation');
        const $add = document.getElementById('add');
        const $qty = document.getElementById('qty');
        let variation = false;

        function setVariants($select) {
            const $other = $select == $sizes ? $colours : $sizes;
            const name_from = $select == $sizes ? 'size' : 'colour';
            const name_to = $select == $sizes ? 'colour' : 'size';
            const vars = new Set(variants.filter(i => i[name_from] == $select.value).map(i => i[name_to]));
            let firstEnabled = -1;
            [].forEach.call($other.options, (i, j) => {
                if (i.value && vars.has(i.value)) {
                    i.removeAttribute('disabled')
                    if (firstEnabled == -1) {
                    firstEnabled = j;
                    }
                } else {
                    i.setAttribute('disabled', '')
                }
            });
            $other.selectedIndex = firstEnabled;
            setPriceAndImage();
        }

        function setPriceAndImage() {
            const variant = variants.filter(i => i.size == $sizes.value && i.colour == $colours.value)[0];
            $price.innerHTML = variant ? `Price: &pound; ${variant.price}` : 'Unavailable';
            if (variant) {
                $add.removeAttribute('disabled');
                $photo.src = variant.image ? `/build/assets/${variant.image}` : '/build/assets/product.png';
                $variation.value = variant.id;
            } else {
                $add.setAttribute('disabled', '');
                $photo.src = '{{ $product->image ? '/build/assets/'.$product->image : '/build/assets/product.png' }}';
                $variation.value = '';
            }
        }
        setVariants($sizes);
    </script>
</x-app-layout>
