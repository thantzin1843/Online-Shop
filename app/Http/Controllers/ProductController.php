<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // list page
    public function list(){
        $products = Product::select('*')
        ->leftJoin('categories','products.category_id','categories.id')
        ->when(request('searchKey'),function($query){
            return $query->where('product_name','like','%'.request('searchKey').'%');
        })->orderBy('product_name','asc')->paginate(3);
        // dd($products->toArray());
        $products->appends(request()->all());
        return view('admin.product.list',compact('products'));
    }

    // createPage
    public function createPage(){
        $categories = Category::get();
        // dd($categories->toArray());
        return view('admin.product.createProduct',compact('categories'));
    }

    // create
    public function create(Request $request){
        $this->validatePizzaInfo($request);
        $data = [
            'category_id'=>$request->category,
            'product_name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,

        ];
        if($request->hasFile('image')){
            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        Product::create($data);
        return redirect()->route('product#listPage');
    }

    //delete
    public function delete($id){
        Product::where('id',$id)->delete();
        return back();
    }

    // edit
    public function edit($id){
       $product = Product::where('id',$id)->first();
       $categories = Category::get();
       return view('admin.product.edit',compact('product','categories'));
    }

    public function update(Request $request){
        $this->validatePizzaInfo($request);
        $data = [
            'category_id'=>$request->category,
            'product_name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
        ];
        if($request->hasFile('image')){
            $dbImage = Product::where('id',$request->id)->first()->image;
            Storage::delete('public/'.$dbImage);
        }
        $fileName = uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public',$fileName);
        $data['image'] = $fileName;
        Product::where('id',$request->id)->update($data);
        return redirect()->route('product#listPage');
    }

    // product -------------------------------
    public function detail($id){
        $pizza = Product::where('id',$id)->get();
        $pizzas = Product::get();
        $comments = Comment::join('users','users.id','comments.user_id')->get();
        return view('user.cart.product_detail',compact('pizza','pizzas','comments'));
    }

    // validate
    private function validatePizzaInfo($request){
        Validator::make($request->all(),[
            'name'=>['required'],
            'price'=>['required'],
            'category'=>['required'],
            'description'=>['required'],
            'image'=>'required'
        ])->validate();
    }
}
