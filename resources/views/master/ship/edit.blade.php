@extends('layouts.admin-app')
@section('content')
<div class="page-heading">
    <h3>Ship</h3>
</div>
        <div class="card">
            <div class="card-header">
                <h4>Edit Kapal {{$ship->name}}</h4>
            </div>
            <div class="card-body">
            <form action="/master/ship/{{$ship->id}}" method="post" enctype="multipart/form-data">
                                @csrf
                    @method('PUT')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Kapal</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$ship->name}}">
                                </div>
                                <div class="mb-3">
                                    <label for="departureRoute" class="form-label">Rute Keberangkatan</label>
                                    <select name="departureRoute" id="departureRoute" class="form-select" aria-label="Default select example">
                                        @foreach($route as $r)
                                        <option 
                                        
                                        @if($ship->departure_route_id == $r->id)
                                            selected
                                        @endif

                                        value="{{$r->id}}">{{$r->route}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="departureTime" class="form-label">Waktu Keberangkatan</label>
                                    <input type="time" class="form-control" id="departureTime" name="departureTime" value="{{$ship->departure_time}}">
                                </div>
                                <div class="mb-3">
                                    <label for="arrivalRoute" class="form-label">Rute Kedatangan</label>
                                    <select name="arrivalRoute" id="arrivalRoute" class="form-select" aria-label="Default select example">
                                        @foreach($route as $r)
                                        <option
                                        
                                        @if($ship->arrival_route_id == $r->id)
                                            selected
                                        @endif

                                        value="{{$r->id}}">{{$r->route}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="arrivalTime" class="form-label">Waktu Kedatangan</label>
                                    <input id="arrivalTime" name="arrivalTime" type="time" class="form-control" id="departureRoute" name="departureRoute" value="{{$ship->arrival_time}}">
                                </div>
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type</label>
                                    <select name="type" id="type" class="form-select" aria-label="Default select example">
                                        <option
                                        
                                        @if($ship->type == 'regular')
                                            selected
                                        @endif

                                        value="regular"> regular </option>
                                        <option
                                        
                                        @if($ship->type == 'charter')
                                            selected
                                        @endif

                                        value="charter">charter</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Foto</label><br>
                                    @foreach($ship->shipImages as $i)
                                        <img src="{{ asset('images/' . $i->image) }}" alt="Image" style="max-width: 200px;">

                                    @endforeach
                                    <br>  {{$ship->image}} <br><br>
                                    <input type="file" name="image[]" id="images" accept="image/*" multiple>
                                </div>
                                <div class="mb-3">
                                    <label for="operator" class="form-label">Operator</label>
                                    <select name="operator" id="operator" class="form-select" aria-label="Default select example">
                                        @foreach($operator as $o)
                                        <option 
                                        
                                        @if($ship->operator_id == $o->id)
                                            selected
                                        @endif
                                        
                                        value="{{$o->id}}">{{$o->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
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


