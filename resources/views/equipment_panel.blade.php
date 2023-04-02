<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Panel</title>
    <link rel="stylesheet" href="{{asset('cssfile/admin.css')}}">
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
<div class="tab">
          <div class="text-white d-flex justify-content-end mx-4 my-4 pb-3">{{ Auth::user()->name }}</div>
        <hr class="hr hr-blurry" /><br>
     
      <br>
      <a class="btn tablinks" role="button" href="{{route('dashboard')}}"><i class='fas fa-house-user'></i> Dashboard</a>
        <li class=" nav-item dropdown">
          <hr class="hr hr-blurry" /><br>
          <a class=" tablinks nav-link dropbtn"><i class='fas'>&#xf0c0;</i> Users List</a>
            <div class="dropdown-content">
              <a class="tablinks  ml-3 pl-3" href="{{route('staffview')}}">
                <i class="bi bi-caret-right-fill"></i>
                Staff
              </a>
              <a class="tablinks  ml-3 pl-3" href="{{route('customerPanel')}}">
                <i class="bi bi-caret-right-fill"></i>
                Customer
              </a>
            </div>
        </li>
        <hr class="hr hr-blurry" />
    <a class="btn tablinks active" role="button" href="{{route('equipmentPanel')}}"><i class="fas fa-dumbbell"></i> Equipment Tools</a>
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

    <!--Equipment Panel-->
    <div id="Equipments" class="tabcontent">
      <div class="container bg-light rounded">
        <div class="bg-light py-3">
        <div class="home">
          <h5 class="staff mt-3">Equipments</h5>  
        </div>
        <table class="table bg-white" id="equipment">
          <thead>
            <tr>
            <th scope="col">No.</th>
            <th scope="col">Image</th>
              <th scope="col">Name</th>
              <th scope="col">Weight</th>
              <th scope="col">Activity</th>
              <th scope="col">Quantity</th>
              <th scope="col">Condition</th>
              <th scope="col">Edited at</th>
            </tr>
          </thead>
          <tbody>
            @foreach($equipment as $tool)
            <tr>
            <td scope="row">{{$tool->id}}</td>
            <td scope="row"><img src="{{asset('images/equipments/'. $tool->image)}}" class="card-img-top" alt="image" style="width:50px; height:50px"></td>
              <td scope="row">{{$tool->name}}</td>
              <td scope="row">{{$tool->weight}}</td>
              <td scope="row">{{$tool->activity}}</td>
              <td scope="row">{{$tool->quantity}}</td>
              <td scope="row">{{$tool->condition}}</td>
              <td scope="row">{{$tool->updated_at}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
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
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function(){
      $('#equipment').DataTable({
        lengthMenu: [ [5, 10, 25, -1], [5, 10, 25, 'All'], ],
      });
    });
</script>
</html>