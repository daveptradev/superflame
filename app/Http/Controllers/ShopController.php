<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->category;

        // FILTER CATEGORY
        if ($category && $category != 'ALL') {
            $products = Product::where('category', $category)->latest()->get();
        } else {
            $products = Product::latest()->get();
        }

        return view('shop', compact('products', 'category'));
    }
}
