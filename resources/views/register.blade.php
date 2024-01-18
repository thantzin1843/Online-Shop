@extends('admin.master')
@section('title', 'Register Page')
@section('content')
<div class="login-form">

    <form action="{{route('register')}}" method="post">
        @csrf
        <div class="form-group" style='margin-top:20px'>
            <label>Username</label>
            <input class="au-input au-input--full" type="text" name="username" placeholder="Username">
            @error('name')
                <small class='text-danger'>{{$message}}</small>
            @enderror
        </div>
        <div class="form-group" style='margin-top:20px'>
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
            @error('email')
            <small class='text-danger'>{{$message}}</small>
            @enderror
        </div>
        <div class="form-group" style='margin-top:20px'>
            <label>Phone</label>
            <input class="au-input au-input--full" type="number" name="phone" placeholder="Phone">
             @error('phone')
                <small class='text-danger'>{{$message}}</small>
            @enderror
        </div>
        <div class="form-group" style='margin-top:20px'>
            <label> Address</label>
            <input class="au-input au-input--full" type="text" name="address" placeholder="Address">
             @error('address')
                <small class='text-danger'>{{$message}}</small>
            @enderror
        </div>
        <div class="form-group" style='margin-top:20px'>
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
             @error('password')
                <small class='text-danger'>{{$message}}</small>
            @enderror
        </div>
        <div class="form-group" style='margin-top:20px'>
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password_confirmation" placeholder="Confirm Password">
             @error('password_confirmation')
                <small class='text-danger'>{{$message}}</small>
            @enderror
        </div>

        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

    </form>
    <div class="register-link">
        <p>
            Already have account?
            <a href="{{route('auth#login')}}">Sign In</a>
        </p>
    </div>
</div>
@endsection
