<!-- Cart view section -->
<section id="aa-myaccount">
@if(session('message'))
 <p class="alert alert-success">
  {{session('message')}}
 </p>
@endif
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
              <div class="col-md-6">
                <div class="aa-myaccount-login">
                <h4>Login</h4>
                 <form action="{{url('user/login')}}" method="post" class="aa-login-form">
                 @csrf
                  <label for="">Username or Email address<span>*</span></label>
                   <input type="text" name="email"placeholder="Username or email">
                   <label for="">Password<span>*</span></label>
                    <input type="password" name="password" placeholder="Password">
                    <button type="submit" class="aa-browse-btn">Login</button>
                    <label class="rememberme" for="rememberme"><input type="checkbox" id="rememberme"> Remember me </label>
                    <p class="aa-lost-password"><a href="#">Lost your password?</a></p>
                  </form>
                </div>
              </div>
              <div class="col-md-6">
                <div class="aa-myaccount-register">                 
                 <h4>Register</h4>
                 <form action="{{url('user/register')}}" method="post" class="aa-login-form">
                 @csrf
                 <label for="">Name<span>*</span></label>
                   <input type="text" name="name"placeholder="Name">
                    <label for="">Username or Email address<span>*</span></label>
                    <input type="text" name="email" placeholder="Username or email">
                    <label for="">Password<span>*</span></label>
                    <input type="password" name="password"placeholder="Password">
                    <button type="submit" class="aa-browse-btn">Register</button>                    
                  </form>
                </div>
              </div>
            </div>          
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->