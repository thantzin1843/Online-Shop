@extends('admin.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Role</h3>
                        </div>
                        <hr>
                        <form action="{{route('admin#change_role')}}" method='post' enctype="multipart/form-data">
                            @csrf
                            <div class='d-flex row'>
                                <div class='col-6'>
                                    @if ($admin[0]->image == null)
                                    <img class='' style='border:2px solid gray ;border-radius:5px;' src="{{asset('image/default_user.png')}}" alt="John Doe" />
                                    @else
                                        <img src="{{asset('storage/'.$admin->image)}}" alt="John Doe" style="width:100%;"/>
                                        {{-- <video src="{{asset('storage/'.Auth::user()->image)}}" controls></video> --}}
                                    @endif
                                    <input type="file" class="form-control mt-3  btn btn-secondary " name='image' disabled>
                                </div>
                                <div class='col-6'>
                                    <table class='col-12 h-75' >
                                        <input type="hidden" name="id" value={{$admin[0]->id}}>
                                        <tr>
                                            <td>Name</td>
                                            <td style='border-bottom:2px solid black'><input type="text" disabled  class='form-control' name="name" value='{{$admin[0]->name}}'></td>


                                        </tr>
                                        <tr>

                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td style='border-bottom:2px solid black'><input type="email" disabled class='form-control' name="email" value='{{$admin[0]->email}}'></td>
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td style='border-bottom:2px solid black'><input type="number" disabled class='form-control' name="phone" value='{{$admin[0]->phone}}'></td>
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td style='border-bottom:2px solid black'><input type="text" disabled class='form-control' name="address" value='{{$admin[0]->address}}'></td>
                                            <td>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Role</td>
                                            <td style='border-bottom:2px solid black'>
                                            <select name="role" id="" class='form-control'>
                                                <option value="admin" @if($admin[0]->role == 'admin') selected @endif>Admin</option>
                                                <option value="user" @if($admin[0]->role == 'user') selected @endif>User</option>
                                            </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sign Up Date</td>
                                            <td style='border-bottom:2px solid black'><input type="text" disabled class='form-control' name="date" value='{{$admin[0]->created_at->format('d/m/Y')}}' disabled></td>
                                        </tr>
                                    </table>

                                    <input type="submit" value="Change role" class='btn btn-primary mt-3 ' style='margin-left:200px;'>
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

