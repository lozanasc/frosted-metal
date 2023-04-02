<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Staff</title>
    <link rel="stylesheet" href="{{asset('cssfile/admin.css')}}">
    <script src="{{asset('assets/js/staff_update.js')}}" defer></script>
    <script src="{{asset('assets/js/app.js')}}" defer></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.0/css/all.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.8.2/dist/alpine.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.3/sweetalert2.min.js" integrity="sha512-eN8dd/MGUx/RgM4HS5vCfebsBxvQB2yI0OS5rfmqfTo8NIseU+FenpNoa64REdgFftTY4tm0w8VMj5oJ8t+ncQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>
@include('sweetalert::alert')
<div class="tab">
          <div class="text-white d-flex justify-content-end mx-4 my-4 pb-3">{{ Auth::user()->name }}</div>
        <hr class="hr hr-blurry" /><br>
     
      <br>
      <a class="btn tablinks" role="button" href="{{route('dashboard')}}"><i class='fas fa-house-user'></i> Dashboard</a>
        <li class=" nav-item dropdown">
          <hr class="hr hr-blurry" /><br>
          <a class="tablinks nav-link dropbtn"><i class='fas'>&#xf0c0;</i> Users List</a>
            <div class="dropdown-content">
              <a class="tablinks active ml-3 pl-3" href="{{route('staffview')}}">
                <i class="bi bi-caret-right-fill"></i>
                Staff
              </a>
              <a class=" tablinks  ml-3 pl-3" href="{{route('customerPanel')}}">
                <i class="bi bi-caret-right-fill"></i>
                Customer
              </a>
            </div>
        </li>
        <hr class="hr hr-blurry" />
    <a class="btn tablinks" role="button" href="{{route('equipmentPanel')}}"><i class="fas fa-dumbbell"></i> Equipment Tools</a>
      <hr class="hr hr-blurry" />
    <a class="btn tablinks" role="button" href="{{route('transactionPanel')}}"><i class='fas'>&#xf02c;</i> Transactions</a>
    <hr class="hr hr-blurry" /><br><br>
    <div class="d-flex">
          <a href="{{ route('profile.edit') }}" class="btn btndash text-white"><i class="bi bi-person-lines-fill"></i>&nbsp;Profile</a> 
          <form method="POST" action="{{ route('logout') }}">
              @csrf
                  <a href="route('logout')" class="btn btndash text-white"
                      onclick="event.preventDefault();
                      this.closest('form').submit();"><i class="bi bi-box-arrow-right"></i>&nbsp; Logout </a>
          </form>
        </div>
  </div>

  <!--Staff Panel-->
  <div id="Staff" class="tabcontent">
    <div class="container bg-light rounded">
      <div class="bg-light py-3">
        <div class="home">
          <h5 class="staff mt-3">Staff</h5>
            <button class="btn btndash btn-rounded mb-4 mt-4 text-white" data-bs-toggle="modal" data-bs-target="#modalStaffForm">
            <i class="bi bi-person-add"></i>
              Add New Staff
            </button>  
        </div>
      <table class="table text-center" id="staff">
        <thead class="bg-light">
          <tr>
            <th>Picture</th>
            <th>Name</th>
            <th>Contact Number</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($userapprove as $user)
            <tr>
              <td><img src="{{asset('images/users/'. $user->image)}}" class="card-img-top" alt="image" style="width:50px; height:50px"></td>
              <td>
                <p class="mb-1">{{ $user->name }}</p> 
              </td>
              <td>{{$user->number}}</td>
              <td>{{ $user->email }}</td>
              <td>
                <div class="d-flex">
                  <button type="button"class="btn btn-primary btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target="#modalEditStaff">
                    <i class="bi bi-pencil-square"></i>
                  </button>&nbsp&nbsp&nbsp
                  <form action="{{route('deleteUser', $user->id)}}">
                      @csrf
                      <input name="_method"type="hidden" value="delete">
                      <button type="submit" class="btn btn-danger btn-sm btn-rounded show_confirm"><i class="bi bi-person-dash-fill"></i></button>
                  </form>
                </div>
              </td>
            </tr>
            @endforeach
        </tbody>
      </table>
      </div>
    </div> 
  </div>
  <!--Add new Staff Modal-->
    <div class="modal fade" id="modalStaffForm" tabindex="-1" aria-labelledby="myModalLabel"
      aria-hidden="true" role="dialog">
      <div class="modal-dialog modal-notify modal-warning" role="document">
          <div class="modal-content">
                    <div class="modal-header text-center">
                      <h4 class="modal-title w-100 font-weight-bold py-2">Add Staff</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                        <form method="POST" action="{{ route('newstaff') }}" enctype="multipart/form-data">
                
                @csrf
                  <!--Image-->
                  <div class="md-form mb-3">
                      <label for="image">Insert Image</label>
                      <input type="file" id="image" name="image" class="form-control" required>
                  </div>

                  <!--Name -->
                  <div class="md-form mb-3">
                      <label for="md-form mb-3">Name</label>
                      <input id="name" type="text" name="name" class="form-control" :value="old('name')" required />
                      <x-input-error :messages="$errors->get('name')" />
                  </div>

                    <!-- Email -->
                    <div class="md-form mb-3">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" class="form-control" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')"/>
                    </div>

                    <!-- Contact Number -->
                   <div class="md-form mb-3">
                      <label for="number">Contact Number</label>
                      <input id="number" type="number" name="number" class="form-control" :value="old('number')">
                  </div>

                  <!--Password -->
                  <div class="md-form mb-3">
                      <label for="password">Password</label>
                      <input id="password" type="password" name="password" class="form-control" required autocomplete="new-password"/>
                      <x-input-error :messages="$errors->get('password')"/>
                  </div>

                  <!-- Confirm Password -->
                      <div class="md-form mb-3">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="" />
                      </div>

                      <!-- Register Button -->
                      <div class="d-flex justify-content-end">
                        <input type="submit" name="login" class="btn btn-primary" value="Register"> 
                      </div>
    
            </form>
                        </div>
                    </div>
          </div>
      </div>
    </div>
    <!--Update Staff Modal-->
    <div class="modal fade" id="modalEditStaff" tabindex="-1" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-notify modal-warning" role="document">
          <div class="modal-content">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Update Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="card-body">
                <form method="POST" action="{{url('update-staff')}}" enctype="multipart/form-data">
                
                    @csrf
                    @method('PUT')
                    <!--Image-->
                    <div class="md-form mb-3">
                        <label for="image">Insert Image</label>
                        <input type="file" id="image" name="image" class="form-control" >
                    </div>

                    <!--Name -->
                    <div class="md-form mb-3">
                        <label for="name">Name</label>
                        <input id="name" type="text" name="name" class="form-control" >
                    </div>

                    <!-- Email -->
                    <div class="md-form mb-3">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" class="form-control" >
                    </div>
                   <!-- Contact Number -->
                   <div class="md-form mb-3">
                      <label for="number">Contact Number</label>
                      <input id="number" type="number" name="number" class="form-control" >
                  </div>

                      <!-- Register Button -->
                      <div class="control">
                        <button type="submit" class="btn btn-info bg-info">Save changes &nbsp<i class="fas fa-paper-plane"></i></button>

                      </div>
    
                 </form>
                </div>
            </div>
          </div>
      </div>
    </div>

      <!--Footer-->
      <footer class="bg-dark text-center text-lg-start">
      <!-- Copyright -->
      <div class="text-center text-white p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        All Rights Reserve @ 2023
      </div>
      <!-- Copyright -->
    </footer>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function(){
      $('#staff').DataTable({
        lengthMenu: [ [5, 10, 25, -1], [5, 10, 25, 'All'], ],
      });
    });

    $('.show_confirm').click(function(event) {
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            form.submit();
          }
        });
    });

    function opentab(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();

  
      function openNav() {
        document.getElementById("mySidenav").style.width = "200px";
        document.getElementById("main").style.marginLeft = "200px";
      }

      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
      }
      var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
  </script>
</html>