@extends('admin.layouts.master')

@section('content')
       <div style='margin-top:100px;'>
        @if (count($messages) == 0)
        <div class="carousel-item active">
            <div class="carousel-item active">
                <div class="card col-8 offset-2 text-center" style='margin-top:100px;font-size:30px;' >
                   No Message To Show
                  </div>
                </div>
        </div>
        @else
        @foreach ($messages as $message)
        <div class="carousel-item active">
        <div class="card col-8 offset-2 " style='' >
            <div class="card-header d-flex">
              {{$message->name}} <a href="{{route('delete#message',$message->id)}}" class='offset-10'><i class="fa-solid fa-delete-left" style='font-size:25px;'></i></a>
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <p>{{$message->message}}</p>
                <footer class="blockquote-footer">from <cite title="Source Title">{{$message->email}}</cite></footer>
              </blockquote>
            </div>
          </div>
        </div>
    @endforeach
        @endif

       </div>
@endsection
