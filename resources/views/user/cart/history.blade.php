@extends('user.layout.master')

@section('content')
<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
            <table class="table table-dark table-borderless table-hover text-center mb-0" id='dataTable'>
                <thead class="thead-dark">
                    <thead>
                        <th class='text-success'><div class='btn btn-dark'><a href='{{route('user#home')}}'><i class="fa-solid fa-arrow-left"></i>&nbsp;&nbsp;Back</a></div></th>
                        <th>Date</th>
                        <th>Order ID</th>
                        <th>Total Price</th>
                        <th>Status</th>
                    </thead>
                </thead>
                <tbody class="align-middle">
                    @foreach ($orderItems as $item)
                    <tr>
                        <td></td>
                        <td>{{$item->created_at->format('d-m-Y')}}</td>
                        <td>{{$item->order_code}}</td>
                        <td>{{$item->total_price}} Kyats</td>
                        <td>
                            @if ($item->status == 0)
                                <span class='text-primary'>Pending...</span>
                            @elseif ($item->status == 1)
                            <span class='text-success'>Success</span>
                            @else
                            <span class='text-danger'>Reject</span>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection


