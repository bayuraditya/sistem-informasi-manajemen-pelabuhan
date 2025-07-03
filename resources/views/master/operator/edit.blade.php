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
       
                <form action="/master/operator/{{$operator->id}}" method="post"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="{{$operator->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" aria-describedby="emailHelp" value="{{$operator->address}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Website</label>
                            <input type="text" class="form-control" id="website" name="website" aria-describedby="emailHelp" value="{{$operator->website}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Handphone Number</label>
                            <input type="number" class="form-control" id="handphone_number" name="handphone_number" aria-describedby="emailHelp" value="{{$operator->handphone_number}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{$operator->email}}">
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Foto</label><br>
                            <img src="{{ asset('images/' . $operator->image) }}" alt="Image" style="max-width: 200px;">
                          <br>  {{$operator->image}} <br><br>
                            <input class="form-control" type="file" id="image" name="image" >
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