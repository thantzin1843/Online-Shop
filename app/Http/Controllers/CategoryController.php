<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    // list page
    public function listPage(){
        $categories = Category::when(request('searchKey'),function($query){
            return $query->where('category_name','like','%'.request('searchKey').'%');
        })
        ->orderBy('created_at','desc')->paginate(3);
        $categories->appends(request()->all());
        return view('admin.category.list', compact('categories'));
    }
    // createPage
    public function createPage(){
        return view('admin.category.create');
    }
    //create
    public function create(Request $request){
        //validate
        $this->validateData($request);
        //get array format
        $data = $this->changeDataFormat($request);
        Category::create($data);
        return redirect()->route('admin#category_list')->with(['createSuccess'=>'Created Successfully !']);
    }

    // delete
    public function delete($id){
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Deleted Successfully!']);
    }

    public function editPage($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    // public
    public function update(Request $request){
        $this->validateData($request);
        $data = $this->changeDataFormat($request);
        Category::where('id',$request->category_id)->update($data);
        return redirect()->route('admin#category_list')->with(['updateSuccess'=>"Updated Successfully!"]);
    }
    //validation function
    private function validateData($request){
        Validator::make($request->all(),[
            'categoryName'=>'required|unique:categories,category_name,'.$request->category_id,
        ])->validate();
    }
    // change data format
    private function changeDataFormat($request){
        return [
            'category_name'=>$request->categoryName,
        ];
    }
}
