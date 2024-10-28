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
                <form action="/master/retribution/{{$retribution->id}}" method="post" >
                        @csrf
                        @method('PUT')
                                <div class="mb-3 col-4">
                                    <label for="name" class="form-label">Bulan</label>
                                    <input type="month" class="form-control " id="month" name="month" value="{{$retribution->month}}">
                                </div>
                                <div class="mb-3 col-4">
                                    <label for="name" class="form-label">Target</label>
                                    <input type="number" class="form-control" id="target" name="target" value="{{$retribution->target}}">
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

<script src="{{asset('assets/static/js/components/dark.js')}}"></script>
    <script src="{{asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

    <script src="{{asset('assets/compiled/js/app.js')}}"></script>

    <script src="{{asset('assets/extensions/simple-datatables/umd/simple-datatables.js')}}"></script>
    <script src="{{asset('assets/static/js/pages/simple-datatables.js')}}"></script>
@endsection