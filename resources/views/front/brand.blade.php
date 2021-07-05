<!-- Client Brand -->
<section id="aa-client-brand">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-client-brand-area">
            <ul class="aa-client-brand-slider">
            @foreach($brand as $a)
              <li><a href="#"><img src="{{url('upload/'.$a->image)}}" alt="java img" style="height: 50px;width: 100%;"></a></li>
            @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Client Brand -->