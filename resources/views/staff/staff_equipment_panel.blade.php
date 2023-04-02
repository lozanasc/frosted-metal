<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="csrf-token" content="{{csrf_token()}}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Panel</title>
    <link rel="stylesheet" href="{{asset('cssfile/owner.css')}}">
    <script src="{{asset('assets/js/main.js')}}" defer></script>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
      <a class="btn tablinks active" href="{{route('StaffEquipmentPanel')}}"><i class="fas fa-dumbbell"></i> Equipment Tools</a>
      <hr class="hr hr-blurry" />
      <a class="btn tablinks" href="{{route('StaffTransactionPanel')}}"><i class='fas'>&#xf02c;</i> Transaction</a>
      <hr class="hr hr-blurry" />
      <form method="POST" action="{{ route('logout') }}">
          @csrf
              <a href="route('logout')" class="btn text-black"
                  onclick="event.preventDefault();
                  this.closest('form').submit();"><i class='fas'>&#xf011;</i>&nbsp; Logout </a>
      </form>
</div>


<div class="tabcontent">

<div class="tabcontent container">
  <div class="row my-5">
    <div class="col-lg-12">
      <div class="card shadow"> 
        <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
          <h3 class="text-light">Manage Equipments</h3>
          <!--Equipment tools Modal Form-->
          <button class="btn btn-light btn-rounded mb-4" data-bs-toggle="modal" data-bs-target="#modalEquipmentForm">
          <i class="bi bi-person-add"></i>
          Add New Equipment
          </button>
        </div>              
        <br>
        <div class="p-2">
        <table class="table" id="staff">
            <thead>
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Weight</th>
              <th>Quantity</th>
              <th>Muscle Group</th>
              <th>Condition</th>
              <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($equipment as $tool)
            <tr id="{{$tool->id}}">
              <td><img src="{{asset('images/equipments/'. $tool->image)}}" class="card-img-top" alt="image" style="width:50px; height:50px"></td>
              <td id="tname">{{$tool->name}}</td>
              <td id="tweight">{{$tool->weight}}</td>
              <td id="tquantity">{{$tool->quantity}}</td>
              <td id="tactivity">{{$tool->activity}}</td>
              <td id="tcondition">{{$tool->condition}}</td>
              <td>
              <div class="d-flex">
              <button class="btn btn-outline-primary btn-rounded btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditToolsForm"
              onclick="setForm('{{$tool->id}}','{{$tool->name}}','{{$tool->weight}}','{{$tool->quantity}}','{{$tool->activity}}','{{$tool->condition}}')">
                <i class="bi bi-pencil-square"></i>
              </button>&nbsp&nbsp&nbsp
              <form action="{{route('deleteTools', $tool->id)}}">
                  @csrf
                  <input name="_method"type="hidden" value="delete">
                  <button type="submit" class="btn btn-outline-danger btn-sm btn-rounded show_confirm"><i class="bi bi-trash3"></i></button>
              </form>
            </div>
              </td>
            </tr>
            @endforeach 
            </tbody>
          </table>
        </div>
        <!--Modal Add new Equipment-->
        <div class="modal fade" id="modalEquipmentForm" tabindex="-1" aria-labelledby="myModalLabel"
            aria-hidden="true" data-bs-backdrop="static">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form method="POST" action="{{ route('addTools') }}" enctype="multipart/form-data">
              
                @csrf
                <div class="modal-header text-center bg-warning">
                  <h4 class="modal-title w-100 font-weight-bold">Add a new equipment</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                            
                <div class="modal-body mx-3">
                  <div class="md-form mb-5">
                    <i class="fas fa-file-image prefix grey-text"></i>
                      <label for="image">Insert Image</label>
                      <input type="file" id="image" name="image" class="form-control border border-secondary" required>
                        @error('image')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                  </div>

                  <div class="md-form mb-5">
                    <i class="fas fa-user prefix grey-text"></i>
                      <label for="name">Name</label>
                      <input type="text" id="name" name="name" class="form-control" required>
                        @error('name')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                  </div>

                  <div class="md-form mb-5">
                    <i class="fas fa-user prefix grey-text"></i>
                      <label for="weight">Weight</label>
                      <input type="text" id="weight" name="weight" class="form-control" required>
                        @error('weight')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                  </div>

                  <div class="md-form mb-5">
                    <i class="fas fa-cogs prefix grey-text"></i>
                      <label for="quantity">Quantity</label>
                      <input type="number" id="quantity" name="quantity" class="form-control" required>
                        @error('quantity')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                  </div>

                  <div class="md-form mb-5">
                    <i class="fas fa-cogs prefix grey-text"></i>
                      <label for="activity">Muscle Group</label>
                      <input type="text" id="activity" name="activity" class="form-control" placeholder="Area of the body the equipment is intended for"required>
                        @error('quantity')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                  </div>

                  <div class="md-form">
                    <i class="fas fa-pen-fancy prefix grey-text"></i>
                      <label for="condition">Condition</label>
                      <textarea type="text" id="condition" name="condition" class="md-textarea form-control" rows="4" required></textarea>
                        @error('condition')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                  </div>

                </div>

                <div class="modal-footer d-flex justify-content-center">
                  <button type="submit" id="send" class="btn btn-info bg-info">Send &nbsp<i class="fas fa-paper-plane"></i></button>
                </div>
              </form>
            </div>
          </div>
        </div>              
        <!--Modal Edit for Equipments-->
          <div class="modal fade" id="modalEditToolsForm" tabindex="-1" aria-labelledby="myModalLabel"
              aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                <h5>Update Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
              
                @csrf 

                  <!-- <div class="md-form mb-5 px-2">
                    <i class="fas fa-user prefix grey-text"></i>
                      <label for="image">Insert Image</label>                     
                      <input type="file" name="image" id="image" class="form-control">
                    <div id="eimage" class="form-control"> </div>                     
                    </div> -->
                    <div class="md-form mb-5 px-2">
                        <label for="tid">ID</label>
                        <input type="text" id="eid" name="eid" class="form-control" disabled>
                      </div>

                  <div class="md-form mb-5 px-2">
                    <i class="fas fa-user prefix grey-text"></i>
                      <label for="ename">Name</label>
                      <input type="text" id="ename" name="ename" class="form-control">
                      
                  </div>

                  <div class="md-form mb-5 px-2">
                    <i class="fas fa-user prefix grey-text"></i>
                      <label for="eweight">Weight</label>
                      <input type="text" id="eweight" name="eweight" class="form-control">
                        
                  </div>

                  <div class="md-form mb-5 px-2">
                    <i class="fas fa-cogs prefix grey-text"></i>
                      <label for="equantity">Quantity</label>
                      <input type="number" id="equantity" name="equantity" class="form-control">
                      
                  </div>

                  <div class="md-form mb-5">
                    <i class="fas fa-cogs prefix grey-text"></i>
                      <label for="eactivity">Muscle Group</label>
                      <input type="text" id="eactivity" name="eactivity" class="form-control" placeholder="Area of the body the equipment is intended for"required>
                  </div>

                  <div class="md-form mb-5 px-2">
                    <i class="fas fa-pen-fancy prefix grey-text"></i>
                      <label for="econdition">Condition</label>
                      <input type="text" id="econdition" name="econdition" class="md-textarea form-control" rows="4">
                      
                  </div>
                  <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" id="save" class="btn btn-info bg-info">Save changes &nbsp<i class="fas fa-paper-plane"></i></button>
                  </div>                    
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
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script>
   $(document).ready(function(){
      $('#staff').DataTable({
        lengthMenu: [ [5, 10, 25, -1], [5, 10, 25, 'All'], ],
      });
    });
</script>

<script>
 
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