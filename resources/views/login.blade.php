@extends('admin.master');  

@section('title', 'Log In Page')
@section('content')
<div class="login-form">
    @if(session('match'))
    <div class="alert alert-success alert-dismissible fade show col-5 offset-7" role="alert">
        <strong>{{session('match')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
     @endif
    <form action="{{route('login')}}" method="post">
        @csrf
        <div class="form-group " style='margin-top:10px'>
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
            @error('email')
                <small class='text-danger'>{{$message}}</small>
            @enderror
        </div>
        <div class="form-group" style='margin-top:10px'>
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
            @error('password')
                <small class='text-danger'>{{$message}}</small>
            @enderror
        </div>

        <button class="au-btn au-btn--block au-btn--green m-b-20" style='margin-top:10px' type="submit">sign in</button>

    </form>
    <div class="register-link">
        <p>
            Don't you have account?
            <a href={{url('registerPage')}}>Sign Up Here</a>
        </p>
    </div>
</div>
@endsection
