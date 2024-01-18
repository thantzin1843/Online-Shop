<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
   public function list(){
    // logger(request()->status);
    if(request()->status == 'asc'){
        $data =Product::orderBy('created_at','asc')->get();
    }else{
        $data =Product::orderBy('created_at','desc')->get();
    }

    return $data;
   }
   // filter
   public function filter($id){
    if($id == 0){
        $categories = Category::get();
        $products = Product::get();
        $cartProducts = Cart::where('user_id',Auth::user()->id)->get();
        $orderItems = Order::where('user_id',Auth::user()->id)->paginate(5);
    }else{
        $categories = Category::get();
        $products = Product::where('category_id',$id)->get();
        $cartProducts = Cart::where('user_id',Auth::user()->id)->get();
        $orderItems = Order::where('user_id',Auth::user()->id)->paginate(5);
    }
    return view('user.main.home',compact(['products','categories','cartProducts','orderItems']));
   }

   //
   public function addToCart(Request $request){
    // logger($request->userId);
    $data = [
        'user_id'=>$request->userId,
        'product_id'=>$request->pizzaId,
        'quantity'=>$request->quantity,
    ];
    Cart::create($data);
    $response = [
        'message'=>'Add to Cart complete',
        'status'=>'success'
    ];
    return response()->json($response,200);

   }

   public function orderList(Request $request){
    // logger($request);
    foreach($request->all() as $item){
        // logger($item);
        OrderList::create($item);
    }
    Cart::where('user_id',Auth::user()->id)->delete();
    $total = 3000;
    foreach($request->all() as $item){
        // logger($item);
        $total+= $item['total'];
    }
    Order::create([
        'user_id'=>$item['user_id'],
        'order_code'=>$item['order_code'],
        'total_price'=>$total,
    ]);
    return response()->json(['message'=>'Order created successfully!','status'=>'success'],200);

   }

   /////////////Admin ajax
   public function status(Request $request){
    // logger($request);
    $orders = Order::select('users.name as user_name','orders.*')
                ->leftJoin('users','orders.user_id','users.id');


    if($request['status'] == ""){
        $orders = $orders->get();
    }else{
        $orders = $orders->where('status',$request['status'])->get();
    }
//    logger($orders);
    return response()->json($orders,200);
   }

   public function changeStatus(Request $request){
    $data = Order::where('id',$request->orderId)->update(['status'=>$request->status]);
    return response()->json([
        'state'=>'success'
    ],200);
   }

   // view count
   public function viewCount(Request $request){
    // logger($request->toArray());
    $data = Product::where('id',$request->product_id)->first();
    $viewCount = $data->view_count + 1;
    Product::where('id',$request->product_id)->update(['view_count'=>$viewCount]);
   }

   public function changeRole(Request $request){
    User::where('id',$request->userId)->update([
        'role'=>$request->role,
    ]);
   }
}
