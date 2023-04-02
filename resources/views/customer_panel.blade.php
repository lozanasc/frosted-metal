<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Panel</title>
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
@include('sweetalert::alert')
    <div class="tab">
        <div class="text-white d-flex justify-content-end mx-4 my-4 pb-3">{{ Auth::user()->name }}</div>
        <hr class="hr hr-blurry" /><br>
        
        <br>
        <a class="btn text-black tablinks" role="button" href="{{route('dashboard')}}"><i class='fas fa-house-user'></i> Dashboard</a>
        <li class=" nav-item dropdown">
            <hr class="hr hr-blurry" /><br>
            <a class=" tablinks nav-link dropbtn"><i class='fas'>&#xf0c0;</i> Users List</a>
            <div class="dropdown-content">
                <a class="tablinks  ml-3 pl-3" href="{{route('staffview')}}">
                <i class="bi bi-caret-right-fill"></i>
                Staff
                </a>
                <a class=" text-black tablinks active ml-3 pl-3" href="{{route('customerPanel')}}">
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

  <!--Customer Panel-->
  <div id="Customer" class="tabcontent">
      <div class="container bg-light rounded">
        <div class="bg-light py-3">
        <table class="table mb-0 bg-white" id="customer">
          <thead class="bg-light">
            <tr>
            <div class="home">
              <h5 class="staff mt-3">Customer</h5>
                <button class="btn btndash btn-rounded mb-4 mt-4 text-white" data-bs-toggle="modal" data-bs-target="#modalMemberForm">
                <i class="bi bi-person-fill-add"></i>
                  Add new Member
                </button>  
            </div>
              <th>ID Card</th>
              <th>Name</th>
              <th>Membership Type</th>
              <th>Membership Plan</th>
              <th>Remaining Days</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($members as $member)
            <tr>
              <td><img src="{{asset('images/members/'. $member->image)}}" class="card-img-top" alt="image" style="width:50px; height:50px">
              </td>
              <td>
                <p class="mb-1">{{ $member->fname }} {{ $member->lname }}</p> 
                <p class="text-muted mb-0">{{ $member->mobilenum }}</p>
              </td>
              <td>{{ $member->type }}</td>
              <td>{{$member->plan}}</td>
              <td></td>
              <td>
               <div class="d-flex">
               <button type="button" class="btn btn-outline-info btn-sm btn-rounded"  data-bs-toggle="modal" data-bs-target="#modalEditCustomer">
                <i class="bi bi-pencil-square"></i>
                  </button>
                  <form action="{{route ('deleteMember', $member->id)}}">
                     @csrf
                     <input name="_method"type="hidden" value="delete">
                     <button type="submit" class="btn btn-warning btn-sm btn-rounded show_confirm"><i class="bi bi-person-dash-fill"></i></button>
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
  <!--Membership Modal-->
    <div class="modal fade" id="modalMemberForm" tabindex="-1" aria-labelledby="myModalLabel"
      aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="{{route ('member') }}" method="post" enctype="multipart/form-data">
          
            @csrf
            <section class="bg-dark">
              <div class="container h-100">
                <div class="row justify-content-center align-items-center h-100">
                  <div class="col">
                    <div class="card card-registration my-4">
                      <div class="row">
                        <div class="col-12">
                          <div class="d-flex justify-content-end closebtn">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <br>
                          <div class="card-body text-black">
                            <h4 class="mb-5 text-uppercase text-center">Membership registration form</h4>
                            <div class="row">
                              <div class="col-6 mb-4">
                                <div class="form-outline">
                                  <input type="text" id="fname" name="fname" class="form-control" required/>
                                  <label class="form-label" for="fname">First name</label>
                                </div>
                                @error('fname')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                              <div class="col-6 mb-4">
                                <div class="form-outline">
                                  <input type="text" id="lname" name="lname" class="form-control" required/>
                                  <label class="form-label" for="lname">Last name</label>
                                </div>
                              </div>
                                @error('lname')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-outline mb-4">
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
                              <div class="col-6 mb-4">

                                <select class="select" name="plan" required>
                                  <option value="1">Membership Plan</option>
                                  <option value="Daily">Daily</option>
                                  <option value="Monthly">Monthly</option>
                                  <option value="Bi-Annual">Bi-Annual</option>
                                  <option value="Annual">Annual</option>
                                </select>

                              </div>
                              <div class="col-6 mb-4">

                                <select class="select" name="type" required>
                                  <option value="1">Membership Type</option>
                                  <option value="Student">Student</option>
                                  <option value="Non-Student">Non-Student</option>
                                </select>

                              </div>
                            </div>

                            <div class="row">

                              <div class="col-6 mb-4">
                                <div class="form-outline">
                                <i class="fas fa-file-image prefix grey-text"></i>
                                  <label for="image">Identification Card: </label>
                                  <input type="file" id="image" name="image" class="form-control border border-secondary" required>
                                </div>
                                  @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                  @enderror
                              </div>

                              <div class="col-6 mb-4">
                                <div class="form-outline">
                                  <input type="integer" id="age" name="age"class="form-control" />
                                  <label class="form-label" for="age">Age</label>
                                </div>
                                @error('age')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror

                              </div>

                            </div>
                            
                            <div class="form-outline mb-4">
                              <input type="integer" id="mobilenum" name="mobilenum" class="form-control" />
                              <label class="form-label" for="mobilenum">Contact Number</label>
                              @error('mobilenum')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="form-outline mb-4">
                              <input type="email" id="email" name="email" class="form-control" />
                              <label class="form-label" for="email">Email</label>
                              @error('email')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="form-outline mb-4">
                              <input type="password" id="password" name="password" class="form-control" />
                              <label class="form-label" for="password">Password</label>
                              @error('password')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="d-flex justify-content-end ms-2 pt-3">
                              <button type="button" class="btn btn-secondary text-black me-2" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                              <button type="submit" class="btn btn-warning text-black">Submit form</button>
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

    <!--Update Membership Modal-->
    <div class="modal fade" id="modalEditCustomer" tabindex="-1" aria-labelledby="myModalLabel"
      aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="{{url('update-customer',$member->id)}}" method="post" enctype="multipart/form-data">
          
            @csrf
            @method('PUT')
            <section class="bg-dark">
              <div class="container h-100">
                <div class="row justify-content-center align-items-center h-100">
                  <div class="col">
                    <div class="card card-registration my-4">
                      <div class="row">
                        <div class="col-12">
                          <div class="d-flex justify-content-end closebtn">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <br>
                          <div class="card-body text-black">
                            <h4 class="mb-5 text-uppercase text-center">Update Information</h4>
                            <div class="row">
                              <div class="col-6 mb-4">
                                <div class="form-outline">
                                  <input type="text" id="fname" name="fname" class="form-control" value="{{$member->fname}}" required/>
                                  <label class="form-label" for="fname">First name</label>
                                </div>
                                @error('fname')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                              </div>
                              <div class="col-6 mb-4">
                                <div class="form-outline">
                                  <input type="text" id="lname" name="lname" class="form-control" value="{{$member->lname}}" required/>
                                  <label class="form-label" for="lname">Last name</label>
                                </div>
                              </div>
                                @error('lname')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-outline mb-4">
                              <input type="text" id="address" name="address" class="form-control" value="{{$member->address}}" required/>
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
                                    value="Female" {{$member->sex =='Female' ? 'checked': ''}}/>
                                  <label class="form-check-label" for="femaleGender">Female</label>
                                </div>

                                <div class="form-check form-check-inline mb-0 me-4">
                                  <input class="form-check-input" type="radio" name="sex" id="maleGender"
                                    value="Male" {{$member->sex =='Male' ? 'checked': ''}} />
                                  <label class="form-check-label" for="maleGender">Male</label>
                                </div>
                                <h6 class="mb-0 me-2">Birthdate: </h6>
                                <div class="col-4 mb-2">
                                  <input type="date" id="DOB" name="DOB" class="form-control" value="{{$member->DOB}}" required/>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-6 mb-4">
                                 <label for="plan" class="form-label">Membership Plan</label>
                                <select class="select" name="plan" required>
                                  <option selected>{{$member->plan}}</option>
                                  <option value="Daily">Daily</option>
                                  <option value="Monthly">Monthly</option>
                                  <option value="Bi-Annual">Bi-Annual</option>
                                  <option value="Annual">Annual</option>
                                </select>

                              </div>
                              <div class="col-6 mb-4">
                              <label for="type" class="form-label">Membership Type</label>
                                <select class="select" name="type" required>
                                  <option selected>{{$member->type}}</option>
                                  <option value="Student">Student</option>
                                  <option value="Non-Student">Non-Student</option>
                                </select>

                              </div>
                            </div>

                            <div class="row">

                              <div class="col-6 mb-4">
                                <div class="form-outline">
                                <i class="fas fa-file-image prefix grey-text"></i>
                                  <label for="image">Identification Card: </label>
                                  <input type="file" id="image" name="image" class="form-control border border-secondary" required>
                                  <img src="{{asset('images/members/'. $member->image)}}" class="card-img-top pt-2" alt="image" style="width:50px; height:50px">                      
                                </div>
                              </div>

                              <div class="col-6 mb-4">
                                <div class="form-outline">
                                  <input type="integer" id="age" name="age"class="form-control" value="{{$member->age}}"/>
                                  <label class="form-label" for="age">Age</label>
                                </div>
                                @error('age')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror

                              </div>

                            </div>
                            
                            <div class="form-outline mb-4">
                              <input type="integer" id="mobilenum" name="mobilenum" class="form-control" value="{{$member->mobilenum}}" />
                              <label class="form-label" for="mobilenum">Contact Number</label>
                              @error('mobilenum')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="form-outline mb-4">
                              <input type="email" id="email" name="email" class="form-control" value="{{$member->email}}" />
                              <label class="form-label" for="email">Email</label>
                              @error('email')
                                  <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="d-flex justify-content-end ms-2 pt-3">
                              <button type="button" class="btn btn-secondary text-black me-2" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                              <button type="submit" class="btn btn-warning text-black">Submit form</button>
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
      $('#customer').DataTable({
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
</html>