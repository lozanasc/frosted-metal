<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('cssfile/welcome.css')}}">
    <link rel="stylesheet" href="{{asset('cssfile/login.css')}}">
    <script src="{{asset('assets/js/main.js')}}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.3/sweetalert2.min.js" integrity="sha512-eN8dd/MGUx/RgM4HS5vCfebsBxvQB2yI0OS5rfmqfTo8NIseU+FenpNoa64REdgFftTY4tm0w8VMj5oJ8t+ncQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.0/css/all.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
  />    
  <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
  />
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css"
    rel="stylesheet"
  />
    <title>P.E Fitness Gym</title>
  </head>
  <style>
    .img-1 {
    background-image: url("/img/img-1.png");
  }
  
  .slide-2 {
    background-image: url("/img/img-2.png");
  }
  
  .slide-3 {
    background-image: url("/img/img-3.png");
  }
</style>
  <body>
    @include('sweetalert::alert')
  <div class="slider">
      <input type="radio" name="slide" id="img-1" checked>
      <input type="radio" name="slide" id="slide-2">
      <input type="radio" name="slide" id="slide-3">
   
              <div class="slides">
                  <div class="slided img-1">

                     <nav>
                        <div class="logo">
                           <a href =""><img src="/img/image1.jpg">P.E Fitness Gym  Management System</a>
                        </div>
                     </nav>

                     <div class="Wrapper">
                        <div class="contentbx">
                           <div class="formbx">                              
                                    
                              <form>
                              
                                 <div class="inputbx">
                                    <p>HEALTH IS NOT ABOUT</p>                       
                                 </div>
                                 <div class="inputbx">
                                    <p>THE WEIGHT YOU LOSE,</p>                       
                                 </div>
                                 <div class="inputbx">
                                    <p>BUT ABOUT THE LIFE YOU GAIN.</p>                       
                                 </div>
                                          
                                 <div class="inputbx">
                                    <hr>
                                    <p>
                                       
                                       
                                             
                                                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginForm" id="open">LOGIN</a>
                                                <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#signupForm">SIGNUP</a>
                                                
                                          
                     
                                    
                                    </p>  
                                 </div>
                                 <hr>
                                 <p>@All Rights Reserve 2023</p>                    
                              </form>
                        </div>    
                     </div>     
                  </div>
               </div>                 
      <div class="dots">
         <label for="img-1"></label>
         <label for="slide-2"></label>
         <label for="slide-3"></label>

      </div>
   </div>
   <!--Login Modal-->
   <div class="modal fade" id="loginForm" tabindex="-1" aria-labelledby="myModalLabel"
      aria-hidden="true" role="dialog">
      <div class="modal-dialog modal-notify modal-warning" role="document">
         <div class="modal-content">
            <form method="POST" class="rounded" action="{{ route('login') }}">
               @if(Session::get('success'))
                  <center>
                  <div class="alert alert-success">{{ Session::get('success') }}
                  </div>
                  </center>
               @endif
               @if(Session::get('fail'))
                  <center>
                  <div class="alert alert-danger">{{ Session::get('fail') }}
                  </div>
                  </center>
               @endif
               @csrf
               <div class="modal-header text-center">
                  <h4 class="modal-title w-100 font-weight-bold py-2">Login Form</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="control p-2">
                  <label for="email">Email</label>
                  <input id="email" type="email" name="email" :value="old('email')" required autofocus />
                  @error('email')
                     <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>

               <div class="control p-2">
                  <label for="password">Password</label>
                  <input id="password" type="password" name="password" required autocomplete="current-password" />
                  @error('password')
                     <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
      
                     <span class="p-2"><input type="checkbox" id="remember_me" name="remember" >&nbsp Remember Me</span> 

               <div class="control p-2">
                     <input type="submit" name="login" value="login"> 
               </div>    
               
               <div class="link">
                  <a data-bs-toggle="modal" data-bs-target="#signupForm" class="text-black">Not yet registered?</a>                       
               </div>
            </form>
         </div>
      </div>
   </div>
   <!--Sign Up Modal-->
   <div class="modal fade" id="signupForm" tabindex="-1" aria-labelledby="myModalLabel"
      aria-hidden="true" role="dialog">
      <div class="modal-dialog modal-notify modal-warning" role="document">
         <div class="modal-content">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registration">
               @if(session('success'))
               <div class="alert alert-success d-flex align-items-center" role="alert">
                  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg> 
                     {{ session('success') }}</div>
               @endif
               @csrf
                  <div class="modal-header text-center">
                     <h4 class="modal-title w-100 font-weight-bold py-2">Signup Form</h4>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <!--Image-->
                  <div class="control p-2">
                     <label for="image">Insert Image</label>
                     <input type="file" id="image" name="image" required>
                        @error('image')
                           <span class="text-danger">{{ $message }}</span>
                        @enderror
                  </div>

                  <!--Name -->
                  <div class="control p-2">
                     <label for="name">Name</label>
                     <input id="name" type="text" name="name" :value="old('name')" required />
                     <x-input-error :messages="$errors->get('name')" />
                  </div>

                     <!-- Email -->
                     <div class="control p-2">
                     <label for="email">Email</label>
                     <input id="email" type="email" name="email" :value="old('email')" required />
                     <x-input-error :messages="$errors->get('email')"/>
                  </div>
                  <!--Mobile Number -->
                  <div class="control p-2">
                     <label for="number">Mobile Number</label>
                     <input id="number" type="text" name="number" :value="old('number')" required />
                     <x-input-error :messages="$errors->get('name')" />
                  </div>

                  <!--Password -->
                  <div class="control p-2">
                     <label for="password">Password</label>
                     <input id="password" type="password" name="password" required autocomplete="new-password"/>
                     <x-input-error :messages="$errors->get('password')"/>
                  </div>

                  <!-- Confirm Password -->
                     <div class="control p-2">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="" />
                     </div>

                     <!-- Register Button -->
                     <div class="control p-2">
                        <input type="submit" name="login" value="Register"> 
                     </div>

                     <!--Link to Login page-->
                     <div class="link">
                     <a data-bs-toggle="modal" data-bs-target="#loginForm">Already registered? </a>
                     </div>     
            </form>
         </div>
      </div>
   </div>  
  </body>
  <script>
   $('#loginForm').modal({show:true});
   var form=document.getElementById("registration");
      function submitForm(event){
         event.preventDefault();
      }
      form.addEventListener('submit', submitForm);
  </script>
</html>

