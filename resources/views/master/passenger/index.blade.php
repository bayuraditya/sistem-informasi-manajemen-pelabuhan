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
                @endif
            <!-- content here -->
        <!-- 
            tombol tambah data -> modal input jumlah penumpang : tanggal,kapal, jumlah penumpang departure, jumlah penumpang arrive

            pilih tanggal 
            submit
            table data

        -->
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPassenger">
        Tambah Data
        </button>
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
                            <input type="date" class="form-control" id="date" name="date">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Pilih Kapal</label>
                            <select name="ship" id="selectShip" class="form-select" aria-label="Default select example">
                                @foreach($ship as $s)
                                <option value="{{$s->id}}" >{{$s->name}}</option>
                                @endforeach
                            </select>
                            <div id="shipDetail">
                                <!-- departure route : 
                                departure time :
                                arrival route :
                                arrival time : 
                                type -->
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                // Ambil elemen select
                                var selectElement = document.getElementById('selectShip');
                                // Tambahkan event listener untuk perubahan nilai select
                                selectElement.addEventListener('change', function() {
                                    // Ambil nilai opsi yang dipilih
                                    var selectedValue = selectElement.value;
                                    // Gunakan if untuk memeriksa opsi yang dipilih
                                    @foreach($ship as $s)
                                        if(selectedValue === {{$s->id}}){
                                        document.getElementById('shipDetail').innerHTML = '<p>Detail Kapal 1: Ini adalah kapal pertama.</p>';
                                        }
                                    @endforeach
                                });
                            });

                            </script>

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jumlah Penumpang Departure</label>
                            <input name="departurePassenger" type="number" class="form-control" id="departurePassenger" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Retribusi</label>
                            <input name="retribution" type="number" class="form-control" id="retribution" aria-describedby="emailHelp">
                        </div>
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
                    <form action="/master/passenger/export" method="post">
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
        <table class="table dataTable-table" id="tablePassenger">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Date</td>
                    <td>Ship</td>
                    <td>Departure route</td>
                    <td>Departure time</td>
                    <td>Departure passenger</td>
                    <td>Retribution</td>
                    <td>Arrival route</td>
                    <td>Arrival time</td>
                    <td>Arrival passenger</td>
                    <td>Penginput</td>
                    @if($user->role == 'master' || $user->role == 'operator')
                    <td>Action</td>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($passenger as $p)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$p->date}}</td>
                    <td>{{$p->ship_name}}</td>
                    <td>{{$p->departure_route}}</td>
                    <td>{{$p->departure_time}}</td>
                    <td>{{$p->departure_passenger}}</td>
                    <td>{{$p->retribution}}</td>
                    <td>{{$p->arrival_route}}</td>
                    <td>{{$p->arrival_time}}</td>
                    <td>{{$p->arrival_passenger}}</td>
                    <td>{{$p->user_name}}</td>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS (CDN) -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    // Inisialisasi DataTables
    $(document).ready(function() {
        $('#tablePassenger').DataTable();
    });
</script>

<script src="{{asset('assets/static/js/components/dark.js')}}"></script>
    <script src="{{asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

    <script src="{{asset('assets/compiled/js/app.js')}}"></script>

    <script src="{{asset('assets/extensions/simple-datatables/umd/simple-datatables.js')}}"></script>
    <script src="{{asset('assets/static/js/pages/simple-datatables.js')}}"></script>
@endsection