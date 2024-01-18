@extends('user.layout.master')

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
                        <div class='d-flex row p-3'>
                            <div class='col-5'>
                                @if (Auth::user()->image == null)
                                <img class='' style='border:2px solid gray ;border-radius:5px; width:400px;' src="{{asset('image/default_user.png')}}" alt="John Doe" />
                                @else
                                    <img src="{{asset('storage/'.Auth::user()->image)}}" alt="John Doe" style=' width:400px;'/>
                                @endif
                            </div>
                            <div class='col-6'>
                                <table class='col-12 h-75' >
                                    <tr>
                                        <td>Name</td>
                                        <td style='border-bottom:2px solid black'>{{Auth::user()->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td style='border-bottom:2px solid black'>{{Auth::user()->email}}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td style='border-bottom:2px solid black'>{{Auth::user()->phone}}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td style='border-bottom:2px solid black'>{{Auth::user()->address}}</td>
                                    </tr>
                                    <tr>
                                        <td>Role</td>
                                        <td style='border-bottom:2px solid black'>{{Auth::user()->role}}</td>
                                    </tr>
                                    <tr>
                                        <td>Sign Up Date</td>
                                        <td style='border-bottom:2px solid black'>{{Auth::user()->created_at->format('d/m/Y')}}</td>
                                    </tr>
                                </table>

                                <a href="{{route('account#edit')}}" class='btn btn-dark w-50 mt-5'>Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

