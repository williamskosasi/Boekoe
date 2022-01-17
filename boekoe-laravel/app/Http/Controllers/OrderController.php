<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class OrderController extends Controller
{
    public function index(){
        $item = Order::latest();
        $data = $item->where('user_id', '=', Auth::id());

        return view('order.index',[
            'title' => 'order',
            'data' => $data->get()
        ]);
    }
    public function do(Request $request){
        $dataValid = $request->validate([
            'name' => ['required', 'max:255'],
            'streetAddress' => ['required', 'max:255'],
            'city' => ['required', 'max:255'],
            'province' => ['required', 'max:255'],
            'postalcode' => ['required', 'digits:5'],
            'phone' => ['required', 'numeric']
        ]);
        if($dataValid){
            $newOrder = new Order;
            $newOrder->user_id = Auth::id();
            $cart = DB::table('carts')->where('user_id', '=', Auth::id())->where('is_ordered', '=', '0')->max('checkoutCounter');
            $newOrder->checkoutCounter = $cart;
            $newOrder->name = $request->input('name');
            $newOrder->street_address = $request->input('streetAddress');
            $newOrder->city = $request->input('city');
            $newOrder->province = $request->input('province');
            $newOrder->postal_code = $request->input('postalcode');
            $newOrder->phone_number = $request->input('phone');
            $total_price = DB::table('carts')->join('products', 'carts.product_id', '=', 'products.id')->where('user_id', '=', Auth::id())->where('is_ordered', '=', '0')->select(DB::raw('(carts.product_quantity * products.price) as subtotal'))->get();
            $newOrder->total_price = $total_price->sum('subtotal');
            $newOrder->status = 'Waiting for payment';
            $newOrder->tf_evidence = '';
            $newOrder->save();
            Cart::where('user_id', Auth::id())->where('is_ordered', '0')->update(['is_ordered' => true]);
            return redirect('/order');
        }else{
            return back();
        }
    }

    public function uploadImage(Request $request){
        if($request->hasFile('image')){
            $order = Order::where('user_id', Auth::id())->where('checkoutCounter', $request->input('checkoutCounter'))->first();
            if($order->status == 'Waiting for payment' || $order->status == 'Waiting for verification'){
                $imageValid = $request->validate(['image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120']);
                if($imageValid['image']){
                    $imagePath = $request->file('image')->store('proofOfPayment');
                    Order::where('user_id', Auth::id())->where('checkoutCounter', $request->input('checkoutCounter'))->update(['tf_evidence' => $imagePath, 'status' => 'Waiting for verification']);
                    return back()->with('successUpload', 'Proof of Payment Uploaded!');
                }else{
                    return back();
                }
            }else{
                return back();
            }
        }else{
            return back();
        }
    }

    public function viewDetail(Request $request){
        $data = DB::table('orders')->join('carts', 'orders.checkoutCounter', '=', 'carts.checkoutCounter')->join('products', 'carts.product_id', '=', 'products.id')->select('carts.id as id', 'carts.product_quantity as product_quantity', 'products.imageURL as imageURL', 'products.price as price', 'products.title as title', 'products.category as category')->where('carts.user_id','=', Auth::id())->where('orders.user_id','=', Auth::id())->where('carts.checkoutCounter', '=', $request->input('checkoutCounter'))->where('orders.checkoutCounter', '=', $request->input('checkoutCounter'));
        $order = Order::where('user_id', Auth::id())->where('checkoutCounter', $request->input('checkoutCounter'));
        return view('order.viewDetail', [
            "title" => "cart",
            "data" => $data->get(),
            "order" => $order->first()
        ]);
    }

}