<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @section('styles')
<style>
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }
    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }
    .StripeElement--invalid {
        border-color: #fa755a;
    }
    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>
@endsection
    <script src="https://js.stripe.com/v3/"></script>

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
                        Rs. {{ $product->price }} 
                    </p>
                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed"> {{ $product->description }} </p>
                </div>
                <form method="POST" action="{{ route('products.purchase', $product) }}" class="card-form mt-3 mb-3">
                    @csrf
                    <input type="hidden" name="payment_method" class="payment-method" id="payment-method">
                    <input type="hidden" name="amount" value="{{ $product->price }}">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input class="StripeElement mb-3 w-full" id="card_holder_name" name="card_holder_name" placeholder="Card holder name" required>
                    <div class="col-lg-4 col-md-6">
                        <div id="card-element"></div>
                    </div>
                    <div id="card-errors" role="alert"></div>
                    <div class="form-group mt-3 text-center justify-center">
                        <button type="submit" id="card-button" class="btn btn-primary pay h-8 w-20 bg-clr font-clr items-center justify-center rounded-full">
                            Purchase
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@section('scripts')
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    let stripe = Stripe("{{ env('STRIPE_KEY') }}")
    let elements = stripe.elements()
    let style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    }
    let card = elements.create('card', {hidePostalCode: true, style: style})
    card.mount('#card-element')
    let paymentMethod = null
    
    // const cardHolderName = document.getElementById('card-holder-name');
    // const cardButton = document.getElementById('card-button');
    // cardButton.addEventListener('click', async (e) => {
    //     console.log('inside button click');
    // const { paymentMethod, error } = await stripe.createPaymentMethod(
    //     'card', cardElement, {
    //         billing_details: { name: cardHolderName.value }
    //     }
    // );
 
    // if (error) {
    //     // Display "error.message" to the user...
    // } else {
    //     document.getElementById('payment-method') = paymentMethod.id;
    // }

    let cardHolderName = $('#card-holder-name').val();
    $('button#card-button').on('click', function(e) {
        e.preventDefault();
        stripe.createPaymentMethod('card', card, {
            billing_details: { name: $('input#card-holder-name').val() }
        }).then((result) => {
            console.log(result);
            if (result.error) {
                $('#card-errors').text(result.error.message);
            } else {
                $('input#payment-method').val(result.paymentMethod.id);
                $('.card-form').submit()
            }
        });
    });

    
</script>
@endsection
</x-app-layout>
