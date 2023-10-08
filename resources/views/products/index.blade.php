<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Index') }}
        </h2>
    </x-slot>

    <div class="mt-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            @foreach($products as $product)
            <div class="text-center justify-center w-100 scale-100 p-6 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                <div>
                    

                    <h2 class="mt-6 text-xl font-semibold text-gray-900">{{ ucfirst($product->name) }}</h2>

                    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                        Rs. {{ $product->price }} 
                    </p>

                    <a href=" {{ route('products.show', $product) }} " class="h-7 w-16 bg-clr font-clr flex items-center justify-center rounded-full">Buy</a>
                    
                </div>
            </div>
            @endforeach
        </div>
    </div>

</x-app-layout>                