@extends('user.layout.master')

@section('content')
<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0" id='dataTable'>
                <thead class="thead-dark">
                    <thead>
                        <th class='text-success'><div class='btn btn-dark'><a href='{{route('user#home')}}'><i class="fa-solid fa-arrow-left"></i>&nbsp;&nbsp;Back</a></div></th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </thead>
                </thead>
                <tbody class="align-middle">
                    @foreach ($products as $product)

                    <tr>
                        {{-- <input type="hidden" name="" value="{{$product->price}}" id='price'> --}}
                        <input type="hidden" name="" id="userId" value="{{$product->user_id}}">
                        <input type="hidden" name="" id="productId" value="{{$product->product_id}}">
                        <td><img src="{{asset('storage/'.$product->image)}}" alt="" style="width: 150px;height:150px;"> </td>
                        <td class="align-middle">{{$product->product_name}}</td>
                        <td class="align-middle" id='price'>{{$product->price}}</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" id='qty' class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$product->quantity}}" max='20'>
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle" id='total'>{{$product->price*$product->quantity}}</td>
                        <td class="align-middle"><a href='{{route('cart#delete',$product->product_id)}}'><button class="btn btn-sm btn-danger remove"><i class="fa fa-times"></i></button></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 id='subtotal'>{{$subtotal}} Kyats</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">3000 Kyats</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id='finalTotal'>{{$subtotal+3000}} Kyats</h5>
                    </div>
                    <button type='button' id='checkOut' class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('.btn-plus').click(function(){
                $parentNode = $(this).parents('tr');
                $price = Number($parentNode.find('#price').html());
                $qty= $parentNode.find('#qty').val();
                // console.log($price,$qty);
                $totalPrice = $price*$qty;
                // console.log($totalPrice)
                $parentNode.find('#total').html($totalPrice);

                // $subtotal = Number($('#subtotal').html());
                summaryCaculation();
            })

            $('.btn-minus').click(function(){
                $parentNode = $(this).parents('tr');
                $price = Number($parentNode.find('#price').html());
                $qty= $parentNode.find('#qty').val();
                // console.log($price,$qty);
                $totalPrice = $price*$qty;
                // console.log($totalPrice)
                $parentNode.find('#total').html($totalPrice);
                summaryCaculation();
            })

            $('.remove').click(function(){
                $parentNode = $(this).parents('tr');
                $parentNode.remove();

                summaryCaculation();
            })

            function summaryCaculation(){
                $total = 0;
                $('#dataTable tr').each(function(index,row){
                    $total+= Number($(row).find('#total').text());
                })
                // console.log($total);
                $('#subtotal').html($total);
                $('#finalTotal').html($total+3000);
            }

            $orderList = [];
            $('#checkOut').click(function(){
                $randomNumber = Math.floor(Math.random()*100000001);
                $('#dataTable tbody tr').each(function(index,row){
                    $productId = $(row).find('#productId').val();
                    $userId = $(row).find('#userId').val();
                    $quantity = $(row).find('#qty').val();
                    $total = $(row).find('#total').html();
                    $orderList.push({
                        'user_id':$userId,
                        'product_id':$productId,
                        'quantity':$quantity,
                        'total':$total,
                        'order_code':$randomNumber,
                    })
                })
               $data = Object.assign({},$orderList)
                $.ajax({
                   type:'get',
                    url:'http://127.0.0.1:8000/user/ajax/orderList',
                    dataType:'json',
                    data:$data,
                    success:function(response){
                        // console.log(response.message)
                        if(response.status == 'success'){
                            window.location.href = "http://127.0.0.1:8000/user/home";
                        }
                    }
                })
            })

        })

    </script>
@endsection


{{-- //  // find parent of fa-plus
//  $parentNode = $(this).parents("tr");
// // get price and find price from parent node
// $quantity = Number($parentNode.find('#qty').val())-1;
// if(Number($parentNode.find('#qty').val()) == 0){
//     $quantity = Number($parentNode.find('#qty').val());
// }
// $price = $parentNode.find('#price').val();
// $total = $quantity*$price;
// $parentNode.find('#total').html($total); --}}
