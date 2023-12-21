<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $total = $this->calculateTotal($cart);

        return view('checkout', compact('cart', 'total'));
    }

    public function process(Request $request)
    {
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->total_price = $request->total;
        $order->shipping_address = $request->shipping_address;
        $order->payment_details = $request->payment_details;
        $order->save();

        $cart = session('cart', []);
        foreach($cart as $cartorder)
        {
            $order_product = new OrderProduct();
            $order_product->order_id = $order->id;
            $order_product->product_id = $cartorder['product_id'];
            $order_product->quantity = $cartorder['quantity'];
            $order_product->save();
        }

        session(['cart' => []]);
        return redirect('/')->with('success', 'Order placed successfully!');
    }

    private function calculateTotal($cart)
    {
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }
}
