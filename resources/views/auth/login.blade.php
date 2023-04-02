<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('cssfile/login.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Anton|Cabin|Lato|Fjalla+One|Montserrat|Roboto&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.0/css/all.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
       <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
       </symbol>
    </svg>   


    <title>Login</title>
       <style>
    .slide-1 {
        background-image: url("/img/img-4.png");
         }
     </style>
    <div class="slider">   
        <div class="slides">
            <div class="slide slide-1"> 
                     <div class="form-container">
                          <h1>LOGIN FORM</h1>
                          <hr><br>
                          
                          <x-auth-session-status :status="session('status')" />
                          <form method="POST" action="{{ route('login') }}">
                              @if (session('error'))
                             <div class="alert alert-warning d-flex align-items-center" role="alert">
                                  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#info-fill"/></svg>
                             {{ session('error') }}</div>
                             @endif
                             @csrf
          
                               <div class="control">
                                  <label for="email">Email</label>
                                  <input id="email" type="email" name="email" :value="old('email')" required autofocus />
                                  <x-input-error :messages="$errors->get('email')"/>
                               </div>
           
                               <div class="control">
                                   <label for="password">Password</label>
                                   <input id="password" type="password" name="password" required autocomplete="current-password" />
                                   <x-input-error :messages="$errors->get('password')"/>
                               </div>
                      
                                     <span><input type="checkbox" id="remember_me" name="remember" >Remember Me</span> 

                               <div class="control">
                                    <input type="submit" name="login" value="login"> 
                               </div>    
                               
                               <div class="link">
                                  <a href="/register">Not yet registered?</a>                       
                               </div>
                       
                         </form>
                     </div>
                 </div>

      </div>
   </div>
</div>
 </body>

</html>


