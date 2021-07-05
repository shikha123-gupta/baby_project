<!-- Start slider -->
<section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas">
          @foreach($banner as $bann)
            <!-- single slide item -->
            <li>
              <div class="seq-model">
                <img data-seq src="upload/{{$bann->image}}" alt="Men slide img" />
              </div>
              <div class="seq-title">
               <!-- <span data-seq>Save Up to 75% Off</span>-->
                <h2 data-seq>{{$bann->btn_text}}</h2>                
                <!-- <p data-seq></p> -->
                <!-- <a data-seq href="#" class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a> -->
              </div>
            </li>
          @endforeach
            <!-- single slide item -->          
          </ul>
        </div>
        <!-- slider navigation btn -->
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
      </div>
    </div>
  </section>
  <!-- / slider -->