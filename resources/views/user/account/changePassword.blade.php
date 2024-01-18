@extends('user.layout.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change User Password</h3>
                        </div>
                        <hr>
                        <form action="{{route('user#changePassword')}}" method="post" novalidate="novalidate">
                            @csrf
                            {{-- @if(session('changed'))
                                <div class="alert alert-danger alert-dismissible fade show col-5 offset-7" role="alert">
                                    <strong>{{session('deleteSuccess')}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>
                                @endif --}}
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
                                <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block">
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

