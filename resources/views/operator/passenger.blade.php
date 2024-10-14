@extends('layouts.admin-app')
@section('content')
<div class="page-heading">
    <h3>Passenger</h3>
</div>
<div class="card">
    <div class="card-body">
            <!-- content here -->
        <!-- 
            tombol tambah data -> modal input jumlah penumpang : tanggal,kapal, jumlah penumpang departure, jumlah penumpang arrive

            pilih tanggal 
            submit
            table data

        -->
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPassenger">
        Tambah Data
        </button>
<br><br>
        <!-- Modal -->
        <div class="modal fade" id="addPassenger" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Penumpang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- form here -->
                    <form action="" method="">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pilih Tanggal</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Pilih Kapal</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jumlah Penumpang Departure</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jumlah Penumpang Arrive</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>


        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#printPassenger">
        Cetak Data
        </button>
<br><br>
        <!-- Modal -->
        <div class="modal fade" id="printPassenger" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Print Penumpang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- form here -->
                    <form action="" method="">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pilih Tanggal</label>
                            <input type="date" name="printPassangerDate" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <button type="submit" class="btn btn-primary">Cetak</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>




        <form action="" method="">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Pilih Tanggal</label>
                <input type="date" class="form-control" id="passengerDate" name="passengerDate" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <br><br>
        
        <h3>Date : {{}}</h3>
        
        <table class="table" id="tablePassenger">
            <thead>
                <tr>
                    <td>no</td>
                    <td>date</td>
                    <td>ship</td>
                    <td>departing route</td>
                    <td>departing passenger</td>
                    <td>arrival route</td>
                    <td>darrival passenger</td>
                    <td>type</td>
                    <td>action</td>
                </tr>
            </thead>
            <tbody>
                @foreach()
                <tr>
                    <td>ss</td>
                    <td>ss</td>
                    <td>ss</td>
                    <td>ss</td>
                    <td>ss</td>
                    <td>ss</td>
                    <td>ss</td>
                    <td>ss</td>
                    <td>ss</td>
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