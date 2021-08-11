@extends('front.master');
@section('content')
  <div class="trending-wrapper">
      <h4>result for product</h4>
      @foreach($data as $a)
        <div class="searched-item">
            <a href="{{$a['id']}}">
                <img src="{{url('upload/'.$a->image)}}">
                <div class="">
                    <h2>{{$a['product_name']}}</h2>
                    <h2>{{$a['price']}}</h2>
                </div>
            </a>
        </div>
      @endforeach
</div>
@endsection