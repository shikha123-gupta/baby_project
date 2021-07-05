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
            <form action="{{url('/product/save')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                  <label>Categories :</label>
                  <select name="cat_id" id="cat_id" class="form-control">
                  <option value="0">categories</option>
                  @foreach($categories as $cat)
                    <option value="{{$cat->id}}">{{$cat->categories_name}}</option>
                  @endforeach
                  </select>
               </div>
               <br>
               <div class="form-group">
                  <label> Product Name :</label>
                  <input type="text" name="product_name" class="form-control">
               </div>
               <br>
               <div class="form-group">
                  <label>Product Code :</label>
                  <input type="text" name="product_code" class="form-control">
               </div>
               <br>
               <div class="form-group">
                  <label>Image :</label>
                  <input type="file" name="image">
               </div>
               <br>
               <div class="form-group">
                  <label>Size :</label>
                  <select name="size" class="form-control">
                     <option value="0">Select</option>
                     @foreach($size as $a)
                     <option value="{{$a->size}}">{{$a->size}}</option>
                     @endforeach
                  </select>
               </div>
               <br>
               <div class="form-group">
                  <label>Color :</label>
                  <select name="color" class="form-control">
                     <option value="0">Select</option>
                     @foreach($color as $a)
                     <option value="{{$a->color}}">{{$a->color}}</option>
                     @endforeach
                     </select>
               </div>
               <br>
               <div class="form-group">
                  <label>Long Description:</label>
                  <input type="text" name="long_description" class="form-control">
               </div>
               <br>
               <div class="form-group">
                  <label>Short Description:</label>
                  <input type="text" name="short_description" class="form-control">
               </div>
               <br>
               <div class="form-group">
                  <label>Price:</label>
                  <input type="text" name="price" class="form-control">
               </div>
               <br>
               <div class="form-group">
                  <label>Quantity:</label>
                  <input type="text" name="quantity" class="form-control">
               </div>
               <br>
               <div class="form-group">
                  <label>featured_product:</label>
                  <select name="featured_product" class="form-control">
                    <option value="0">Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
               </div>
               <br>
               <div class="form-group">
                  <label>Popular_product:</label>
                  <select name="popular_product" class="form-control">
                    <option value="0">Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
               </div>
               <br>
               <div class="form-group">
                  <label>Latest Product:</label>
                  <select name="latest_product" class="form-control">
                    <option value="0">Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
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