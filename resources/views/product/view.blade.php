@extends('admin.master')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
    <style>
       .a{
            background:#fff;
            border:1px solid #e5e9f2;;
            box-shadow: 0 0.25rem 0.5rem rgb(0 0 0 / 3%);
            width:94%;
            height:72%;
        }
    </style>
</head>
<body>
@if(session('message'))
   <p class="alert alert-danger" style="width:94%;margin-left: 31px;">
      {{session('message')}}
   </p>
@endif
   <div class="container-fluid a">
    <div class="table-responsive" style="margin-left: 15px;padding-right: 29px;margin-top: 25px;">
      <table class="table table-bordered">
        <tr>
           <th>Id</th>
           <th>Categories Name</th>
           <th>Product Name</th>
           <th>Product Code</th>
           <th>Size</th>
           <th>Color</th>
           <th>Long Description</th>
           <th>Short Description</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Image</th>
           <th>Featured Product</th>
           <th>Popular Product</th>
           <th>Latest Product</th>
           <th>Status</th>
        </tr>
        <?php $i=1;?>
        <tr>
           <td>{{$i++}}</td>
           <td>{{$data->categories_name}}</td>
           <td>{{$data->product_name}}</td>
           <td>{{$data->product_code}}</td>
           <td>{{$data->size}}</td>
           <td>{{$data->color}}</td>
           <td>{{$data->long_description}}</td>
           <td>{{$data->short_description}}</td>
           <td>{{$data->price}}</td>
           <td>{{$data->quantity}}</td>
           <td><img src="{{url('upload/' .$data->image)}}" style="width: 108px;height: 110px;border-radius: 20%;"></td>
           <td>{{$data->featured_product}}</td>
           <td>{{$data->popular_product}}</td>
           <td>{{$data->latest_product}}</td>
           <td>{{$data->status}}</td>
        </tr>
      </table>
    </div>
   </div>
    
</body>
</html>
@endsection