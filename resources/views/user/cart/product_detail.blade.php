@extends('user.layout.master')

@section('content')
    <!-- Shop Detail Start -->
    <div class='btn btn-dark mx-5 my-2'>
        <a href='{{route('user#home')}}'><i class="fa-solid fa-arrow-left"></i>&nbsp;&nbsp;Back</a>
    </div>
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">

                        <div class="carousel-item active">
                            <img class="" style='width:100%;height:500px;' src="{{asset('storage/'.$pizza[0]->image)}}" alt="Image">
                        </div>
                        @foreach ($pizzas as $piz)
                        <div class="carousel-item">
                            <img class="" style='width:100%;height:500px;' src="{{asset('storage/'.$piz->image)}}" alt="Image">
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{$pizza[0]->product_name}}</h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <div>
                           | <strong class="pt-1"><i class="far fa-eye"></i>&nbsp;{{$pizza[0]->view_count+1}}</strong>
                        </div>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{$pizza[0]->price}} Ks</h3>
                    <input type="hidden" value='{{$pizza[0]->id}}' id='pizzaId'>
                    <input type="hidden" value='{{Auth::user()->id}}' id='userId'>
                    <p class="mb-4">{{$pizza[0]->description}}</p>
                        <div class="d-flex align-items-center mb-4 pt-2">
                            <div class="input-group quantity mr-3" style="width: 130px;">
                                <div class="input-group-btn">

                                        <button class="btn btn-primary btn-minus">
                                            <i class="fa fa-minus"></i>
                                        </button>

                                </div>
                                <input type="text" id='quantity' name='quantity' class="form-control bg-secondary border-0 text-center" value="1" max='20'>
                                <div class="input-group-btn">

                                        <button class="btn btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>

                                </div>
                            </div>
                            <button class="btn btn-primary px-3" type="button" id='addToCart'><i class="fa fa-shopping-cart mr-1"></i> Add To
                                Cart</button>
                        </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                    <div class='m-3'>
                        <form action='{{route('post#comment')}}' method='post'>
                            @csrf
                            <input type="hidden" name="pizzaId" value='{{$pizza[0]->id}}'>
                            <textarea name="message" id="" cols="60" rows="5"></textarea>
                            <button type='submit' class='btn btn-sm btn-dark'>Post Comment</button>
                        </form>
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Comments
                        </a>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                              @foreach ($comments as $comment)
                              <div class='commentContainer' style='border-bottom:1px solid black;'>
                                <div>
                                   @if ($comment->image != null)
                                   <img src="{{asset('storage/'.$comment->image)}}" alt="" style='width:50px;border-radius:50%;'>
                                   @else
                                   <img src="{{asset('storage/default_user.png')}}" alt="" style='width:50px;border-radius:50%;margin:15px;'>
                                   @endif<span style='color:brown;font-weight:bold;margin:5px;'>{{$comment->name}}</span>
                                </div>
                                <div>
                                    {{$comment->comment}}
                                </div>
                              </div>
                              @endforeach
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">

                    @foreach ($pizzas as $piz)
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid" style='width:300px;height:300px;' src="{{asset('storage/'.$piz->image)}}" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{route('product#detail',$piz->id)}}"><i class="fa fa-eye"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{$piz->product_name}}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{$piz->price}}</h5><h6 class="text-muted ml-2"><del>{{$piz->price}}</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            // view count
            $userId = $('#userId').val();
            $productId = $('#pizzaId').val();
            $data = {
                'user_id':$userId,
                'product_id':$productId
            }
            $.ajax({
                type:'get',
                url:'http://127.0.0.1:8000/user/ajax/viewcount',
                dataType:'json',
                data:$data,
                success:function(response){

                }
            })


            $('#addToCart').click(function(){
                $source = {
                    'userId':$('#userId').val(),
                    'pizzaId':$('#pizzaId').val(),
                    'quantity':$('#quantity').val()
                }

                $.ajax({
                    type:'get',
                    url:'http://127.0.0.1:8000/user/ajax/addToCart',
                    data:$source,
                    dataType:'json',
                    success:function(response){
                        if(response.status == 'success'){
                            window.location.href="http://127.0.0.1:8000/user/home";
                        }
                    }
                })
            })
        })
    </script>
@endsection
