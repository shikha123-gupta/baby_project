<!-- banner section -->
<section id="aa-banner">
    <div class="container">
      <div class="row"> 
        <div class="col-md-12">     
          <div class="row">
         
            <div class="aa-banner-area">@foreach($bann as $a)   
            <a href="#"><img src="{{url('upload/'.$a->image)}}" alt="fashion banner img" style="height:220px;width:100%"></a>
         @endforeach 
         </div>
         
          </div>
        </div> 
      </div>
    </div>
  </section>
  <!-- popular section -->