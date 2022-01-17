<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    

    public function index(){

        $products = Product::orderBy('available', 'desc');

        if(request('searchBar')){
            $products->where('title', 'like', '%' . request('searchBar') . '%')->orWhere('author', 'like', '%' . request('searchBar') . '%')->orWhere('category', 'like', '%' . request('searchBar') . '%');
        }

        return view('home', [
            "title" => "Products",
            "products" => $products->get()
        ]);
    }
    public function detail(Product $product){
        return view('product', [
            "title" => "Product Detail",
            "product" => $product
        ]);
    }
}
