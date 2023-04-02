<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('cssfile/register.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Anton|Cabin|Lato|Fjalla+One|Montserrat|Roboto&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.0/css/all.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">

    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
         <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    </svg>
    <title>Register</title>
    
 </head>
      <style>
        .slide-1 {
        background-image: url("/img/img-5.png");
         }
     </style>
   <body>
      <div class="slider">   
        <div class="slides">
            <div class="slide slide-1"> 
              <div class="form-container">  
                      <!-- FORM-->
              <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @if(session('success'))
                  <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg> 
                      {{ session('success') }}</div>
                @endif
                @csrf
                    <!--Image-->
                    <div class="control">
                        <label for="image">Insert Image</label>
                        <input type="file" id="image" name="image" required>
                          @error('image')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                    </div>

                     <!--Name -->
                     <div class="control">
                      <label for="name">Name</label>
                      <input id="name" type="text" name="name" :value="old('name')" required />
                      <x-input-error :messages="$errors->get('name')" />
                     </div>

                      <!-- Email -->
                      <div class="control">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')"/>
                     </div>

                     <!--Password -->
                     <div class="control">
                       <label for="password">Password</label>
                       <input id="password" type="password" name="password" required autocomplete="new-password"/>
                       <x-input-error :messages="$errors->get('password')"/>
                    </div>

                     <!-- Confirm Password -->
                      <div class="control">
                         <label for="password_confirmation">Confirm Password</label>
                         <input id="password_confirmation" type="password" name="password_confirmation" required />
                         <x-input-error :messages="$errors->get('password_confirmation')" class="" />
                      </div>

                      <!-- Register Button -->
                      <div class="control">
                           <input type="submit" name="login" value="Register"> 
                      </div>

                      <!--Link to Login page-->
                      <div class="link">
                      <a href="{{ route('login') }}">Already registered? </a>
                     </div>     
              </form>
             </div>
            </div>
        </div>
      </div>  
   </body>
</html>

