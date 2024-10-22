@extends('layouts.admin-app')
@section('content')
<div class="page-heading">
    <h3>Ship</h3>
</div>
        <div class="card">
            <div class="card-header">
                <h4>Edit User {{$editUser->name}}</h4>
            </div>
            <div class="card-body">
            <form action="/master/users/{{$editUser->id}}" method="post">
                                @csrf
                    @method('PUT')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$editUser->name}}">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{$editUser->email}}">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            Lihat
                                        </button>
                                    </div>
                                </div>

                                <script>
                                    const togglePassword = document.querySelector('#togglePassword');
                                    const password = document.querySelector('#password');

                                    togglePassword.addEventListener('click', function (e) {
                                        // Toggle the type attribute
                                        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                                        password.setAttribute('type', type);

                                        // Toggle the text of the button
                                        this.textContent = type === 'password' ? 'Lihat' : 'Sembunyikan';
                                    });
                                </script>

                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select name="role" id="role" class="form-select" aria-label="Default select example">
                                        <option 
                                        
                                        @if($editUser->role == 'master')
                                            selected
                                        @endif

                                        value="master">Master</option>

                                        <option 
                                        
                                        @if($editUser->role == 'operator')
                                            selected
                                        @endif

                                        value="operator">Operator</option>

                                        <option 
                                        
                                        @if($editUser->role == 'admin')
                                            selected
                                        @endif

                                        value="admin">Admin</option>
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


