<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shop') }}
        </h2>
    </x-slot>

    <div class="mt-16">
        @if (session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 border border-green-200 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="mb-4 px-4 py-2 bg-red-500 border border-red-200 text-white rounded-md">
                {{ session('error') }}
            </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8" style="padding: 10px;">
            @foreach($products as $product)
            <div class="text-center justify-center w-100 scale-100 p-6 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                <div>
                    

                    <h2 class="mt-6 text-xl font-semibold text-gray-900"><a href=" {{ route('products.show', $product) }} "> {{ ucfirst($product->name) }} </a></h2>
                    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                        {{ $product->description }} 
                    </p>
                    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                        AED {{ $product->price }} 
                    </p>

                    <x-primary-button><a href="{{ route('add.to.cart', $product->id) }}"> {{ __('Add to Cart') }} </a></x-primary-button>
                    
                </div>
            </div>
            @endforeach
        </div>
    </div>

</x-app-layout>                