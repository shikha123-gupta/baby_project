<!-- Cart view section -->
<section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area"> 
        @if(session('message'))
          <p class="alert alert-success">
             {{session('message')}}
          </p>
        @endif        
            <div class="row">
              <div class="col-md-6">
                <div class="aa-myaccount-login">
                <h4>Login</h4>
                 <form action="{{url('user/login')}}" method="post" class="aa-login-form">
                 @csrf
                  <label for="">Username or Email address<span>*</span></label>
                   <input type="text" name="email" placeholder="Username or email">
                   <label for="">Password<span>*</span></label>
                    <input type="password" name="password" placeholder="Password">
                    <label class="rememberme" for="rememberme" style="margin-top:-15px;"><input type="checkbox" id="rememberme"> Remember me </label>
                    <p class="aa-lost-password" style="text-align: right;margin-top: -29px;margin-left: -5px;"><a href="{{ route('forget.password.get') }}" style="color:#5c6bc0;font-weight:400">Forgot Your password?</a></p>
                    <button type="submit" class="aa-browse-btn">Login</button>
                      <div class="flex items-center justify-end mt-4">
                        <a href="{{ url('auth/google') }}">
                          <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 1em;margin-top:6px;">
                        </a>
                      </div>
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