<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index')->with('products', $products);
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show')->with('product', $product);
    }

    /**
     * Process the payment.
     */
    public function purchase(Request $request)
    {
        try {
            $product_id = $request->input('product_id');
            $amount = $request->input('amount');
            $stripeCharge = (new User)->charge($amount * 100, $request->input('payment_method'));

            return to_route('products.show', $product_id)->with('success', 'Payment processed successfully! Thanks for shoping.');
        } catch (\Exception $e) {
            return to_route('products.show', $product_id)->with('error', 'There is an error while processing the payment!');
        }
    }

}
