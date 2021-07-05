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
            <form action="{{url('/product/update')}}" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id" value="{{$data->id}}">
            {{csrf_field()}}
            <div class="form-group">
                  <label>Categories :</label>
                  <select name="cat_id" id="cat_id" class="form-control">
                  <?php echo $categories_dropdown;?>
                       
                  </select>
               </div>
               <br>
               <div class="form-group">
                  <label> Product Name :</label>
                  <input type="text" name="product_name" class="form-control" value="{{$data->product_name}}">
               </div>
               <br>
               <div class="form-group">
                  <label>Product Code :</label>
                  <input type="text" name="product_code" class="form-control" value="{{$data->product_code}}">
               </div>
               <br>
               <div class="form-group">
                  <label>Image :</label>
                  <input type="file" name="image">
                  <img src="{{url('upload/' .$data->image)}}" style="width: 108px;height: 110px;border-radius: 20%;">
               </div>
               <div class="form-group">
                  <label>Size :</label>
                  <select name="size" class="form-control">
                     <?php echo $size_dropdown;?>
                  </select>
               </div>
               <br>
               <div class="form-group">
                  <label>Color :</label>
                  <select name="color" class="form-control">
                     <option value="0">Select</option>
                       <?php echo $color_dropdown;?>
                     </select>
               </div>
               <br>
               <div class="form-group">
                  <label>Long Description:</label>
                  <input type="text" name="long_description" class="form-control" value="{{$data->long_description}}">
               </div>
               <br>
               <div class="form-group">
                  <label>Short Description:</label>
                  <input type="text" name="short_description" class="form-control" value="{{$data->short_description}}">
               </div>
               <br>
               <div class="form-group">
                  <label>Price:</label>
                  <input type="text" name="price" class="form-control" value="{{$data->price}}">
               </div>
               <br>
               <div class="form-group">
                  <label>Quantity:</label>
                  <input type="text" name="quantity" class="form-control" value="{{$data->quantity}}">
               </div>
               <br>
               <div class="form-group">
                  <label>featured_product:</label>
                  <select name="featured_product" class="form-control">
                    <option value="0">Select</option>
                    <option value="Yes"
                    @if($data->featured_product=="Yes") selected @endif
                    >Yes</option>
                    <option value="No"
                    @if($data->featured_product=="No") selected @endif
                    >No</option>
                  </select>
               </div>
               <br>
               <div class="form-group">
                  <label>Popular_product:</label>
                  <select name="popular_product" class="form-control">
                    <option value="0">Select</option>
                    <option value="Yes"
                    @if($data->popular_product=="Yes") selected @endif
                    >Yes</option>
                    <option value="No"
                    @if($data->popular_product=="No") selected @endif
                    >No</option>
                  </select>
               </div>
               <br>
               <div class="form-group">
                  <label>Latest Product:</label>
                  <select name="latest_product" class="form-control">
                    <option value="0">Select</option>
                    <option value="Yes"
                    @if($data->latest_product=="Yes") selected @endif
                    >Yes</option>
                    <option value="No"
                    @if($data->latest_product=="No") selected @endif
                    >No</option>
                  </select>
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
@endsection