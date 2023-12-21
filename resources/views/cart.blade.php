<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
            <div class="col-12">
                <div class="dropdown" >
                    <a class="btn btn-outline-dark" href="">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge text-bg-danger">{{ count((array) session('cart')) }}</span>
                    </a>
                </div>
            </div>
           

            <table id="cart" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            
                            <tr rowId="{{ $id }}">
                                <td data-th="Product">
                                    <h4 class="nomargin">{{ $details['name'] }}</h4>
                                </td>
                                <td data-th="Price">AED {{ $details['price'] }}</td>
                                <td data-th="Quantity">
                                    <x-text-input type="text" id="cart_quantity" name="quantity" required autofocus autocomplete="quantity" value="{{ $details['quantity'] }}" />
                                </td>
                                <td data-th="Subtotal" class="text-center" data-original-price="{{ $details['price'] }}" id="subtotal_{{ $id }}">${{ $details['price'] }}</td>
                                <td class="actions">
                                    <x-danger-button class="delete-product" id="delete-product" data-delete-url="{{ route('delete.cart.product') }}">Remove</x-danger-button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-right">
                            <x-primary-button><a href="{{ url('/') }}" class="btn btn-primary">Continue Shopping</a></x-primary-button>
                            <x-primary-button><a href="{{ url('/checkout') }}" class="btn btn-primary">Checkout</x-primary-button>
                        </td>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div> 
    @endif
</div>
</x-app-layout>