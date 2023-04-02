<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Panel</title>
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

<!--Navigation Tab-->
    <div class="d-flex justify-content-end mx-4 my-4 pb-5">
        <h1 class="h5 text-white">{{ Auth::user()->name }}</h1>
    </div>
  <button class="btn tablinks"  href="{{route('dashboard')}}"><i class='fas fa-house-user'></i> Dashboard</button>
  <hr class="hr hr-blurry" /><br>
    <li class=" nav-item dropdown">
      <button class=" nav-link tablinks dropbtn"><i class='fas'>&#xf0c0;</i>&nbsp Member's List</button>
        <div class="dropdown-content d-flex flex-column">
          <a class="tablinks active btn ml-3 pl-3" href="{{route('OwnerStaffPanel')}}">
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
    <a class="tablinks btn"  href="{{route('registrationPanel')}}" ><i class='far'>&#xf2b9;</i>&nbsp Registration Approval</a>
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
<div id="Staff" class="tabcontent">
    <div class="container bg-light rounded">
      <div class="bg-light py-3 ">
        <table class="table mb-0 bg-white" id="staff">
          <thead class="bg-light">
            <tr><h5 class="staff">Staff</h5>
              <th>Picture</th>
              <th>Name</th>
              <th>Position</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($userapprove as $user)
            <tr>
              <td><img src="{{asset('images/users/'. $user->image)}}" class="card-img-top" alt="image" style="width:50px; height:50px">
              </td>
              <td>
                <p class="mb-1">{{ $user->name }}</p> 
                <p class="text-muted mb-0">{{ $user->email }}</p>
              </td>
              <td></td>
              <td><span class="badge badge-primary rounded-pill d-inline">Active</span></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div> 
  </div>   
</body>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready(function(){
  $('#dataTable, #staff, #pendingCustomer, #customer').DataTable({
    lengthMenu: [ [5, 10, 25, -1], [5, 10, 25, 'All'], ],
  });
});
</script>
</html>