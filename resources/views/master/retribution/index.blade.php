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
                    @if($user->role == 'master' || $user->sector == 'retribusi')
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTargetRetribution">
                    Tambah Target Retribusi
                    </button>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exportTargetsModal">
                    <i class="bi bi-file-earmark-excel"></i> Export Target Retribusi
                    </button>
                    @endif
                    <!-- Modal -->
                    <div class="modal fade" id="addTargetRetribution" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Target Retribusi</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="retribution/target/store" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Pilih Bulan</label>
                                    <input type="month" class="form-control" id="month" name="month">
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Targer Retribusi</label>
                                    <input type="number" class="form-control" id="targer" name="target">
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

                    <!-- Export Targets Modal -->
                    <div class="modal fade" id="exportTargetsModal" tabindex="-1" aria-labelledby="exportTargetsModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exportTargetsModalLabel">Export Data Pencapaian Retribusi</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('master.retribution.exportTargets') }}" method="post">
                                        @csrf
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
                                            • Pilih Tahun untuk semua data target retribusi tahun tersebut
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

                    <!-- Export Passengers Modal -->
                    <div class="modal fade" id="exportPassengersModal" tabindex="-1" aria-labelledby="exportPassengersModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exportPassengersModalLabel">Export Kelola Retribusi</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('master.retribution.exportPassengers') }}" method="post">
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
            </div>
            <div class="card-header">
                <h4>Data Pencapaian Retribusi</h4>
            </div>
            <div class="card-body ">
                <div class="table-responsive">

                    <table class="table dataTable-table" id="tableRetributionTargets">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Month</th>
                            <th>Target</th>
                            <th>Total</th>
                            <th>Status</th>
                    @if($user->role == 'master' || $user->sector == 'retribusi')
                            <th>Action</th>
                           @endif
                        </tr>
                    </thead>
                </table>
            </div>
                <br><br><br>
                <h4>Kelola retribusi</h4>
                @if($user->role == 'master' || $user->sector == 'retribusi')
                <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#exportPassengersModal">
                <i class="bi bi-file-earmark-excel"></i> Export Kelola Retribusi
                </button>
                @endif
                <br>
                <div class="table-responsive">

                    <table class="table dataTable-table" id="tablePassengerRetributions">
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
                    <th>Retribution Status</th>
                    <th>Arrival route</th>
                    <th>Arrival time</th>
                    <th>Arrival passenger</th>
                    <th>Penginput retribusi</th>
                    <!-- role: master role:operator sector: retribusi -->
                    @if($user->role == 'master' || $user->sector == 'retribusi')
                    <th>Action</th>
                    @endif
                </tr>
            </thead>
        </table>
    </div>
                </div>
        </div>

        <!-- Container for dynamic modals -->
        <div id="modals-container"></div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- DataTables JS (CDN) -->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

        <script>
        $(document).ready(function() {
            // DataTable 1: Retribution Targets (Data Pencapaian Retribusi)
            var tableTargets = $('#tableRetributionTargets').DataTable({
                processing: true,
                serverSide: true,
                lengthMenu: [10, 25, 50, 100],
                pageLength: 10,
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
                    url: '{{ route("master.retribution.datatable.targets") }}',
                    type: 'GET'
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
                    { data: 'month_formatted', name: 'month_formatted' },
                    { data: 'target_formatted', name: 'target_formatted' },
                    { data: 'total_formatted', name: 'total_formatted' },
                    { data: 'status', name: 'status', orderable: false, searchable: false },
                    @if($user->role == 'master' || $user->sector == 'retribusi')
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                    @endif
                ],
                order: [[1, 'desc']] // Default sort by month column (index 1)
            });

            // DataTable 2: Passenger Retributions (Kelola Retribusi)
            var tablePassengers = $('#tablePassengerRetributions').DataTable({
                processing: true,
                serverSide: true,
                lengthMenu: [10, 25, 50, 100],
                pageLength: 10,
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
                    url: '{{ route("master.retribution.datatable.passengers") }}',
                    type: 'GET'
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
                    { data: 'retribution_status_badge', name: 'retribution_status_badge', orderable: false, searchable: false },
                    { data: 'arrival_route', name: 'arrival_route' },
                    { data: 'arrival_time', name: 'arrival_time' },
                    { data: 'arrival_passenger', name: 'arrival_passenger' },
                    { data: 'retribution_user_name', name: 'retribution_user_name' },
                    @if($user->role == 'master' || $user->sector == 'retribusi')
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                    @endif
                ],
                order: [[1, 'desc']], // Default sort by date column (index 1)
                drawCallback: function(settings) {
                    // Initialize modals after each table draw
                    initModals();
                }
            });

            // Function to initialize modals for edit buttons
            function initModals() {
                @if($user->role == 'master' || $user->sector == 'retribusi')
                // Remove existing event listeners to avoid duplicates
                $('#tablePassengerRetributions').off('click', '[data-bs-toggle="modal"]');

                // Add event listener for edit buttons
                $('#tablePassengerRetributions').on('click', '[data-bs-toggle="modal"]', function() {
                    var passengerId = $(this).data('bs-target').replace('#edit_', '');
                    loadModal(passengerId);
                });
                @endif
            }

            // Function to load modal content via AJAX
            function loadModal(passengerId) {
                $.ajax({
                    url: '/master/retribution/modal/' + passengerId,
                    type: 'GET',
                    success: function(data) {
                        $('#modals-container').html(data);
                        // Initialize the modal
                        var modalEl = document.getElementById('edit_' + passengerId);
                        var modal = new bootstrap.Modal(modalEl);
                        modal.show();

                        // Remove modal from DOM when it's closed
                        modalEl.addEventListener('hidden.bs.modal', function () {
                            $('#modals-container').empty();
                        });
                    }
                });
            }
        });
        </script>

@endsection


