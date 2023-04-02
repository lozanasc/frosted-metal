<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}"/>
  <link rel="stylesheet" href="{{asset('cssfile/owner.css')}}">
  <script src="{{asset('assets/js/availExtend.js')}}" defer></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.0/css/all.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.3/sweetalert2.min.js" integrity="sha512-eN8dd/MGUx/RgM4HS5vCfebsBxvQB2yI0OS5rfmqfTo8NIseU+FenpNoa64REdgFftTY4tm0w8VMj5oJ8t+ncQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</head>

<body>
@include('sweetalert::alert')
<div class="tab">    
      <br>
      <div class=" mb-3 d-flex flex-column justify-content-center">
        <img src="{{asset('images/users/'. Auth::user()->image)}}"
          class="img rounded-circle" style="width: 50px; height: 50px;" />
          <h5 class="text-white text-center">{{ Auth::user()->name }}</h5>
      </div>
      <hr class="hr hr-blurry" />
      <a href="{{ route('profile.edit') }}" class="btn tablinks"><i class="fas fa-user-cog"></i>&nbsp; Profile</a> 
      <hr class="hr hr-blurry" />
      <a class="btn tablinks active"  href="{{route('dashboard')}}" ><i class='fas fa-house-user'></i> Dashboard</a> 
      <hr class="hr hr-blurry" />
      <a class="btn tablinks" href="{{route('StaffEquipmentPanel')}}"><i class="fas fa-dumbbell"></i> Equipment Tools</a>
      <hr class="hr hr-blurry" />
      <a class="btn tablinks" href="{{route('StaffTransactionPanel')}}"><i class='fas'>&#xf02c;</i> Transaction</a>
      <hr class="hr hr-blurry" />
      <form method="POST" action="{{ route('logout') }}">
          @csrf
              <a href="route('logout')" class="btn tablinks"
                  onclick="event.preventDefault();
                  this.closest('form').submit();"><i class='fas'>&#xf011;</i>&nbsp; Logout </a>
      </form>
</div>
 
  <!--Dashboard-->
    <div class="tabcontent">
     <div class="container bg-light rounded">
      <div class="bg-light py-3">
        <!-- Add new Member Form -->
        <div class="home d-flex">
          <h2 class="font-semibold text-xl text-white leading-tight">&nbsp MEMBERS </h2><br>
            <button class="btn btn-warning btn-rounded mb-4" data-bs-toggle="modal" data-bs-target="#modalMemberForm">
            <i class="fas fa-user-plus"></i>&nbsp;
              Add New Member
            </button>
              
        </div>
        <br>
        <table class="table" id="member">
            <thead class="table-light">
              <tr>
                <th>Particulars</th>
                <th>Date of Birth</th>
                <th>ID Card</th>
                <th>Membership Plan</th>
                <th>Membership Type</th>
                <th>Start Date</th>
                <th>Remaining Days</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            <?php $now = Carbon\Carbon::now();?>
            @foreach ($memberapprove as $member)
            <?php
              $plan = $member->plan;
              if($plan == 'Daily'){
                $endTime = Carbon\Carbon::parse($member->updated_at)->addDay();
              }if($plan == 'Monthly'){
                $endTime = Carbon\Carbon::parse($member->updated_at)->addMonth();
              }if($plan == 'Bi-Annual'){
                $endTime = Carbon\Carbon::parse($member->updated_at)->addMonths(6);
              }elseif($plan == 'Annual'){
                $endTime = Carbon\Carbon::parse($member->updated_at)->addYear();
              }
                $remaining = Carbon\Carbon::parse($member->updated_at)->diff($endTime);
              ?> 
              <?php
              $dateTime = strtotime('April 30, 2023 18:00:00');
              $getDateTime = date("F d, Y H:i:s", $dateTime)
              ?>
              <tr id="{{$member->id}}">
                <td>
                  <div class="d-flex align-items-center">
                    <div class="ms-3">
                      <p class="fw-bold mb-1">{{$member->fname}} {{$member->lname}}</p>
                      <p class="text-muted mb-0">{{$member->age}} years old, {{$member->sex}} </p>
                      <p class="text-muted mb-0">{{$member->mobilenum}}</p>
                      <p class="text-muted mb-0">{{$member->address}}</p>
                    </div>
                  </div>
                </td>
                <td>{{$member->DOB}}</td>
                <td><img src="{{asset('images/members/'. $member->image)}}" class="card-img-top" alt="image" style="width:50px; height:50px"></td>
                <td id="tplan">{{$member->plan}}</td>
                <td id="ttype">{{$member->type}}</td>
                <td>{{date('m-d-Y', strtotime($member->updated_at))}}</td>
                <td> <h2 id="counter"></h2></td>
                <td>
                  <button type="button" class="btn btn-link btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target="#modalAvailForm" 
                  onclick="setForm('{{$member->id}}','{{$member->plan}}', '{{$member->type}}')">
                    Avail / Extend
                  </button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
     </div>
          <!--New member Modal-->
          <div class="modal fade" id="modalMemberForm" tabindex="-1" aria-labelledby="myModalLabel"
            aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <form action="{{route ('member') }}" method="post" enctype="multipart/form-data">
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
                  <section class="bg-dark">
                    <div class="container h-100">
                      <div class="row justify-content-center align-items-center h-100">
                        <div class="col">
                          <div class="card card-registration my-4">
                            <div class="row">
                              <div class="col-12">
                                <div class="d-flex justify-content-end pt-2 r-4">
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="card-body text-black">
                                  <h3 class="mb-3 text-uppercase text-center">Membership registration form</h3>
                                  <div class="row">
                                    <div class="col-6 mb-3">
                                      <div class="form-outline">
                                        <input type="text" id="fname" name="fname" class="form-control" required/>
                                        <label class="form-label" for="fname">First name</label>
                                      </div>
                                      @error('fname')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                      <div class="form-outline">
                                        <input type="text" id="lname" name="lname" class="form-control" required/>
                                        <label class="form-label" for="lname">Last name</label>
                                      </div>
                                    </div>
                                      @error('lname')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>

                                  <div class="form-outline mb-3">
                                    <input type="text" id="address" name="address" class="form-control" required/>
                                    <label class="form-label" for="address">Address</label>
                                      @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror

                                  </div>

                                  <div class="row">
                                    <div class="d-md-flex justify-content-start align-items-center mb-2 py-2">

                                      <h6 class="mb-0 me-2">Sex: </h6>

                                      <div class="form-check form-check-inline mb-0 me-2">
                                        <input class="form-check-input" type="radio" name="sex" id="femaleGender"
                                          value="Female" />
                                        <label class="form-check-label" for="femaleGender">Female</label>
                                      </div>

                                      <div class="form-check form-check-inline mb-0 me-4">
                                        <input class="form-check-input" type="radio" name="sex" id="maleGender"
                                          value="Male" />
                                        <label class="form-check-label" for="maleGender">Male</label>
                                      </div>
                                      <h6 class="mb-0 me-2">Birthdate: </h6>
                                      <div class="col-4 mb-2">
                                        <input type="date" id="DOB" name="DOB" class="form-control" required/>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-6 mb-3">

                                      <select class="select" name="plan" required>
                                        <option selected>Membership Plan</option>
                                        <option value="Daily">Daily</option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Bi-Annual">Bi-Annual</option>
                                        <option value="Annual">Annual</option>
                                      </select>

                                    </div>
                                    <div class="col-6 mb-3">

                                      <select class="select" name="type" required>
                                        <option selected>Membership Type</option>
                                        <option value="Student">Student</option>
                                        <option value="Non-Student">Non-Student</option>
                                      </select>

                                    </div>
                                  </div>

                                  <div class="row">

                                    <div class="col-6 mb-3">
                                      <div class="form-outline">
                                      <i class="fas fa-file-image prefix grey-text"></i>
                                        <label for="image">Identification Card: </label>
                                        <input type="file" id="image" name="image" class="form-control border border-secondary" required>
                                      </div>
                                        @error('image')
                                          <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-6 mb-3">
                                      <div class="form-outline">
                                        <input type="integer" id="age" name="age"class="form-control" />
                                        <label class="form-label" for="age">Age</label>
                                      </div>
                                      @error('age')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror

                                    </div>

                                  </div>
                                  
                                  <div class="form-outline mb-3">
                                    <input type="integer" id="mobilenum" name="mobilenum" class="form-control" />
                                    <label class="form-label" for="mobilenum">Contact Number</label>
                                    @error('mobilenum')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror

                                  </div>

                                  <div class="form-outline mb-3">
                                    <input type="email" id="email" name="email" class="form-control" />
                                    <label class="form-label" for="email">Email</label>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror

                                  </div>

                                  <div class="form-outline mb-3">
                                    <input type="password" id="password" name="password" class="form-control" />
                                    <label class="form-label" for="password">Password</label>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror

                                  </div>

                                  <div class="d-flex justify-content-end ms-2 pt-3">
                                    <button type="button" class="btn btn-secondary text-black me-2" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                    <button type="submit" class="btn btn-primary text-black">Submit form</button>
                                  </div>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>                        
                </form>
              </div>
            </div>
          </div>

            <div class="modal fade" id="modalAvailForm" tabindex="-1" aria-labelledby="myModalLabel"
              aria-hidden="true" data-bs-backdrop="static">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                    @csrf
                    <div class="modal-header text-center bg-warning">
                      <h4 class="modal-title w-100 font-weight-bold text-white">Avail or Extend Membership</h4>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="md-form mb-5 p-2">
                        <label for="tid">ID</label>
                        <input type="text" id="eid" name="eid" class="form-control" disabled>
                      </div>

                      <div class="md-form mb-5 p-2">
                        <label for="eplan">Membership Plan</label>
                        <input type="text" id="eplan" name="eplan" class="form-control" placeholder="Daily, Monthly, Bi-Annual or Annual" >
                      </div>

                      <div class="md-form mb-5 p-2">
                        <label for="etype">Membership Type</label>
                        <input type="text" id="etype" name="etype" class="form-control" placeholder="Student or Non-Student" >
                      </div>
                      

                    <div class="modal-footer d-flex bg-light justify-content-center">
                      <button type="submit" id="send" class="btn btn-info bg-info">Send &nbsp<i class="fas fa-paper-plane"></i></button>
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
      $('#member').DataTable({
        lengthMenu: [ [5, 10, 25, -1], [5, 10, 25, 'All'], ],
      });
    });
  

  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();

    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
   }
  
    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }

    var CountDownTimer = new Date("<?php echo"$getDateTime";?>").getTime();
    //Update the countdown every 1 second
    var interval =setInterval(function(){
      var currrent = new Date().getTime();
      //Find the difference between current and the countdown date
      var diff = countDownTimer - current;
      //Countdown Time calculation for days, hours, minutes and seconds
      var days = Math.floor(diff / (1000 * 60 * 60 * 24));
      var hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((diff & (1000 * 60)) / 1000);

      document.getElementById("counter").innerHTML = days + "Day: " + hours + "h " + minutes + "m " + seconds + "s ";
      if(diff < 0){
        clearInterval(interval);
        document.getElementById("counter").innerHTML = "EXPIRED";
      }
    }, 1000);
</script>
</html>




