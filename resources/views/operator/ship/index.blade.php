@extends('layouts.admin-app')
@section('content')
<div class="page-heading">
    <h3>Ship</h3>
</div>
        <div class="card">
            <div class="card-header">
                <h4>Tambah Kapal</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert-success alert  alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="ship/store" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kapal</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="departureRoute" class="form-label">Rute Keberangkatan</label>
                        <select name="departureRoute" id="departureRoute" class="form-select" aria-label="Default select example">
                            @foreach($route as $r)
                            <option value="$r->id">{{$r->route}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="departureTime" class="form-label">Waktu Keberangkatan</label>
                        <input type="time" class="form-control" id="departureTime" name="departureTime">
                    </div>
                    <div class="mb-3">
                        <label for="arrivalRoute" class="form-label">Rute Kedatangan</label>
                        <select name="arrivalRoute" id="arrivalRoute" class="form-select" aria-label="Default select example">
                            @foreach($route as $r)
                            <option value="$r->id">{{$r->route}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="arrivalTime" class="form-label">Waktu Kedatangan</label>
                        <input id="arrivalTime" name="arrivalTime" type="time" class="form-control" id="departureRoute" name="departureRoute">
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select name="type" id="type" class="form-select" aria-label="Default select example">
                            <option value="regular">regular</option>
                            <option value="charter">charter</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="operator" class="form-label">Operator</label>
                        <select name="operator" id="operator" class="form-select" aria-label="Default select example">
                            @foreach($operator as $o)
                            <option value="$o->id">{{$o->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Data Kapal</h4>
            </div>
            <div class="card-body">
                <table class="table dataTable-table" id="tableShip">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama Kapal</td>
                            <td>Rute Keberangkatan</td>
                            <td>Waktu Keberangkatan</td>
                            <td>Rute Kedatangan</td>
                            <td>Waktu Kedatangan</td>
                            <td>Tipe Kapal</td>
                            <td>Operator</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($ship as $s)
                            <tr>
                               <td>{{$s->ship_id}}</td>
                               <td>{{$s->ship_name}}</td>
                               <td>{{$s->departure_route}}</td>
                               <td>{{$s->departure_time}}</td>
                               <td>{{$s->arrival_route}}</td>
                               <td>{{$s->arrival_route}}</td>
                               <td>{{$s->type}}</td>
                               <td>{{$s->operator_name}}</td>
                                <td>
                                    <a href="/operator/ship/{{ $s->id }}" type="submit"
                                        class="btn btn-warning">Edit</a>
                                    <form action="{{ route('operator.ship.destroy', $s->ship_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input
                                            onclick="return confirm('Are you sure you want delete {{ $s->ship_id }} ?')"
                                            type="submit" class="btn btn-danger" value="DELETE">
                                    </form>
                                </td>
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
        $('#tableShip').DataTable();
    });
</script>

<script src="{{asset('assets/static/js/components/dark.js')}}"></script>
    <script src="{{asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

    <script src="{{asset('assets/compiled/js/app.js')}}"></script>

    <script src="{{asset('assets/extensions/simple-datatables/umd/simple-datatables.js')}}"></script>
    <script src="{{asset('assets/static/js/pages/simple-datatables.js')}}"></script>
@endsection


