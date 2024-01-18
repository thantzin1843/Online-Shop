<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    public function productList(){
        $products = Product::get();
        $users = User::get();
        $data = [
            'products'=>$products,
            'users'=>$users
        ];
        return $data['products'][0]->price;
    }

    public function categoryList(){
        $categories = Category::get();
        $orders = Order::get();
        $data = [
            'category'=>[
                'pizza_category'=>$categories
            ],
            'orders'=>$orders
        ];
        return $data['category']['pizza_category'][0]->category_name;
        // return response()->json($categories,200);
    }

    public function orderList(){
        $orderList = OrderList::get();
        return response()->json($orderList,200);
    }
}
