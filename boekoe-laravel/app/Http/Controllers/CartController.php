<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class CartController extends Controller
{
    public function index(){
        $data = DB::table('carts')->join('products', 'carts.product_id', '=', 'products.id')->select('carts.id as id', 'carts.product_quantity as product_quantity', 'products.imageURL as imageURL', 'products.price as price', 'products.title as title', 'products.category as category')->where('carts.user_id', '=', Auth::id())->where('carts.is_ordered', '=', '0');
        return view('cart.index', [
            "title" => "cart",
            "data" => $data->get()
        ]);
    }

    public function store(Request $request){
        if(is_numeric($request->input('quantity'))){
            if($temp = Cart::where('is_ordered', false)->where('product_id', $request->input('product_id'))->first()){
                Cart::where('is_ordered', false)->where('product_id', $request->input('product_id'))->update(['product_quantity' => $temp->product_quantity + $request->input('quantity')]);
            }else{
                $newCart = new Cart;
                $newCart->user_id = Auth::id();
                $newCart->product_id = $request->input('product_id');
                $newCart->product_quantity = $request->input('quantity');
                $newCart->checkoutCounter = 0;
                $newCart->save();
            }
            return back()->with('success', 'This product has been added to your cart!');
        }else{
            return back();
        }
    }

    public function update(Request $request){
        $updateCart = Cart::where('id', $request->input('id'))->first();
        if($updateCart->user_id == Auth::id() && is_numeric($request->input('quantity'))){
            $updateCart->product_quantity = $request->input('quantity');
            $updateCart->save();
            return back()->with('successUpdate', 'Item Updated!');
        }else{
            return back();
        }
    }

    public function delete(Request $request){
        $updateCart = Cart::where('id', $request->input('id'))->first();
        if($updateCart->user_id == Auth::id()){
            $updateCart->delete();
            return back()->with('successDelete', 'Item Deleted!');
        }else{
            return back();
        }
    }

    public function checkout(Request $request){
        $data = DB::table('carts')->join('products', 'carts.product_id', '=', 'products.id')->select('carts.id as id', 'carts.product_quantity as product_quantity', 'products.imageURL as imageURL', 'products.price as price', 'products.title as title', 'products.category as category')->where('carts.user_id', '=', Auth::id())->where('carts.is_ordered', '=', '0');
        $maxCounter = DB::table('carts')->where('user_id', Auth::id())->max('checkoutCounter');
        Cart::where('checkoutCounter', 0)->update(['checkoutCounter' => $maxCounter+1]);
        return view('cart.checkout', [
            "title" => "checkout",
            "data" => $data->get()
        ]);
    }
}