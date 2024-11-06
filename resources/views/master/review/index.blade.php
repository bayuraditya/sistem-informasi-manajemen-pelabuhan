<!-- 
ambil dari db, acc or declined(update) 
-->
@extends('layouts.admin-app')
@section('content')
<div class="page-heading">
    <h3>Reviews</h3>
</div>
<div class="card">
    <div class="card-body table-responsive">
         @if (session('success'))
                    <div class="alert-success alert  alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            <!-- content here -->
      <!-- 
            
id	name	email	review	point	status	 -->
        
        <table class="table dataTable-table" id="tablePassenger">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Review</td>
                    <td>Point</td>
                    <td>Status</td>
                    @if($user->role == 'master' || $user->role == 'operator')
                    <td>Edit Status</td>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($review as $r)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$r->name}}</td>
                    <td>{{$r->email}}</td>
                    <td>{{$r->review}}</td>
                    <td>{{$r->point}}</td>
                    <td
                    @if($r->status == 'approve')
                    class="text-success fw-bold"
                    @endif

                    @if($r->status == 'pending')
                    class="text-warning fw-bold"
                    @endif

                    @if($r->status == 'declined')
                    class="text-danger fw-bold"
                    @endif
                    
                    >{{$r->status}}</td>
                    @if($user->role == 'master' || $user->role == 'operator')
                    
                    <td class="">
                        <form action="{{ route('master.review.update',['id' => $r->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select id="status" name="status" class="form-select  mb-3" aria-label="Large select example">
                            
                            <option 
                            @if($r->status == 'approve')
                            selected
                            @endif
                            value="approve" > Approve</option>
                            
                            <option 
                            @if($r->status == 'pending')
                            selected
                            @endif
                            value="pending">Pending</option>

                            <option
                            @if($r->status == 'declined')
                            selected
                            @endif
                            value="declined">Declined</option>
                            
                        </select>
                            <button class="btn btn-primary" type="submit">Update</button>
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
        $('#tablePassenger').DataTable();
    });
</script>

@endsection