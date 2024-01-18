@extends('admin.layouts.master')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{route('product#listPage')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Products</h3>
                        </div>
                        <hr>
                        <form action="{{route('product#update')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value='{{$product->id}}'>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Pizza Name</label>
                                <input id="cc-pament" name="name" type="text" class="form-control" aria-required="true" value='{{$product->product_name}}' aria-invalid="false" placeholder="Enter Name">
                                @error('name')
                                    <small class='text-danger'>{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Price</label>
                                <input id="cc-pament" name="price" type="number" class="form-control" aria-required="true" value='{{$product->price}}' aria-invalid="false" placeholder="Enter Price">
                                @error('price')
                                    <small class='text-danger'>{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1"> Choose Category</label>
                                <select name="category" class='form-control'>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}" class='text-danger' @if($category->id == $product->category_id) selected @endif>{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <small class='text-danger'>{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Image</label>
                                <input id="cc-pament" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter image">
                                @error('image')
                                    <small class='text-danger'>{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Description</label>
                               <textarea name="description"  cols="40" rows="10" style='border:1px solid black'> {{$product->description}} </textarea>
                                @error('description')
                                    <small class='text-danger'>{{$message}}</small>
                                @enderror
                            </div>


                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Update Pizza</span>

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
