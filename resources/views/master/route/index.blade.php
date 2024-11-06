@extends('layouts.admin-app')
@section('content')
<div class="page-heading">
    <h3>Rute</h3>
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
                @endif
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Rute
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Rute</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="route/store" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Rute</label>
                                    <input type="text" class="form-control" id="route" name="route">
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
                <h4>Data Rute</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table dataTable-table" id="tableShip">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Rute</td>
                    @if($user->role == 'master' || $user->role == 'operator')

                            <td>Action</td>
                           @endif
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($route as $r)
                            <tr>
                               <td>{{$loop->iteration}}</td>
                               <td>{{$r->route}}</td>
                    @if($user->role == 'master' || $user->role == 'operator')
                             
                                <td>
                                    <a href="/master/route/{{ $r->id }}" type="submit"
                                        class="btn btn-warning">Edit</a>
                                    <form action="{{ route('master.route.destroy', $r->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input
                                            onclick="return confirm('Are you sure you want delete {{ $r->id }} ?')"
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


