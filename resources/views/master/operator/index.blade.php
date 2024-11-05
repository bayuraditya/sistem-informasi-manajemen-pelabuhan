@extends('layouts.admin-app')
@section('content')
<div class="page-heading">
    <h3>Operator</h3>
</div>
<div class="card">
    <div class="card-body">
         @if (session('success'))
                    <div class="alert-success alert  alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
        
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addOperator">
        Tambah Data
        </button>
        <br><br>
        <!-- Modal -->
        <div class="modal fade" id="addOperator" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Penumpang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/master/operator/store" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Website</label>
                            <input type="text" class="form-control" id="website" name="website" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Handphone Number</label>
                            <input type="number" class="form-control" id="handphone_number" name="handphone_number" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Foto</label>
                            <input class="form-control" type="file" id="image" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="table-responsive">

            <table class="table dataTable-table" id="tableOperator">
                <thead>
                <tr>
                    <td>No</td>
                    <td>Name</td>
                    <td>Address</td>
                    <td>Website</td>
                    <td>Handphone Number</td>
                    <td>Email</td>
                    <td>foto</td>
                    <td>Ship</td>
                    @if($user->role == 'master' ||$user->role == 'operator')
                    <td>action</td>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($operator as $o)
                <tr>
                    <td>{{$o->id}}</td>
                    <td>{{$o->name}}</td>
                    <td>{{$o->address}}</td>
                    <td>{{$o->website}}</td>
                    <td>{{$o->handphone_number}}</td>
                    <td>{{$o->email}}</td>
                    <td>
                        <img src="{{ asset('images/' . $o->image) }}" alt="Image" style="max-width: 200px;">
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#shipList{{$o->id}}">
                            Ships List
                        </button>
                    </td>
                    @if($user->role == 'master' ||$user->role == 'operator')
                    <td class="">
                        <a href="/master/operator/{{ $o->id }}" type="submit"
                        class="btn btn-warning">Edit</a>
                        <form action="{{ route('master.operator.destroy',['id' => $o->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input onclick="return confirm('Are you sure you want delete operator {{ $o->name }} ?')" type="submit" class="btn btn-danger" value="DELETE">
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>

@foreach($operator as $o)

<!-- Modal -->
<div class="modal fade" id="shipList{{$o->id}}" tabindex="-1" aria-labelledby="examsdpleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ships List</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- nama, rute berangkat, jam berangkat, rute datang, jam datang, tipe -->
        @foreach($o->ships as $s)
            <div class="card" style="">
            <div id="carouselExampleIndicators{{$s->id}}" class="carousel slide " data-bs-ride="carousel">
                                            <div class="carousel-inner ">
                                            @foreach($s->shipImages as $key => $i)
                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('images/' . $i->image) }}" class="" alt="Slide {{ $key + 1 }}" style="height: 300px;width:480px; object-fit: cover;">
                                                </div>
                                            @endforeach 
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators{{$s->id}}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators{{$s->id}}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                <div class="card-body">
                    <h5 class="card-title">{{$s->name}}</h5>
                    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                                    Departure Route 
                                : {{$s->departureRoute->route}}
                   </li>
                    <li class="list-group-item">
                                Departure Time
                              : {{$s->departure_time}}
                             
                    </li>
                    <li class="list-group-item">
                               Arrival Route 
                                : {{$s->arrivalRoute->route}}
                    </li>
                    <li class="list-group-item">
                              Arrival Time 
                               : {{$s->arrival_time}}
                    </li>
                    <li class="list-group-item">
                               Type
                               : {{$s->type}}
                    </li>
                    <li class="list-group-item">
                             Operator
                              : {{$s->operator->name}}
                    </li>
                </ul>
                <!-- <div class="card-body">
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div> -->
            </div>
          <br>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endforeach
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS (CDN) -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    // Inisialisasi DataTables
    $(document).ready(function() {
        $('#tableOperator').DataTable();
    });
</script>

<script src="{{asset('assets/static/js/components/dark.js')}}"></script>
    <script src="{{asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

    <script src="{{asset('assets/compiled/js/app.js')}}"></script>

    <script src="{{asset('assets/extensions/simple-datatables/umd/simple-datatables.js')}}"></script>
    <script src="{{asset('assets/static/js/pages/simple-datatables.js')}}"></script>
@endsection