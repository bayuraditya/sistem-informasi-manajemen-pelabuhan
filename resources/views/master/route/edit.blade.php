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
                <form action="/master/route/{{$route->id}}" method="post" >
                        @csrf
                        @method('PUT')
                                <div class="mb-3 col-4">
                                    <label for="name" class="form-label">Rute</label>
                                    <input type="text" class="form-control" id="route" name="route" value="{{$route->route}}">
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
        $('#tablePassenger').DataTable();
    });
</script>


@endsection