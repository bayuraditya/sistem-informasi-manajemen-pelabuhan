@extends('layouts.admin-app')
@section('content')

<div class="page-heading">
    <h3>Edit Profile</h3>
</div>
        <div class="card">
         <div class="card-body">

           @if(session('success'))
           <div class="alert-success alert  alert-dismissible fade show" role="alert">
             {{ session('success') }}
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            <form action="/master/profile/update/{{$user->id}}" method="post">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label for="user_name" class="form-label">Nama </label>
      <input type="text" class="form-control" id="user_name" name="name" value="{{$user->name}}">
    </div>
    <div class="mb-3">
      <label for="user_name" class="form-label">Email</label>
      <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}">
    </div>
    <div class="mb-3">
      <label for="user_name" class="form-label">Role</label>
      <input type="text" class="form-control" id="email" name="email" value="{{$user->role}}" disabled>
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

<script src="{{asset('assets/static/js/components/dark.js')}}"></script>
    <script src="{{asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

    <script src="{{asset('assets/compiled/js/app.js')}}"></script>

    <script src="{{asset('assets/extensions/simple-datatables/umd/simple-datatables.js')}}"></script>
    <script src="{{asset('assets/static/js/pages/simple-datatables.js')}}"></script>





@endsection