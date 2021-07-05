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
           <th>Color</th>
           <th>Status</th>
           <th>Action</th>
        </tr>
        <?php $i=1;?>
        @foreach($data as $a)
        <tr>
           <td>{{$i++}}</td>
           <td>{{$a->color}}</td>
           <td>{{$a->status}}</td>
           <td>
             <a href="{{url('/color/view/' .$a->id)}}" class="btn btn-sm btn-outline-danger" style="font-weight:600">View</a>
             <a href="{{url('/color/edit/' .$a->id)}}" class="btn btn-sm btn-outline-danger" style="font-weight:600">Edit</a>
             <a href="{{url('/color/delete/' .$a->id)}}" class="btn btn-sm btn-outline-danger" style="font-weight:600">Delete</a>
           </td>
        </tr>
        @endforeach
      </table>
    </div>
   </div>
    
</body>
</html>
@endsection