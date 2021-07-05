<!-- Start Promo section -->
<section id="aa-promo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-promo-area">
            <div class="row">
              <!-- promo left -->
              <div class="col-md-5 no-padding"> 
              @foreach($catss as $a)               
                <div class="aa-promo-left">
                  <div class="aa-promo-banner"> 
                                
                    <img src="{{url('upload/' .$a->image)}}" alt="img">                    
                    <div class="aa-prom-content">
                      <span>75% Off</span>
                      <h4><a href="#">{{$a->categories_name}}</a></h4>                      
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <!-- promo right -->
              <div class="col-md-7 no-padding">
              
                <div class="aa-promo-right">
                @foreach($cat as $a)
                  <div class="aa-single-promo-right">
                  <div class="aa-promo-banner">                      
                      <img src="{{url('upload/' .$a->image)}}" alt="img">                      
                      <div class="aa-prom-content">
                        <!-- <span>Exclusive Item</span> -->
                        <h4><a href="#">{{$a->categories_name}}</a></h4>                        
                      </div>
                    </div>
                  
                  </div>
                @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Promo section -->