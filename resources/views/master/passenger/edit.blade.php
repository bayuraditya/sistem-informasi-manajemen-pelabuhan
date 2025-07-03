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
       
                <form action="/master/passenger/{{$passenger->id}}" method="post">
                        @csrf
                        @METHOD('PUT')
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pilih Tanggal</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{$passenger->date}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Pilih Kapal</label>
                            <select name="ship" id="selectShip" class="form-select" aria-label="Default select example">
                                @foreach($ship as $s)
                                <option
                                    
                                    @if($s->id == $passenger->ship_id)
                                        selected
                                    @endif

                                value="{{$s->id}}" >{{$s->name}}</option>
                                @endforeach
                            </select>
                      

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jumlah Penumpang Departure</label>
                            <input name="departurePassenger" type="number" class="form-control" id="departurePassenger" value="{{$passenger->departure_passenger}}">
                        </div>
                        <!-- <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Retribusi</label>
                            <input name="retribution" type="number" class="form-control" id="retribution" value="{{$passenger->retribution}}">
                        </div> -->
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jumlah Penumpang Arrive</label>
                            <input name="arrivalPassenger" type="number" class="form-control" id="arrivalPassenger" value="{{$passenger->arrival_passenger}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
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