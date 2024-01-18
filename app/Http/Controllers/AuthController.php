<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // dashboard
    public function dashboard(){
        if(Auth::user()->role == 'admin'){
            return redirect()->route('admin#category_list');
        }
        return redirect()->route('user#home');
    }

    public function changePasswordPage(){
        return view('admin.password.change');
    }

    public function changePassword(Request $request){
        // validate
        $this->validatePassword($request);
        // take db password
        $currentUserId = Auth::user()->id;
        $dbPassword = User::where('id',$currentUserId)->first()->toArray()['password'];
        if(Hash::check($request->oldPassword, $dbPassword)){
            User::where('id',$currentUserId)->update([
                'password'=>Hash::make($request->newPassword),
            ]);
            return redirect()->route('admin#category_list');
        }else{
            return back()->with(['notMatch'=>"The Credential doesn't match ..."]);
        }
    }

    // validate function
    private function validatePassword($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6|',
            'newPassword' => 'required|min:6|',
            'confirmPassword'=> 'required|min:6|same:newPassword',
        ])->validate();
    }

}
