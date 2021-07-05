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
            <h4>Coupon Form</h4>
            <hr>
          </div>
          <div class="card-body">
            <form action="{{url('/coupon/save')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
               <div class="form-group">
                  <label> Title :</label>
                  <input type="text" name="title" class="form-control">
               </div>
               <br>
               <div class="form-group">
                  <label> Code :</label>
                  <input type="text" name="code" class="form-control">
               </div>
               <br>
               <div class="form-group">
                  <label> Value :</label>
                  <select name="value" class="form-control">
                     <option>Select</option>
                     <option>30%</option>
                     <option>40%</option>
                     <option>50%</option>
                     <option>60%</option>
                  </select>
               </div>
               <br>
               <input type="submit" name="submit" value="Submit" class="btn btn-danger form-control">
            </form>
          </div>
       </div>
    </div>
</body>
</html>
<br>
<br>
@endsection