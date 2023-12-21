<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3>Order Summary</h3>
                @if(count($cart) > 0)
                <table id="cart" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($cart as $id => $details)
                        <tr>
                            <td data-th="Product">
                                <h4 class="nomargin">{{ $details['name'] }}</h4>
                            </td>
                            <td data-th="Price">${{ $details['price'] }}</td>
                            <td data-th="Quantity">{{ $details['quantity'] }}</td>
                            <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <p><strong> Total: ${{ $total }} </strong></p>

                    
                        
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Shipping Information') }}
                            </h2>
                            <form action="{{ route('checkout.process') }}" method="post" class="mt-6 space-y-6">
                                @csrf
                                <input type="hidden" name="total" value="{{ $total }}" />
                                <div>
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input type="text" id="name" name="name" required autofocus autocomplete="name" />
                                </div>    

                                <div>
                                    <x-input-label for="shipping_address" :value="__('Shipping Address')" />
                                    <textarea id="shipping_address" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="shipping_address" rows="3" required></textarea>
                                </div>
                                    
                                <div>
                                    <x-input-label for="payment_details" :value="__('Payment Details')" />
                                    <x-checkbox id="payment_details" name="payment_details" value="COD" checked />
                                    <x-input-label for="payment_details" :value="__('Cash on delivery')" />
                                <x-button type="submit">Place Order</x-button>
                            </form>
                        </header>
                    </section>
                </div>

            @else
                <p>Your cart is empty. Add some products before checking out.</p>
            @endif
            </div>
        </div>
    </div>

</x-app-layout> 