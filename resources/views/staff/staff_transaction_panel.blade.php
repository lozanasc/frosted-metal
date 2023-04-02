<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Panel</title>
    <link rel="stylesheet" href="{{asset('cssfile/owner.css')}}">
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
      <a href="{{ route('profile.edit') }}" class="btn text-black"><i class="fas fa-user-cog"></i>&nbsp; Profile</a> 
      <hr class="hr hr-blurry" />
      <a class="btn tablinks"  href="{{route('dashboard')}}" ><i class='fas fa-house-user'></i> Dashboard</a> 
      <hr class="hr hr-blurry" />
      <a class="btn tablinks" href="{{route('StaffEquipmentPanel')}}"><i class="fas fa-dumbbell"></i> Equipment Tools</a>
      <hr class="hr hr-blurry" />
      <a class="btn tablinks active" href="{{route('StaffTransactionPanel')}}"><i class='fas'>&#xf02c;</i> Transaction</a>
      <hr class="hr hr-blurry" />
      <form method="POST" action="{{ route('logout') }}">
          @csrf
              <a href="route('logout')" class="btn text-black"
                  onclick="event.preventDefault();
                  this.closest('form').submit();"><i class='fas'>&#xf011;</i>&nbsp; Logout </a>
      </form>
</div>

          <!--Transactions-->
          <div id="Transactions" class="tabcontent">
            <div class="container bg-light rounded">
                <div class="bg-light py-3">
                  <div class="home d-flex">
                    <h2 class="font-semibold text-xl text-white leading-tight">&nbsp Transaction History </h2><br>
                      <button class="btn btn-warning btn-rounded mb-4" data-bs-toggle="modal" data-bs-target="#modalMemberForm">
                      <i class="fas fa-user-plus"></i>&nbsp;
                        Add New Transaction
                      </button>                      
                  </div>
                  <hr class="divider" />
                    <table class="table" id="transactions">
                      <thead class="table-secondary ">
                        <tr>
                          <th>Name</th>
                          <th>Membership Plan</th>
                          <th>Membership Type</th>
                          <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ($transactions as $tran)
                        <tr id="{{$tran->tran_id}}">
                          <td>{{$tran->tran_fname}} {{$tran->tran_lname}}</td>
                          <td>{{$tran->tran_plan}}</td>
                          <td>{{$tran->tran_type}}</td>
                          <td>Php {{$tran->tran_amount}}.00</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
          </div>
          <!--New member Modal-->
          <div class="modal fade" id="modalMemberForm" tabindex="-1" aria-labelledby="myModalLabel"
            aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <form action="{{ route('add.transactions') }}" method="post">
                  
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
                                  <h3 class="mb-3 text-uppercase text-center">Transaction</h3>
                                  <div class="row">
                                    <div class="col-6 mb-3">
                                      <div class="form-outline">
                                        <input type="text" id="tran_fname" name="tran_fname" class="form-control" required/>
                                        <label class="form-label" for="tran_fname">First name</label>
                                      </div>
                                      @error('fname')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                      <div class="form-outline">
                                        <input type="text" id="tran_lname" name="tran_lname" class="form-control" required/>
                                        <label class="form-label" for="tran_lname">Last name</label>
                                      </div>
                                    </div>
                                      @error('lname')
                                        <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>


                                  <div class="row">
                                    <div class="col-6 mb-3">
                                    <input type="text" id="tran_plan" name="tran_plan" class="form-control" placeholder="e.g. Monthly"required/>
                                    <label class="form-label" for="tran_plan">Membership Plan</label>
                                    </div>
                                    <div class="col-6 mb-3">
                                    <input type="text" id="tran_type" name="tran_type" class="form-control" placeholder="Student or Non-Stduent"required/>
                                    <label class="form-label" for="tran_type">Membership Type</label>
                                    </div>
                                  </div>

                                  <!-- <div class="row">
                                    <div class="col-6 mb-3">
                                    <input type="date" id="tran_startDate" name="tran_startDate" class="form-control" placeholder="e.g. Monthly"required/>
                                    <label class="form-label" for="tran_startDate">Starting Date</label>
                                    </div>
                                    <div class="col-6 mb-3">
                                    <input type="date" id="tran_endDate" name="tran_endDate" class="form-control" placeholder="Student or Non-Stduent"required/>
                                    <label class="form-label" for="tran_endDate">End Date</label>
                                    </div>
                                  </div> -->
                                  <hr class="divider"/>
                                  <div class="row">
                                    
                                    <div class="col-4 mb-3">
                                      <input type="number" id="tran_amount" name="tran_amount" class="form-control" required/>
                                      <label class="form-label" for="tran_amount">Amount</label>
                                    </div>
                                    <div class="col-6 mb-3">
                                      <div class="container">
                                        <table class="table table-bordered">
                                          <thead>
                                            <tr>
                                              <th scope="col"></th>
                                              <th scope="col">Student</th>
                                              <th scope="col">Non-Student</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <th scope="row">Daily</th>
                                              <td>Php 200</td>
                                              <td>Php 250</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Monthly</th>
                                              <td>Php 1100</td>
                                              <td>Php 1400</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Bi-Annual</th>
                                              <td>Php 6600</td>
                                              <td>Php 8400</td>
                                            </tr>
                                            <tr>
                                              <th scope="row">Annual</th>
                                              <td>Php 13200</td>
                                              <td>Php 16800</td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
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
      $('#transactions').DataTable({
        lengthMenu: [ [5, 10, 25, -1], [5, 10, 25, 'All'], ],
      });
    });
</script>
</html>