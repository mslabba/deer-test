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

}
