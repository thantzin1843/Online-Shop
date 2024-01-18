<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // cart page
    public function cart(){
        $products = Cart::where('user_id',Auth::user()->id)
                    ->join('products','carts.product_id','products.id')
                    ->get();
        $subtotal = 0;
        foreach($products as $p){
            $subtotal+= ($p->price * $p->quantity);
        }

        return view('user.cart.cart',compact('products','subtotal'));
    }

    public function delete($id){
        Cart::where('user_id',Auth::user()->id)->where('product_id',$id)->delete();
        return back();
    }

    public function historyPage(){
        $orderItems = Order::where('user_id',Auth::user()->id)->paginate(5);
        // dd($orderItems);
        return view('user.cart.history',compact('orderItems'));
    }
}
