@extends('admin.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password</h3>
                        </div>
                        <hr>
                        <form action="{{route('password#change')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                <input id="cc-pament" name="oldPassword"  type="password" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Old Password" value="">
                                @error('oldPassword')
                                    <small class='text-danger'>{{$message}}</small>
                                @enderror
                                @if(session('notMatch'))
                                    <small class='text-danger'>{{session('notMatch')}}</small>

                                @endif
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">New Password</label>
                                <input id="cc-pament" name="newPassword"  type="password" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter New Password" value="">
                                @error('newPassword')
                                    <small class='text-danger'>{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                <input id="cc-pament" name="confirmPassword"  type="password" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Confirm Password" value="">
                                @error('confirmPassword')
                                    <small class='text-danger'>{{$message}}</small>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Change Password </span>

                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

