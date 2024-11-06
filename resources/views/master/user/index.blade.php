@extends('layouts.admin-app')
@section('content')
<div class="page-heading">
    <h3>Users</h3>
</div>

    <div class="card">
        <div class="card-body">
            <h4 class="">Struktur Organisasi</h3><br>
            <img class="d-block mx-auto" src="{{asset('images\struktur organisasi.jpeg')}}" alt="">
        </div>
    </div>

    <div class="card">
            <!-- <div class="card-header">
                <h4>Tambah Kapal</h4>
            </div> -->
            <div class="card-body">
                @if (session('success'))
                    <div class="alert-success alert  alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session('error'))
                <div class="alert-danger alert  alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">
                    Tambah User
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="users/store" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="sector" class="form-label">Bidang/Sector</label>
                                    <input type="text" class="form-control" id="sector" name="sector">
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
                                    <label for="role" class="form-label">role</label>
                                    <select class="form-select" name="role" id="role">
                                        <option value="master">Master</option>
                                        <option value="admin">Admin</option>
                                        <option value="operator">Operator</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Foto Profil</label>
                                    <input class="form-control" type="file" id="image" name="image">
                                </div>
                                <button type="submit" class="btn btn-primary">Tambahkan</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                    </div>
                
            </div>
      
            <div class="card-header">
                <h4>Data User</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table dataTable-table" id="tableShip">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama</td>
                            <td>Email</td>
                            <!-- <td>Password (Enkripsi)</td> -->
                            <td>Role</td>
                            <td>Bidang</td>
                            <td>Foto Profil</td>
                    @if($user->role == 'master' || $user->role == 'operator')
                            <td>Action</td>
                            @endif
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($allUser as $u)
                            <tr>
                               <td>{{$loop->iteration}}</td>
                               <td>{{$u->name}}</td>
                               <td>{{$u->email}}</td>
                               <!-- <td style=" white-space: nowrap; /* Mencegah konten turun ke baris baru */  overflow-x: auto;    /* Mengaktifkan scroll horizontal */max-width: 200px;  "></td> -->
                               <td>{{$u->role}}</td>
                               <td>{{$u->sector}}</td>
                               <td>
                                    <img src="{{ asset('images/' . $u->image) }}" alt="Image" style="max-width: 100px;">
                               </td>
                            @if($user->role == 'master' ||$user->role == 'operator')
                                <td>
                                    <a href="/master/users/{{ $u->id }}" type="submit"
                                        class="btn btn-warning">Edit</a>
                                    <form action="{{ route('master.user.destroy', $u->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input
                                            onclick="return confirm('Are you sure you want delete {{ $u->id }} ?')"
                                            type="submit" class="btn btn-danger" value="DELETE">
                                    </form>
                                </td>
                                @endif
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


@endsection


