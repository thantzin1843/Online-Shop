

@extends('user.layout.master')
@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4" >
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by categories</span></h5>
                <div class="bg-light p-4 mb-30" style='position:sticky; top:50px;'>
                    <form>
                        <div class="custom-control bg-dark pt-2 px-2 text-secondary custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all">
                            <label class="" for="price-all">Category</label>
                            <span class="badge border font-weight-normal">{{count($categories)}}</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            {{-- <input type="checkbox" class="custom-control-input" id="price-1"> --}}
                            <a href="{{route('user#home')}}"><label class='text-dark' for="price-1">All</label></a>
                        </div>
                        @foreach ($categories as $category)
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            {{-- <input type="checkbox" class="custom-control-input" id="price-1"> --}}
                            <a href="{{route('user#filter',$category->id)}}"><label class='text-dark' for="price-1">{{$category->category_name}}</label></a>
                        </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                              <a href="{{route('cart#detail')}}"> <button class='btn btn-dark border-rounded'> <i class="fa-solid fa-cart-shopping" style="color:yellow"></i>&nbsp;{{count($cartProducts)}}</button></a>
                              <a href="{{route('order#historyPage')}}"> <button class='btn btn-dark border-rounded'> &nbsp;History {{count($orderItems)}}</button></a>
                            </div>
                            <div class="ml-2">
                                    <select name="option" id="sortingOption" class='form-select bg-dark p-2 text-warning border-rounded'>
                                        <option value="">Sort</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                            </div>
                        </div>
                    </div>

                        <div class='col-lg-12 col-md-8'>
                            <div class="row pb-3" id='myForm'>
                            @if (count($products) != 0)
                            @foreach ($products as $product)
                            <div class="col-lg-4 col-md-2 col-sm-6 pb-1" >
                                <div class="product-item bg-light mb-4" >
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style='height:300px' src="{{asset('storage/'.$product->image)}}" alt="">
                                      <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href="{{route('product#detail',$product->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href="{{route('product#detail',$product->id)}}"><i class="far fa-eye"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">{{$product->product_name}}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{$product->price}}Ks</h5><h6 class="text-muted ml-2"><del></del></h6>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                                <div>There is no pizza to show.</div>

                            @endif
                        </div>
                        </div>

            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

@endsection

@section('js')
<script>

    $('#sortingOption').change(function(){
        $opt = $('#sortingOption').val();
        if($opt=='asc'){
            $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/user/ajax/product/list',
            data:{'status':'asc'},
            dataType:'json',
            success:function(response){
                $list = '';
                for($i =0;$i<response.length; $i++){
                    $list += `
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1"  >
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" style='height:300px;' src="{{asset('storage/${response[$i].image}')}}" alt="">
                                  <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].product_name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price}Ks</h5><h6 class="text-muted ml-2"><del></del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#myForm').html($list);
                }
            }
        })
        }else if($opt=='desc'){
            $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/user/ajax/product/list',
            data:{'status':'desc'},
            dataType:'json',
            success:function(response){
                $list = '';
                for($i =0;$i<response.length; $i++){
                    $list += `
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1"  >
                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" style='height:300px' src="{{asset('storage/${response[$i].image}')}}" alt="">
                                  <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].product_name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price}Ks</h5><h6 class="text-muted ml-2"><del></del></h6>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#myForm').html($list);
                }
                console.log(response);
            }
        })
        }
    })
</script>
@endsection
