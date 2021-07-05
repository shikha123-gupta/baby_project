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
            <h4>Categories Form</h4>
            <hr>
          </div>
          <div class="card-body">
            <form action="{{url('/categories/update')}}" method="post" enctype="multipart/form-data">
               <input type="hidden" name="id" value="{{$data->id}}">
            {{csrf_field()}}
               <div class="form-group">
                  <label> Categories Name :</label>
                  <input type="text" name="name" class="form-control" value="{{$data->categories_name}}">
               </div>
               <br>
               <div class="form-group">
                  <label>Image :</label>
                  <input type="file" name="image">
                  <img src="{{url('/upload/'. $data->image)}}" style="width:71px;height:70px;border-radius:100%">
               </div>
               <br>
               <input type="submit" name="submit" value="Update" class="btn btn-danger form-control">
            </form>
          </div>
       </div>
    </div>
</body>
</html>
<br>
<br>
<br>
@endsection