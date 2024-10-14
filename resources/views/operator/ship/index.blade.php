@extends('layouts.admin-app')
@section('content')
<div class="col-12">
        <div class="card">
            <div class="card-header">
                <h1>Tambah Kapal</h1>
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
                        <label for="court_name" class="form-label">Nama Kapal</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="court_name" class="form-label">Rute Keberangkatan</label>
                        <select name="departureRoute" id="departureRoute" class="form-select" aria-label="Default select example">
                            @foreach($route as $r)
                            <option value="$r->id"></option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="court_name" class="form-label">Waktu Keberangkatan</label>
                        <input type="time" class="form-control" id="departureTime" name="departureTime">
                    </div>
                    <div class="mb-3">
                        <label for="court_name" class="form-label">Rute Kedatangan</label>
                        <select name="arrivalRoute" id="arrivalRoute" class="form-select" aria-label="Default select example">
                            @foreach($route as $r)
                            <option value="$r->id"></option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="court_name" class="form-label">Waktu Kedatangan</label>
                        <input id="arrivalTime" name="arrivalTime" type="text" class="form-control" id="departureRoute" name="departureRoute">
                    </div>
                    <div class="mb-3">
                        <label for="court_name" class="form-label">Type</label>
                        <input id="type" name="type" type="text" class="form-control" id="departureRoute" name="departureRoute">
                    </div>
                    <div class="mb-3">
                        <label for="court_name" class="form-label">Operator</label>
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
                <h1>Data Kapal</h1>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
Full texts
id
name
departure_route
departure_time
arrival_route
arrival_time
type
operator_id
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
                               <td>{{dd($ship)}}</td>
                                <td>
                                    <a href="/admin/court/{{ $c->id }}" type="submit"
                                        class="btn btn-warning">Edit</a>
                                    <form action="{{ route('court.destroy', $c->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input
                                            onclick="return confirm('Are you sure you want delete {{ $c->court_name }} ?')"
                                            type="submit" class="btn btn-danger" value="DELETE">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


