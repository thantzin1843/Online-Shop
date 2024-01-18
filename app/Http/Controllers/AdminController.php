<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function detailPage(){
        return view('admin.account.detail');
    }

    //edit
    public function editPage(){
        return view('admin.account.edit');
    }
    // update
    public function update(Request $request){
        $this->validateUpdateData($request);
        $data = $this->changeDataFormat($request);
        // for image
        if($request->hasFile('image') != null){
            $dbImage = User::where('id',Auth::user()->id)->first()->image;
            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }
            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        User::where('id',Auth::user()->id)->update($data);
        return redirect()->route('account#details');
    }

    // admin list
    public function adminList(){
    $admins = User::when(request('searchKey'),function($query){
        $query->orWhere('name','like','%'.request('searchKey').'%')
        ->orWhere('email','like','%'.request('searchKey').'%')
        ->orWhere('phone','like','%'.request('searchKey').'%')
        ->orWhere('address','like','%'.request('searchKey').'%');
    })

                ->where('role','admin')->paginate(3);
        $admins->appends(request()->all());
        return view('admin.account.admin_list',compact('admins'));
    }

    // delete admin
    public function deleteAdmin($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>"Deleted Successfully!"]);
    }

    // change role
    public function changeRole($id){
        $admin = User::where('id',$id)->get();
        return view('admin.account.change_role',compact('admin'));
    }

    public function change_role(Request $request){
        User::where('id',$request->id)->select('role')->update(['role'=>$request->role]);
        return redirect()->route('admin#list')->with(['updateSuccess'=>"Changed Role Successfully!"]);
    }

    // delete message
    public function deleteMessage($id){
        Contact::where('id',$id)->delete();
        return back();
    }
    // validation
    private function validateUpdateData($request){
        Validator::make($request->all(),[
            'name'=>['required'],
            'email'=>['required'],
            'phone'=>['required'],
            'address'=>['required'],
        ])->validate();
    }

    // array form
    private function changeDataFormat($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
        ];
    }


    ////////User Associate////////////////
    public function orderList(){
        $orders = Order::select('users.name as user_name','orders.*')->leftJoin('users','orders.user_id','users.id')->get();
        return view('admin.from_user.order',compact('orders'));
    }

    public function orderDetail($order_code){
        $orderData = Order::select('users.name as user_name','orders.*')
                    ->leftJoin('users','orders.user_id','users.id')
                    ->where('order_code',$order_code)
                    ->get();
        $orderProducts = Order::select('order_lists.total as item_total','orders.*','products.product_name as p_name','order_lists.quantity as quantity','products.image as image','orders.total_price as total_price')
                        ->join('order_lists','orders.order_code','order_lists.order_code')
                        ->join('products','order_lists.product_id','products.id')
                        ->where('orders.order_code',$order_code)
                        ->get();
                        // dd($orderProducts->toArray());
                    // dd($orderData->toArray());
        return view('admin.from_user.order_detail',compact('orderData','orderProducts'));
    }

    public function orderSearch(Request $request){
        $orders = Order::select('users.name as user_name','orders.*')->leftJoin('users','orders.user_id','users.id');
        if($request->orderStatus != null){
            $orders = $orders->where('orders.status',$request->orderStatus)
                        ->get();
        }else{
            $orders = $orders->get();
        }
        return view('admin.from_user.order',compact('orders'));
    }

    public function userList(){
        $users = User::when(request('searchKey'),function($query){
            return $query->where('name','like','%'.request('searchKey').'%');
        })->paginate(5);
        $users->append(request()->all());
        return view('admin.from_user.user_list',compact('users'));
    }

    public function contact_page(){
        $messages = Contact::get();
        return view('admin.from_user.contact',compact('messages'));
    }

}
