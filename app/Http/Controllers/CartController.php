<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class CartController extends Controller
{

    public function index()
    {
        return view('cart');
    }

    public function add($id)
    {
        $this->validate(request(), [
            'quantity' => 'required|integer|min:1',
        ]);
    
        $product = Product::findOrFail($id);

        if (!Session::has('cart')) {
            Session::put('cart', []);
        }

        $cart = Session::get('cart');
        $cart[$id] = [
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => isset($cart[$id]['quantity']) ? $cart[$id]['quantity'] + 1 : 1,
        ];

        Session::put('cart', $cart);

        return redirect('/')->with('success', 'Product added to cart');
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Book added to cart.');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed from cart.');
        }
    }
}
