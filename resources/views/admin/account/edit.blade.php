@extends('admin.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Details</h3>
                        </div>
                        <hr>
                        <form action="{{route('admin_account#update')}}" method='post' enctype="multipart/form-data">
                            @csrf
                            <div class='d-flex row'>
                                <div class='col-6'>
                                    @if (Auth::user()->image == null)
                                    <img class='' style='border:2px solid gray ;border-radius:5px;' src="{{asset('image/default_user.png')}}" alt="John Doe" />
                                    @else
                                        <img src="{{asset('storage/'.Auth::user()->image)}}" alt="John Doe" style="width:100%;"/>
                                        {{-- <video src="{{asset('storage/'.Auth::user()->image)}}" controls></video> --}}
                                    @endif
                                    <input type="file" class="form-control mt-3  btn btn-secondary " name='image'>
                                </div>
                                <div class='col-6'>
                                    <table class='col-12 h-75' >
                                        <tr>
                                            <td>Name</td>
                                            <td style='border-bottom:2px solid black'><input type="text"  class='form-control' name="name" value='{{Auth::user()->name}}'></td>


                                        </tr>
                                        <tr>
                                            @error('name')
                                                <small class='text-danger'>{{$message}}</small>
                                            @enderror
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td style='border-bottom:2px solid black'><input type="email" class='form-control' name="email" value='{{Auth::user()->email}}'></td>
                                            <td>
                                                @error('email')
                                                <small class='text-danger'>{{$message}}</small>
                                            @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td style='border-bottom:2px solid black'><input type="number" class='form-control' name="phone" value='{{Auth::user()->phone}}'></td>
                                            <td>
                                                @error('phone')
                                                <small class='text-danger'>{{$message}}</small>
                                            @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td style='border-bottom:2px solid black'><input type="text" class='form-control' name="address" value='{{Auth::user()->address}}'></td>
                                            <td>
                                                @error('address')
                                                <small class='text-danger'>{{$message}}</small>
                                            @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Role</td>
                                            <td style='border-bottom:2px solid black'><input type="text"  class='form-control' name="role" value='{{Auth::user()->role}}' disabled></td>
                                        </tr>
                                        <tr>
                                            <td>Sign Up Date</td>
                                            <td style='border-bottom:2px solid black'><input type="text" class='form-control' name="date" value='{{Auth::user()->created_at->format('d/m/Y')}}' disabled></td>
                                        </tr>
                                    </table>

                                    <input type="submit" value="Update Profile" class='btn btn-primary mt-3 ' style='margin-left:200px;'>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

