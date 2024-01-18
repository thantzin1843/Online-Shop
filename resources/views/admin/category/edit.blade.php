@extends('admin.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{route('admin#category_list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Category</h3>
                        </div>
                        <hr>
                        <form action="{{route('category#update')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="category_id" value="{{$category->id}}">
                                <label for="cc-payment" class="control-label mb-1">Category Name</label>
                                <input id="cc-pament" name="categoryName"  type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Seafood..." value="{{$category->category_name}}">
                                @error('categoryName')
                                    <small class='text-danger'>{{$message}}</small>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Update </span>

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
