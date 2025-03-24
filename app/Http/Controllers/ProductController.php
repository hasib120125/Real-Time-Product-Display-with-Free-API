<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Events\ProductUpdated;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    public function fetchProducts()
    {
        $response = Http::get('https://fakestoreapi.com/products?limit=5');

        if ($response->successful()) {
            foreach ($response->json() as $item) {
                $product = Product::updateOrCreate(
                    ['name' => $item['title']],
                    [
                        'description' => $item['description'],
                        'price' => $item['price']
                    ]
                );

                broadcast(new ProductUpdated($product));
            }
        }

        return redirect()->route('products.index');
    }
}
