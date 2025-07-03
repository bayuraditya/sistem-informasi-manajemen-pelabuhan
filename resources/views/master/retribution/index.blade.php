divdiv
@extends('layouts.admin-app')
@section('content')
<div class="page-heading">
    <h3>Retribusi</h3>
</div>
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert-success alert  alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                    @if($user->role == 'master' || $user->sector == 'retribusi')
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTargetRetribution">
                    Tambah Target Retribusi
                    </button>
                    @endif
                    <!-- Modal -->
                    <div class="modal fade" id="addTargetRetribution" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Target Retribusi</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="retribution/target/store" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Pilih Bulan</label>
                                    <input type="month" class="form-control" id="month" name="month">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Targer Retribusi</label>
                                    <input type="number" class="form-control" id="targer" name="target">
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Tambahkan</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                    </div>
            </div>
            <div class="card-header">
                <h4>Data Pencapaian Retribusi</h4>
            </div>
            <div class="card-body ">
                <div class="table-responsive">

                    <table class="table dataTable-table" id="tableShip">
                        <thead>
                        <tr>
                            <td>No</td>
                            <td>Month</td>
                            <td>Target</td>
                            <td>Total</td>
                            <td>Status</td>
                    @if($user->role == 'master' || $user->sector == 'retribusi')
                            <td>Action</td>
                           @endif
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($retribution as $r)
                            <tr>
                               <td>{{$loop->iteration}}</td>
                               <td>{{date('F Y', strtotime($r->month))}}</td>
                               <td>{{$r->target}}</td>
                               <td>{{$r->total}}</td>
                               <td>
                                   @if($r->total >= $r->target)
                                   Tercapai
                                   @else
                                   Belum Tercapai
                                   @endif
                                </td>
                                @if($user->role == 'master' || $user->sector == 'retribusi')
                                
                                <td>
                                    <a href="/master/retribution/target/{{ $r->id }}" type="submit"
                                        class="btn btn-warning">Edit</a>
                                        <form action="{{ route('master.target.retribution.destroy', $r->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input
                                        onclick="return confirm('Are you sure you want delete {{ $r->id }} ?')"
                                        type="submit" class="btn btn-danger" value="DELETE">
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
                <br><br><br>
                <h4>Kelola retribusi</h4>
                <br>
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
                    <td>Retribution Status</td>
                    <td>Arrival route</td>
                    <td>Arrival time</td>
                    <td>Arrival passenger</td>
                    <td>Penginput retribusi</td>
                    <!-- role: master role:operator sector: retribusi -->
                    @if($user->role == 'master' || $user->sector == 'retribusi')
                    <td>Action</td>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($passenger as $p)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{date('d F Y', strtotime($p->date))}} </td>
                    <td>{{$p->ship->name}}</td>
                    <td>{{$p->ship->departureRoute->route}}</td>
                    <td>{{$p->ship->departure_time}}</td>
                    <td>{{$p->departure_passenger}}</td>
                    <td>{{$p->departure_passenger_retribution}}</td>
                    <td>{{$p->retribution}}</td>
                    <td>{{$p->retribution_status}}</td>
                    <td>{{$p->ship->arrivalRoute->route}}</td>
                    <td>{{$p->ship->arrival_time}}</td>
                    <td>{{$p->arrival_passenger}}</td>
                    <td>{{$p->retributionUser?->name}}</td>
                    
                    @if($user->role == 'master' || $user->sector == 'retribusi')
                    
                    <td class="">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit_{{$p->id}}">
                            Edit Retribusi  
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="edit_{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/master/retribution/{{$p->id}}" method="post">
                        @csrf
                        @METHOD('PUT')
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pilih Tanggal</label>
                            <input disabled type="date" class="form-control" id="date" name="date" value="{{$p->date}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Pilih Kapal</label>
                            <select disabled name="ship" id="selectShip" class="form-select" aria-label="Default select example">
                                @foreach($ship as $s)
                                <option
                                    
                                    @if($s->id == $p->ship_id)
                                        selected
                                    @endif

                                value="{{$s->id}}" >{{$s->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jumlah Penumpang Departure</label>
                            <input disabled name="departurePassenger" type="number" class="form-control" id="departurePassenger" value="{{$p->departure_passenger}}">
                        </div>
                        <!-- <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Retribusi</label>
                            <input name="retribution" type="number" class="form-control" id="retribution" value="{{$p->retribution}}">
                        </div> -->
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jumlah Penumpang Arrive</label>
                            <input disabled name="arrivalPassenger" type="number" class="form-control" id="arrivalPassenger" value="{{$p->arrival_passenger}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jumlah Penumpang Retribusi</label>
                            <input name="departurePassengerRetribution" type="number" class="form-control" id="departurePassengerRetribution_{{$p->id}}" value="{{$p->departure_passenger_retribution}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Retribusi (penumpang retribusi x2500)</label>
                            <input readonly name="retribution" type="number" class="form-control" id="retribution_{{$p->id}}" value="{{$p->retribution}}" >
                        </div>
                        <script>
                            document.getElementById('departurePassengerRetribution_{{$p->id}}').addEventListener('input', function() {
                                // Ambil nilai dari input
                                let inputValue = parseFloat(this.value);
                                
                                // Jika ada nilai input, kalikan 2500, jika kosong maka set 0
                                let result = inputValue ? inputValue * 2500 : 0;
                                
                                // Tampilkan hasil pada input kedua
                                document.getElementById('retribution_{{$p->id}}').value = result;
                            });
                            </script>
                               <div class="mb-3">
                                   <label for="exampleInputPassword1" class="form-label">Status Retribusi</label>
                            <select  name="retributionStatus" id="retributionStatus" class="form-select" aria-label="Default select example">
                                <option
                                @if($p->retribution_status == 'lunas')
                                selected
                                @endif
                                
                                value="lunas" >Lunas</option>
                                <option
                                
                                @if($p->retribution_status == 'belum lunas')
                                selected
                                @endif
                                value="belum lunas" >belum Lunas</option>
                            </select>
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
        $('#tableShip').DataTable();
    });
    $(document).ready(function() {
        $('#tablePassenger').DataTable();
    });
</script>

@endsection


