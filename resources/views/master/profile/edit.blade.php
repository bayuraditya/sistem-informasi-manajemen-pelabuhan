@extends('layouts.admin-app')
@section('content')

<div class="page-heading">
    <h3>Edit Profile</h3>
</div>
        <div class="card">
         <div class="card-body">

           @if(session('success'))
           <div class="alert-success alert  alert-dismissible fade show" role="alert" >
             {{ session('success') }}
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            <form action="/master/profile/update/{{$user->id}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label for="user_name" class="form-label">Nama </label>
      <input type="text" class="form-control" id="user_name" name="name" value="{{$user->name}}">
    </div>
    <div class="mb-3">
      <label for="user_name" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
    </div>
    <div class="mb-3">
      <label for="user_name" class="form-label">Bidang/Sector</label>
      <input type="text" class="form-control" id="sector" name="sector" value="{{$user->sector}}">
    </div>
    <div class="mb-3">
      <label for="user_name" class="form-label">Role</label>
      <input type="text" class="form-control" id="email" name="email" value="{{$user->role}}" disabled>
    </div>
    <div class="mb-3">
                                    <label for="formFile" class="form-label">Foto</label><br>
                                    <img src="{{ asset('images/' . $user->image) }}" alt="Image" style="max-width: 200px;">
                                    <br>  {{$user->image}} <br><br>
                                    <input class="form-control" type="file" id="image" name="image" >
                                </div>
    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
  </form>
  <br><br>  
  <a href="/master/profile/change-password/">Ubah Kata Sandi</a>
  
  
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




@endsection