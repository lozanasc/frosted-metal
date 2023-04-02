<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Approval</title>
    <link rel="stylesheet" href="{{asset('cssfile/owner.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.0/css/all.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.3/sweetalert2.min.js" integrity="sha512-eN8dd/MGUx/RgM4HS5vCfebsBxvQB2yI0OS5rfmqfTo8NIseU+FenpNoa64REdgFftTY4tm0w8VMj5oJ8t+ncQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

</head>
<body>
<div class="tab">
@include('sweetalert::alert')

<!--Navigation Tab-->
    <div class="d-flex justify-content-end mx-4 my-4 pb-5">
        <h1 class="h5 text-white">{{ Auth::user()->name }}</h1>
    </div>
  <a class="btn tablinks" href="{{route('dashboard')}}"><i class='fas fa-house-user'></i> Dashboard</a>
  <hr class="hr hr-blurry" /><br>
    <li class=" nav-item dropdown">
      <button class=" nav-link tablinks dropbtn"><i class='fas'>&#xf0c0;</i>&nbsp Member's List</button>
        <div class="dropdown-content d-flex flex-column">
          <a class="tablinks btn  ml-3 pl-3" href="{{route('OwnerStaffPanel')}}">
            <i class="bi bi-caret-right-fill"></i>
            Staff
         </a>
          <a class="tablinks btn ml-3 pl-3" href="{{route('OwnerCustomerPanel')}}">
            <i class="bi bi-caret-right-fill"></i>
            Customer
         </a>
        </div>
    </li>
    <hr class="hr hr-blurry" /><br>
    <a class="tablinks active btn"  href="{{route('registrationPanel')}}" ><i class='far'>&#xf2b9;</i>&nbsp Registration Approval</a>
    <hr class="hr hr-blurry" /><br>
    <div class="container d-flex">
      <a href="{{ route('profile.edit') }}" class="btn btndash text-white"><i class="bi bi-person-lines-fill"></i>&nbsp;Profile</a> 
      <form method="POST" action="{{ route('logout') }}">
          @csrf
              <a href="route('logout')" class="btn btndash text-white"
                  onclick="event.preventDefault();
                  this.closest('form').submit();"><i class="bi bi-box-arrow-right"></i>&nbsp; Logout </a>
      </form>
    </div>
</div>
<div class="tabcontent">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
      <button class="nav-link lead fs-5 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" 
         type="button" role="tab" aria-controls="home" aria-selected="true">
         Staff
      </button>
  </li>
  <li class="nav-item" role="presentation">
      <button class="nav-link lead fs-5" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" 
         type="button" role="tab" aria-controls="profile" aria-selected="false">
         Member
      </button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <div class="container rounded-bottom bg-light">
              <div class="bg-light py-3">
                <div class="bg-light">
                  <table id="dataTable"class="table" style="width:100%">
                    <thead>
                      <th>Picture</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registered at</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody> 
                      @foreach($users as $user)
                      <tr id="{{ $user->id }}" class="text-center bg-white">
                        <td><img src="{{asset('images/users/'. $user->image)}}" class="card-img-top" alt="image" style="width:50px; height:50px">
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d/m/Y')}}</td>
                        <td class="text-danger">@if($user->approved == 0) Pending @else Approved @endif</td>
                        <td>
                           <div class="d-flex">
                           <a role="button" class="btn btn-primary" href="{{ route('status', ['id'=>$user->id]) }}">
                           @if($user->approved == 1) Approved @else <i class="bi bi-person-plus-fill"></i>@endif</a>
                        &nbsp&nbsp
                        <form action="{{route('deny', $user->id)}}">
                           @csrf
                           <input name="_method"type="hidden" value="delete">
                           <button type="submit" class="btn btn-danger btn-rounded show_confirm"><i class="bi bi-person-x-fill"></i></button>
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
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <div class="container rounded-bottom bg-light">
            <div class="bg-light py-3">
              <div class="bg-light">
                <table class="table" id="pendingCustomer">
                  <thead class="text-wrap">
                      <th>ID Card</th>
                      <th>Name</th>
                      <th>Contact Number</th>
                      <th>Membership Plan</th>
                      <th>Membership Type</th>
                      <th>Registered at</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody> 
                    @foreach($memberapprove as $member)
                    <tr class="text-center bg-white">
                      <td><img src="{{asset('images/members/'. $member->image)}}" class="card-img-top" alt="image" style="width:50px; height:50px">
                      </td>
                      <td>{{ $member->fname }} {{ $member->lname }}</td>
                      <td>{{ $member->mobilenum }}</td>
                      <td>{{ $member->plan }}</td>
                      <td>{{ $member->type }}</td>
                      <td>{{ $member->created_at}}</td>
                      <td class="text-danger">@if($member->approved == 0) Pending @else Approved @endif</td>
                      <td>
                      <div class="d-flex">
                           <a role="button" class="btn btn-primary" href="{{ route('memberstatus', ['id'=>$member->id]) }}">
                           @if($member->approved == 1) Approved @else <i class="bi bi-person-plus-fill"></i>@endif</a>
                        &nbsp&nbsp
                        <form action="{{route('memberdeny', $member->id)}}">
                           @csrf
                           <input name="_method"type="hidden" value="delete">
                           <button type="submit" class="btn btn-danger btn-rounded show_confirm"><i class="bi bi-person-x-fill"></i></button>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function(){
  $('#dataTable, #staff, #pendingCustomer, #customer').DataTable({
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
</script>
</body>
</html>