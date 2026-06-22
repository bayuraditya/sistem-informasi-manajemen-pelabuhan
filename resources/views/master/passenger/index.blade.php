@extends('layouts.admin-app')
@section('content')
<div class="page-heading">
    <h3>Passenger</h3>
</div>
<div class="card">
    <div class="card-body">
         @if (session('success'))
                    <div class="alert-success alert  alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
        @elseif(session('error'))
        
        <div class="alert-danger alert  alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            <!-- content here -->
        <!-- 
            tombol tambah data -> modal input jumlah penumpang : tanggal,kapal, jumlah penumpang departure, jumlah penumpang arrive

            pilih tanggal 
            submit
            table data

        -->
        <!-- Button trigger modal -->
        @if($user->role == 'master' || $user->role == 'operator')

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPassenger">
        Tambah Data
        </button>
        @endif
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
                    <form action="/master/passenger/store" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pilih Tanggal</label>
                            <input required type="date" class="form-control" id="date" name="date">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Pilih Kapal</label>
                            <select name="ship" id="selectShip" class="form-select" aria-label="Default select example">
                                @foreach($ship as $s)
                                <option value="{{$s->id}}" >{{$s->name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jumlah Penumpang Departure</label>
                            <input name="departurePassenger" type="number" class="form-control" id="departurePassenger" aria-describedby="emailHelp">
                        </div>
                        <!-- <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Retribusi</label>
                            <input name="retribution" type="number" class="form-control" id="retribution" aria-describedby="emailHelp">
                        </div> -->
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Jumlah Penumpang Arrive</label>
                            <input name="arrivalPassenger" type="number" class="form-control" id="arrivalPassenger" aria-describedby="emailHelp">
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

        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exportExcelModal">
        <i class="bi bi-file-earmark-excel"></i> Export Excel
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
                    <form action="/master/passenger/export" target="_blank" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pilih Tanggal</label>
                            <input type="date" name="printPassengerDate" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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

        <!-- Export Excel Modal -->
        <div class="modal fade" id="exportExcelModal" tabindex="-1" aria-labelledby="exportExcelModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exportExcelModalLabel">Export Passenger Data to Excel</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- form here -->
                    <form action="{{ route('master.passenger.exportExcel') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="month" class="form-label">Pilih Bulan</label>
                            <select name="month" id="month" class="form-select" aria-label="Select Month">
                                <option value="">Semua Bulan</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="year" class="form-label">Pilih Tahun *</label>
                            <select name="year" id="year" class="form-select" aria-label="Select Year" required>
                                <option value="">-- Pilih Tahun --</option>
                                @for($y = date('Y'); $y >= date('Y') - 10; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                            <div class="form-text">Wajib dipilih untuk export data</div>
                        </div>
                        <div class="alert alert-info" role="alert">
                            <strong>Tips Export:</strong><br>
                            • Pilih Bulan + Tahun untuk data bulan tertentu<br>
                            • Pilih Tahun saja (bulan kosong) untuk semua data tahun tersebut
                        </div>
                        <button type="submit" class="btn btn-success">Export Excel</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

        <form action="/master/passenger" method="get">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Pilih Tanggal</label>
                <input type="date" class="form-control" id="passengerDate" name="passengerDate" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <br><br>

        <h4>Date : {{$date}}</h4>
        <div class="table-responsive">

            <table class="table dataTable-table" id="tablePassenger">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Ship</th>
                    <th>Departure route</th>
                    <th>Departure time</th>
                    <th>Departure passenger</th>
                    <th>Departure passenger retribution</th>
                    <th>Retribution</th>
                    <th>Arrival route</th>
                    <th>Arrival time</th>
                    <th>Arrival passenger</th>
                    <th>Penginput passenger</th>
                    @if($user->role == 'master' || $user->role == 'operator')
                    <th>Action</th>
                    @endif
                </tr>
            </thead>
        </table>
    </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS (CDN) -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#tablePassenger').DataTable({
            processing: true,
            serverSide: true,
            lengthMenu: [10, 25, 50, 100], // Opsi jumlah entries per halaman: 10, 25, 50, 100
            pageLength: 10, // Default 10 entries per halaman
            language: {
                lengthMenu: "Show _MENU_ entries",
                search: "Search:",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                },
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "No entries found",
                infoFiltered: "(filtered from _MAX_ total entries)",
                zeroRecords: "No matching records found",
                processing: "Loading..."
            },
            ajax: {
                url: '{{ route("master.passenger.datatable") }}',
                type: 'GET',
                data: function (d) {
                    d.passengerDate = $('#passengerDate').val();
                }
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'date_formatted', name: 'date_formatted' },
                { data: 'ship_name', name: 'ship_name' },
                { data: 'departure_route', name: 'departure_route' },
                { data: 'departure_time', name: 'departure_time' },
                { data: 'departure_passenger', name: 'departure_passenger' },
                { data: 'departure_passenger_retribution', name: 'departure_passenger_retribution' },
                { data: 'retribution', name: 'retribution' },
                { data: 'arrival_route', name: 'arrival_route' },
                { data: 'arrival_time', name: 'arrival_time' },
                { data: 'arrival_passenger', name: 'arrival_passenger' },
                { data: 'passenger_user_name', name: 'passenger_user_name' },
                @if($user->role == 'master' || $user->role == 'operator')
                { data: 'action', name: 'action', orderable: false, searchable: false }
                @endif
            ],
            order: [[1, 'desc']] // Default sort by date column (index 1)
        });

        // Reload table when date filter changes
        $('#passengerDate').on('change', function() {
            table.ajax.reload();
        });

        // Reload table when date filter form is submitted
        $('form[action="/master/passenger"]').on('submit', function(e) {
            e.preventDefault();
            table.ajax.reload();
        });
    });
</script>

@endsection