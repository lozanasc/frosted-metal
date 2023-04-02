  <!DOCTYPE html>
  <html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
      <a class="btn tablinks active" role="button" href="{{route('dashboard')}}"><i class='fas fa-house-user'></i> Dashboard</a>
        <li class=" nav-item dropdown">
          <hr class="hr hr-blurry" /><br>
          <a class=" tablinks nav-link dropbtn"><i class='fas'>&#xf0c0;</i> Users List</a>
            <div class="dropdown-content">
              <a class=" tablinks  ml-3 pl-3" href="{{route('staffview')}}">
                <i class="bi bi-caret-right-fill"></i>
                Staff
              </a>
              <a class=" tablinks  ml-2 pl-2" href="{{route('customerPanel')}}">
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
    <div class="d-flex mr-3">
          <a href="{{ route('profile.edit') }}" role="button" class="btn btndash text-white"><i class="bi bi-person-lines-fill"></i>&nbsp;Profile</a> 
          <form method="POST" action="{{ route('logout') }}">
              @csrf
                  <a href="route('logout')" class="btn btndash text-white"
                      onclick="event.preventDefault();
                      this.closest('form').submit();"><i class="bi bi-box-arrow-right"></i>&nbsp; Logout </a>
          </form>
        </div>
  </div>
  
  <div id="Home" class="tabcontent">
    <div class="container-fluid">
      <!-- Tab panes -->
      <div class="tab-content">
        <div id="home" class="container tab-pane active"><br>
        @include('sweetalert::alert')
        
          <div class="container mt-5">
            <div class="row">
                <div class="col-sm-4 ">
                  <div class="home card card-header text-white mb-3">
                    <h4>Total Members</h4>
                    <hr class="divider bg-white" />
                    <div class="card-body">
                      <div class="h1 font-monospace">
                        {{$countMember}}
                      </div> 
                      <div class="icon-box"><i class="fas fa-users"></i></div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-4 ">
                  <div class="home card card-header text-white mb-3">
                    <h4>Total Sales</h4>
                    <hr class="divider bg-white" />
                    <div class="card-body">
                      <div class="h1 font-monospace">
                        #
                      </div> 
                      <div class="icon-box"><i class="fas fa-money-bill-wave-alt"></i></div>
                    </div>
                  </div>
                </div>
                
                  
                <div class="col-sm-4 ">
                  <div class="home card card-header text-white mb-3">
                    <h4>Total Equipments</h4>
                    <hr class="divider bg-white" />
                    <div class="card-body">
                      <div class="h1 font-monospace">
                      {{$countEquipment}}
                      </div> 
                      <div class="icon-box"><i class="fas fa-dumbbell"></i></div>
                    </div>
                  </div>
                </div>
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

  </body>
  <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>

  <script>
 $(document).ready(function(){
  $('#dataTable, #staff, #pendingCustomer, #customer').DataTable({
    lengthMenu: [ [5, 10, 25, -1], [5, 10, 25, 'All'], ],
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