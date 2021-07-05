<!-- catg header banner section -->
<section id="aa-catg-head-banner">
  @foreach($banner as $p)
   <img src="{{url('upload/'.$p->image)}}" alt="fashion img" style="width:100%;height:300px;">
  @endforeach
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>{{$data->product_name}}</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>         
          <li><a href="#">Product</a></li>
          <li class="active">T-shirt</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->
