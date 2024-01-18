<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Comment;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // change pasword page
    public function changePassword(){
        return view('user.account.changePassword');
    }
    public function changePass(Request $request){
        $this->validateUserPass($request);
        $dbPassword  = User::where('id',Auth::user()->id)->first()->password;
        if(Hash::check($request->oldPassword, $dbPassword)){
            User::where('id',Auth::user()->id)->update(['password'=>Hash::make($request->newPassword)]);
            return redirect()->route('user#home')->with(['changed'=>'Password changed successfully!']);
        }else{
            return back()->with(['notMatch'=>"The Credential doesn't match"]);
        }
    }

    // account
    public function accountPage(){
        return view('user.account.detail');
    }
    public function editPage(){
        return view('user.account.edit');
    }
    //update
    public function update(Request $request){
        $this->validateUpdateData($request);
        $data = $this->changeDataFormat($request);
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
        return redirect()->route('account#edit');
    }

    public function contactPage(){
        return view('user.main.contact');
    }
    //filter
    // validate password
    private function validateUserPass($request){
        Validator::make($request->all(),[
            'oldPassword' => ['required'],
            'newPassword'=>['required','min:8'],
            'confirmPassword'=>['required','min:8','same:newPassword'],
        ])->validate();

    }
    private function validateUpdateData($request){
        Validator::make($request->all(),[
            'name'=>['required'],
            'email'=>['required'],
            'phone'=>['required'],
            'address'=>['required'],
        ])->validate();
    }
    private function changeDataFormat($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
        ];
    }

    public function send(Request $request){
        $this->validateData($request);
        Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message
        ]);
        return redirect()->route('user#home');
    }

    // post comment
    public function postComment(Request $request){
        $this->validateData($request);
        Comment::create([
            'user_id'=>Auth::user()->id,
            'product_id'=>$request->pizzaId,
            'comment'=>$request->message,
        ]);
        return back();
    }
    private function validateData($request){
        Validator::make($request->all(),[
            'message'=>['required'],
        ])->validate();
    }
}
