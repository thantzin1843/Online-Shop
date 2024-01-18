<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fontfaces CSS-->
    <link href="{{asset('admin/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('admin/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{asset('admin/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('admin/css/theme.css')}}" rel="stylesheet" media="all">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo bg-white">
                <a href="#" class='offset-2'>
                    <img src="{{asset('image/logo.png')}}" alt="Cool Admin" style='width:100px;'/>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="{{route('admin#category_list')}}">
                                <i class="fa-solid fa-list"></i>Category
                            </a>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="{{route('product#listPage')}}">
                                <i class="fa-sharp fa-solid fa-pizza-slice"></i>Product
                            </a>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="{{route('admin#userOrder')}}">
                                <i class="fas fa-tachometer-alt"></i>Orders
                            </a>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="{{route('admin#user_list')}}">
                                <i class="fas fa-tachometer-alt"></i>Users
                            </a>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="{{route('admin#contact')}}">
                                <i class="fas fa-tachometer-alt"></i>Contact Messages
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div class="header-button offset-10">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            @if (Auth::user()->image == null)
                                            <img src="{{asset('image/default_user.png')}}" alt="John Doe" />
                                            @else
                                                <img src="{{asset('storage/'.Auth::user()->image)}}" alt="John Doe" />
                                            @endif
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{Auth::user()->name}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        @if (Auth::user()->image == null)
                                                        <img src="{{asset('image/default_user.png')}}" alt="John Doe" />
                                                        @else
                                                            <img src="{{asset('storage/'.Auth::user()->image)}}" alt="John Doe" />
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{Auth::user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{Auth::user()->email}}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('account#details')}}">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('admin#list')}}">
                                                        <i class="zmdi zmdi-accounts"></i>Admins List</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="{{route('admin#passwordChangePage')}}">
                                                        <i class="zmdi zmdi-account"></i>Change Password</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <form action="{{route('logout')}}" method="post">
                                                @csrf
                                                <input type="submit" value="Log out" class='btn btn-dark col-12'>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <!-- DATA TABLE -->
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="overview-wrap">
                                        <h2 class="title-1">Orders List</h2>

                                    </div>
                                    <form method='get' class='col-12 ' action={{route('order#search')}}>
                                        @csrf
                                        <div class="d-flex">
                                            <div><select name="orderStatus" id="orderStatus" class='form-select' style='margin-right:10px;'>
                                                <option value="">All</option>
                                                <option value="0"  @if(request()->orderStatus==0) selected @endif>Pending</option>
                                                <option value="1" @if(request()->orderStatus==1) selected @endif>Success</option>
                                                <option value="2" @if(request()->orderStatus==2) selected @endif>Reject</option>
                                            </select></div>
                                            <div><button type='submit' class='btn btn-primary'>Search</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2" id='dTable'>
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>User Name </th>
                                            <th>Order Date</th>
                                            <th>Order Code</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id='tbody'>
                                       @foreach ($orders as $order)
                                       <tr class="tr-shadow">
                                        <td>{{$order->user_id}}</td>
                                        <td>{{$order->user_name}}</td>
                                        <td>{{$order->created_at->format('M-d-Y')}}</td>
                                        <td><a href='{{route('order#detail',$order->order_code)}}'>{{$order->order_code}}</a></td>
                                        <td>{{$order->total_price}}</td>
                                        <input type="hidden" value='{{$order->id}}' id="orderId">
                                        <td>
                                           <select name=""  class='form-select statusChange'>
                                            <option value="1" @if($order->status==1) selected @endif>Success</option>
                                            <option value="0" @if($order->status==0) selected @endif>Pending</option>
                                            <option value="2" @if($order->status==2) selected @endif>Reject</option>
                                           </select>
                                        </td>
                                    </tr>
                                    <tr class="spacer"> </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- END DATA TABLE -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{asset('admin/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('admin/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{asset('admin/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{asset('admin/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('admin/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{asset('admin/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('admin/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{asset('admin/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('admin/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('admin/vendor/select2/select2.min.js')}}">
    </script>

    <!-- Main JS-->
    <script src="{{asset('admin/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>


<script>
    // $(document).ready(function(){
    //     $('#orderStatus').change(function(){
    //         $status = $('#orderStatus').val();
    //         // console.log($status)
    //         $.ajax({
    //             type:'get',
    //             url:'http://127.0.0.1:8000/ajax/orderStatus',
    //             dataType:'json',
    //             data:{
    //                 'status':$status
    //             },
    //             success:function(response){
    //                 $orderList = '';

    //                 for($i=0;$i<response.length;$i++){
    //                     $statusMessage = '';
    //                 // date format section
    //                 let dbDate = new Date(response[$i].created_at);
    //                 let day = dbDate.getDay();
    //                 let month = dbDate.getMonth();
    //                 let year = dbDate.getFullYear();
    //                 let months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    //                 if(response[$i].status == 0){
    //                         $statusMessage = `

    //                             <select class='form-select' id='statusChange'>
    //                                 <option value='0' selected>Pending</option>
    //                                 <option value='1'>Success</option>
    //                                 <option value='2'>Reject</option>
    //                             </select>`;
    //                     }else if(response[$i].status == 1){
    //                         $statusMessage = `

    //                             <select class='form-select' id='statusChange'>
    //                                 <option value='0' >Pending</option>
    //                                 <option value='1' selected>Success</option>
    //                                 <option value='2'>Reject</option>
    //                             </select>`;
    //                     }else if(response[$i].status == 2){
    //                         $statusMessage = `

    //                             <select class='form-select' id='statusChange'>
    //                                 <option value='0' >Pending</option>
    //                                 <option value='1' >Success</option>
    //                                 <option value='2' selected>Reject</option>
    //                             </select>`
    //                     }
    //                     $orderList += `
    //                     <tr class="tr-shadow">
    //                         <td>${response[$i].user_id}</td>
    //                         <td>${response[$i].user_name}</td>
    //                         <td>${months[month]+'-'+day+'-'+year}</td>
    //                         <td>${response[$i].order_code}</td>
    //                         <td>${response[$i].total_price}</td>
    //                         <td>${$statusMessage}</td>
    //                     `;
    //                 }
    //                 $('#tbody').html($orderList);
    //                 if(response.length == 0){
    //                     $('#tbody').html("")
    //                 }
    //             }
    //         })
    //     })


    // })

        $(document).ready(function(){
        $('.statusChange').change(function(){
            $statusValue = $(this).val();
            $parentNode = $(this).parents('tbody tr');
            $orderId = $parentNode.find('#orderId').val();

            $data = {
                'orderId':$orderId,
                'status':$statusValue,
            }
            $.ajax({
                type:'get',
                url:'http://127.0.0.1:8000/ajax/change/status',
                data:$data,
                dataType:'json',
                success:function(response){
                    console.log(response);
                }
            })
        })
        })
</script>
</html>
<!-- end document-->

