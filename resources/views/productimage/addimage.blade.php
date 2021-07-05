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
        h4{
            color: #756f68;
            margin-top: 8px;
            margin-bottom: 18px;
        }
    </style>
</head>
<body>
      @if(session('message'))
         <p class="alert alert-success" style="width:94%;margin-left: 33px;">
           {{session('message')}}
         </p>
      @endif
   <div class="container-fluid a">
      <div class="card-shadow">
         <div class="card-heading">
            <h4>Product Form</h4>
            <hr>
          </div>
          <div class="card-body">
            <form action="{{url('/productimage/save')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
               <div class="form-group">
                  <label> Product Id :</label>
                  @foreach($dataa as $d)
                  <input type="text" name="product_id" class="form-control" value="{{$d->id}}">
                  @endforeach
               </div>
               <br>
               <div class="form-group">
                  <label>Image :</label>
                  <input type="file" name="image">
               </div>
               <br>
               <input type="submit" name="submit" value="Submit" class="btn btn-danger form-control">
            </form>
          </div>
       </div>
    </div>
    <br><br>
    <div class="container-fluid a">
      <div class="card-shadow">
         <div class="card-heading">
            <h4>Display Product Image</h4>
            <hr>
          </div>
          <div class="card-body">
          <div class="table-responsive" style="margin-left: 15px;padding-right: 29px;margin-top: 25px;">
      <table class="table table-bordered">
        <tr>
           <th>Id</th>
           <th>Product Id</th>
           <th>Image</th>
           <th>Status</th>
           <th>Action</th>
        </tr>
        @foreach($display as $a)
        <tr>
           <td>{{$a->id}}</td>
           <td>{{$a->product_id}}</td>
           <td><img src="{{ url('/upload/'.$a->image) }}" style="height: 70px; width: 70px;border-radius: 80%; "></td> 
           <td>{{$a->status}}</td>
           <td>
             <a href="{{url('/productimage/view/' .$a->id)}}" class="btn btn-sm btn-outline-danger" style="font-weight:600">View</a>
             <a href="{{url('/productimage/edit/' .$a->id)}}" class="btn btn-sm btn-outline-danger" style="font-weight:600">Edit</a>
             <a href="{{url('/productimage/delete/' .$a->id)}}" class="btn btn-sm btn-outline-danger" style="font-weight:600">Delete</a>
           </td>
        </tr>
        @endforeach
      </table>
          </div>
       </div>
    </div>
</body>
</html>
<br>
<br>
@endsection