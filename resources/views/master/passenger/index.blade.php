@extends('layouts.admin-app')
@section('content')
<div class="page-heading">
    <h3>Passenger</h3>
</div>
<div class="card">
    <div class="card-body">
         @if (session('success'))
                    <div class="alert-success alert  alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
        @elseif(session('error'))
        
        <div class="alert-danger alert  alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            <!-- content here -->
        <!-- 
            tombol tambah data -> modal input jumlah penumpang : tanggal,kapal, jumlah penumpang departure, jumlah penumpang arrive

            pilih tanggal 
            submit
            table data

        -->
        <!-- Button trigger modal -->
        @if($user->role == 'master' || $user->role == 'operator')

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPassenger">
        Tambah Data
        </button>
        @endif
        <br><br>
        <!-- Modal -->
        <div class="modal fade" id="addPassenger" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Penumpang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- form here -->
                    <form action="/master/passenger/store" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pilih Tanggal</label>
                            <input required type="date" class="form-control" id="date" name="date">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Pilih Kapal</label>
                            <select name="ship" id="selectShip" class="form-select" aria-label="Default select example">
                                @foreach($ship as $s)
                                <option value="{{$s->id}}" >{{$s->name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jumlah Penumpang Departure</label>
                            <input name="departurePassenger" type="number" class="form-control" id="departurePassenger" aria-describedby="emailHelp">
                        </div>
                        <!-- <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Retribusi</label>
                            <input name="retribution" type="number" class="form-control" id="retribution" aria-describedby="emailHelp">
                        </div> -->
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jumlah Penumpang Arrive</label>
                            <input name="arrivalPassenger" type="number" class="form-control" id="arrivalPassenger" aria-describedby="emailHelp">
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


        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#printPassenger">
        Cetak Data
        </button>
<br><br>
        <!-- Modal -->
        <div class="modal fade" id="printPassenger" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Print Penumpang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- form here -->
                    <form action="/master/passenger/export" target="_blank" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pilih Tanggal</label>
                            <input type="date" name="printPassengerDate" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>
        <form action="/master/passenger" method="get">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Pilih Tanggal</label>
                <input type="date" class="form-control" id="passengerDate" name="passengerDate" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <br><br>
        
        <h4>Date : {{$date}}</h4>
        <div class="table-responsive">

            <table class="table dataTable-table" id="tablePassenger">
                <thead>
                <tr>
                    <td>No</td>
                    <td>Date</td>
                    <td>Ship</td>
                    <td>Departure route</td>
                    <td>Departure time</td>
                    <td>Departure passenger</td>
                    <td>Departure passenger retribution</td>
                    <td>Retribution</td>
                    <td>Arrival route</td>
                    <td>Arrival time</td>
                    <td>Arrival passenger</td>
                    <td>Penginput passenger</td>
                    @if($user->role == 'master' || $user->role == 'operator')
                    <td>Action</td>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($passenger as $p)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        {{date('d F Y', strtotime($p->date));}}
                    </td>
                    <td>{{$p->ship->name}}</td>
                    <td>{{$p->ship->departureRoute->route}}</td>
                    <td>{{$p->ship->departure_time}}</td>
                    <td>{{$p->departure_passenger}}</td>
                    <td>{{$p->departure_passenger_retribution}}</td>
                    <td>{{$p->retribution}}</td>
                    <td>{{$p->ship->arrivalRoute->route}}</td>
                    <td>{{$p->ship->arrival_time}}</td>
                    <td>{{$p->arrival_passenger}}</td>
                    <td>{{$p->passengerUser->name}}</td>
                    <!-- role: master, operator-passenger -->
                    @if($user->role == 'master' || $user->role == 'operator')
                    
                    <td class="">
                        <a href="/master/passenger/{{ $p->id }}" type="submit"
                        class="btn btn-warning">Edit</a>
                        <form action="{{ route('master.passenger.destroy',['id' => $p->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input onclick="return confirm('Are you sure you want delete transaction {{ $p->id }} ?')" type="submit" class="btn btn-danger" value="DELETE">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS (CDN) -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    // Inisialisasi DataTables
    $(document).ready(function() {
        $('#tablePassenger').DataTable();
    });
</script>

@endsection