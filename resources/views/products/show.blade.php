<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shop') }}
        </h2>
    </x-slot>
    @section('styles')
<style>
    
</style>
@endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 px-4 py-2 bg-green-100 border border-green-200 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="mb-4 px-4 py-2 bg-red-500 border border-red-200 text-white rounded-md">
                    {{ session('error') }}
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="mt-6 text-xl font-semibold text-gray-900">{{ ucfirst($product->name) }}</h2>
                    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                        AED {{ $product->price }} 
                    </p>
                    <p class="mt-4 text-gray-500 text-sm leading-relaxed"> {{ $product->description }} </p>
                </div>
                <div class="form-group mt-3 mb-3 text-center justify-center">
                <x-primary-button><a href="{{ route('add.to.cart', $product->id) }}"> {{ __('Add to Cart') }} </a></x-primary-button>
                </div>
            </div>
        </div>
    </div>
@section('scripts')
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>


@endsection
</x-app-layout>
