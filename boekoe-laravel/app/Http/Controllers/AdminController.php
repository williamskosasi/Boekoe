<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVersion;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class AdminController extends Controller
{
    public function index(){
        $data = Order::latest();
        return view('admin.index',[
            'title' => 'home',
            'data' => $data->get()
        ]);
    }

    public function viewDetail(Request $request){
        $data = DB::table('orders')->join('carts', 'orders.checkoutCounter', '=', 'carts.checkoutCounter')->join('products', 'carts.product_id', '=', 'products.id')->select('carts.id as id', 'carts.product_quantity as product_quantity', 'products.imageURL as imageURL', 'products.price as price', 'products.title as title', 'products.category as category')->where('carts.user_id', '=', $request->input('user_id'))->where('orders.user_id', '=', $request->input('user_id'))->where('orders.checkoutCounter', '=', $request->input(('checkoutCounter')));
        $order = Order::where('id', $request->input('order_id'));
        return view('admin.viewDetail', [
            "title" => "cart",
            "data" => $data->get(),
            "order" => $order->first()
        ]);
    }

    public function viewImage(Request $request){
        $order = Order::where('tf_evidence', $request->input('image'));
        return view('admin.viewImage',[
            "title" => "image",
            "order" => $order->first()
        ]);
    }

    public function updateStatus(Request $request){
        $order = Order::where('id', $request->input('order_id'))->first();
        if($order->status == 'Waiting for verification'){
            Order::where('id', $request->input('order_id'))->update(['status' => 'On delivery']);
        }elseif($order->status == 'On delivery'){
            Order::where('id', $request->input('order_id'))->update(['status' => 'Arrived','is_done' => true]);
        }
        return back()->with('success', 'Status updated');
    }

    public function manageBooks(Request $request){
        $products = Product::orderBy('available', 'desc');
        return view('admin.manageBooks',[
            'title' => 'manage',
            'products' => $products->get()
        ]);
    }

    public function setAvailable(Request $request){
        $product = Product::where('id', $request->input('product_id'))->first();
        if($product->available == true){
            Product::where('id', '=', $product->id)->update(['available' => false]);
            Cart::where('product_id', $product->id)->delete();
        }else{
            Product::where('id', '=', $product->id)->update(['available' => true]);
        }
        return back()->with('success', 'Available status changed successfully');
    }

    public function editPrice(Request $request){
        if(is_numeric($request->input('price'))){
            $product = Product::where('id', $request->input('product_id'))->first();
            Product::where('id', '=', $product->id)->update(['price' => $request->input('price')]);
            $lastVer = DB::table('product_versions')->where('product_id', '=', $product->id)->max('version');
            $newProductVersion = new ProductVersion;
            $newProductVersion->product_id = $product->id;
            $newProductVersion->price = $request->input('last_price');
            $newProductVersion->version = $lastVer+1;
            $newProductVersion->save();
            return back()->with('success', 'Price changed successfully');
        }else{
            return back();
        }
    }

    public function addBooksPage(){
        return view('admin.addBooks',['title' => 'add']);
    }

    public function addBooks(Request $request){
        $dataValid = $request->validate([
            'slug' => ['required', 'max:255', 'unique:products'],
            'title' => ['required', 'max:255'],
            'author' => ['required', 'max:255'],
            'price' => ['required', 'numeric'],
            'category' => ['required', 'max:255'],
            'length' => ['required', 'digits_between:1,5'],
            'language' => ['required', 'max:255'],
            'publisher' => ['required', 'max:255'],
            'dimensions' => ['required', 'max:255'],
            'isbn10' => ['required', 'digits:10', 'unique:products'],
            'isbn13' => ['required', 'size:14', 'unique:products']
        ]);
        if($dataValid && $request->hasFile('image')){
            $imageValid = $request->validate(['image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120']);
            if($imageValid['image']){
                $newBook = new Product;
                $newBook->slug = $request->input('slug');
                $newBook->title = $request->input('title');
                $newBook->author = $request->input('author');
                $newBook->price = $request->input('price');
                $newBook->category = $request->input('category');
                $newBook->length = $request->input('length');
                $newBook->language = $request->input('language');
                $newBook->publisher = $request->input('publisher');
                $newBook->dimensions = $request->input('dimensions');
                $newBook->isbn10 = $request->input('isbn10');
                $newBook->isbn13 = $request->input('isbn13');
                $newBook->imageURL = $request->file('image')->store('bookList');
                $newBook->save();
                return back()->with('success', 'Book Added!');
            }else{
                return back();
            }
        }else{
            return back();
        }
    }
}
