<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;

class HomeController extends Controller
{
    public function index() {
        $user_num = User::where('usertype', 'user')->get()->count();

        $product_num = Product::all()->count();

        $order_num = Order::all()->count();

        $delivered = Order::where('status', 'delivered')->get()->count();

        return view('admin.index', compact('user_num', 'product_num', 'order_num', 'delivered'));
    }

    public function home() {
        $products = Product::all();

        if(Auth::id()){
            $user = Auth::user();
            $user_id = $user->id;
            $cart_count = Cart::where('user_id', $user_id)->count();
        }else {
            $cart_count = '';
        }
        return view('home.index', compact('products', 'cart_count'));
    }

    public function shop() {
        $products = Product::all();

        if(Auth::id()){
            $user = Auth::user();
            $user_id = $user->id;
            $cart_count = Cart::where('user_id', $user_id)->count();
        }else {
            $cart_count = '';
        }
        return view('home.shop', compact('products', 'cart_count'));
    }

    public function why() {

        if(Auth::id()){
            $user = Auth::user();
            $user_id = $user->id;
            $cart_count = Cart::where('user_id', $user_id)->count();
        }else {
            $cart_count = '';
        }
        return view('home.why', compact('cart_count'));
    }

        public function testimonial() {

        if(Auth::id()){
            $user = Auth::user();
            $user_id = $user->id;
            $cart_count = Cart::where('user_id', $user_id)->count();
        }else {
            $cart_count = '';
        }
        return view('home.testimonial', compact('cart_count'));
    }

    public function contact() {

        if(Auth::id()){
            $user = Auth::user();
            $user_id = $user->id;
            $cart_count = Cart::where('user_id', $user_id)->count();
        }else {
            $cart_count = '';
        }
        return view('home.contact', compact('cart_count'));
    }

    public function login_home() {
        $products = Product::all();

        $user = Auth::user();
        $user_id = $user->id;
        $cart_count = Cart::where('user_id', $user_id)->count();

        return view('home.index', compact('products', 'cart_count'));
    }

    public function product_details($id) {
        $product = Product::find($id);

        if(Auth::id()){
            $user = Auth::user();
            $user_id = $user->id;
            $cart_count = Cart::where('user_id', $user_id)->count();
        }else {
            $cart_count = '';
        }
        return view('home.product_details', compact('product', 'cart_count'));
    }

    public function add_cart($id) {
        $product_id = $id;
        $user = Auth::user();
        $user_id = $user->id;

        $cart = new Cart();
        $cart->user_id = $user_id;
        $cart->product_id = $product_id;

        $cart->save();

        return redirect()->back()->with('message', "Add to Cart Successfully!");

    }

    public function mycart() {
        if(Auth::id()){
            $user = Auth::user();
            $user_id = $user->id;
            $cart_count = Cart::where('user_id', $user_id)->count();
            $carts = Cart::where('user_id', $user_id)->get();      
        }else {
            $cart_count = '';
        }

        return view('home.mycart', compact('cart_count', 'carts'));
    }

    public function comfirm_order(Request $request) {
        $name = $request->rec_name;
        $address = $request->rec_address;
        $phone = $request->rec_phone;
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', $user_id)->get();
        
        foreach($carts as $cart) {
            $order = new Order();
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $user_id;
            $order->product_id = $cart->product_id;

            $order->save();
        }

        foreach($carts as $cart) {
            $remove_cart = Cart::find($cart->id);
            $remove_cart->delete();
        }

        return redirect()->back()->with('message', "Product Ordered Successfully!");

    }

    public function myorders() {
        $user_id = Auth::id();
        $orders = Order::where('user_id', $user_id)->get();

        if($user_id){
            $user = Auth::user();
            $user_id = $user->id;
            $cart_count = Cart::where('user_id', $user_id)->count();
        }else {
            $cart_count = '';
        }
        return view('home.order', compact('cart_count', 'orders'));
    }

    public function stripe($price)
    {
        return view('home.stripe', compact('price'));
    }

    public function stripePost(Request $request, $price)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      
        Stripe\Charge::create ([
                "amount" => $price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);

        $name = Auth::user()->name;
        $address = Auth::user()->address;
        $phone = Auth::user()->phone;
        $user_id = Auth::user()->id;
        $carts = Cart::where('user_id', $user_id)->get();
        
        foreach($carts as $cart) {
            $order = new Order();
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $user_id;
            $order->product_id = $cart->product_id;
            $order->payment_status = 'paid';

            $order->save();
        }

        foreach($carts as $cart) {
            $remove_cart = Cart::find($cart->id);
            $remove_cart->delete();
        }

        // return redirect()->back()->with('message', "Product Ordered Successfully!");
        
                
        return redirect('mycart')
                ->with('success', 'Order and Payment successful!');
    }
}
