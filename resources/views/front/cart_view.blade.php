<!-- Cart view section -->
<section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php  
                    $total_amount=0;
                    ?>
                    @foreach($cart as $c)
                      <tr>
                        <td><a class="remove" href="#"><fa class="fa fa-close"></fa></a></td>
                        <td><a href="#"><img src="{{url('upload/'.$c->image)}}" alt="img"></a></td>
                        <td><a class="aa-cart-title" href="#">{{$c->product_name}}</a></td>
                        <td>{{$c->price}}</td>
                        <td><input class="aa-cart-quantity" type="number" value="{{$c->quantity}}"></td>
                        <td>{{$c->price*$c->quantity}}</td>
                      </tr>
                    <?php 
                    $total_amount=$total_amount+($c->price*$c->quantity);
                    ?>
                    @endforeach

                      <tr>
                        <td colspan="6" class="aa-cart-view-bottom">
                          <div class="aa-cart-coupon">
                            <input class="aa-coupon-code" type="text" placeholder="Coupon">
                            <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
                          </div>
                          <input class="aa-cart-view-btn" type="submit" value="Update Cart">
                        </td>
                      </tr>
                      </tbody>
                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
             <div class="cart-view-total">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th>Subtotal</th>
                     <td><?php echo $total_amount;?></td>
                   </tr>
                   <tr>
                     <th>Total</th>
                     <td><?php echo $total_amount;?></td>
                   </tr>
                 </tbody>
               </table>
               @if(Auth::check())
               <a href="{{url('front/checkout')}}" class="aa-cart-view-btn">Proced to Checkout</a>
               @else
               <a href="{{url('front/account')}}" class="aa-cart-view-btn">Proced to Checkout</a>
              @endif
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->